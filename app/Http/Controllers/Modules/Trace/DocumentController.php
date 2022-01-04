<?php

namespace App\Http\Controllers\Modules\Trace;

use App\Models\User;
use App\Models\UserEmployee;
use App\Models\Document;
use App\Models\DocumentRouting;
use App\Models\DocumentAttachment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CodeGenerator;
use App\Services\StoreFile;
use App\Http\Resources\DefaultResource;
use App\Http\Requests\Trace\RoutingRequest;
use App\Http\Requests\Trace\DocumentRequest;
use App\Http\Resources\Trace\DocumentResource;
use App\Http\Resources\Trace\Notification\DocumentResource as DocumentResource2;
use App\Jobs\NotifyMail;
use App\Jobs\NotifySms;
use App\Events\TraceEvent;

class DocumentController extends Controller
{
    public function pageIn(){
        return view('module_trace.in-document');
    }

    public function pageOut(){
        return view('module_trace.out-document');
    }

    public function index($doctype,$type,$status,$completed,$keyword,$counts)
    {
        ($keyword == '-') ? $keyword = '' : $keyword;
        $query = Document::query();
        $query->with('sender','company','type','attachments');
        $query->where(function($query) use ($keyword) {
            $query->where('subject','LIKE','%'.$keyword.'%')->orWhere('route_slip','LIKE','%'.$keyword.'%');
        });
        $query->where('is_incoming',$doctype);
        ($type == '-') ? '' : $query->where('type_id',$type);
        ($completed == '-') ? '' : $query->where('is_completed',$completed);
        ($status == '-') ? '' : $query->where('is_status',$status);
        $data = $query->orderBy('id','DESC')->paginate($counts);

        return DocumentResource::collection($data);
    }

    public function store(StoreFile $attachment, CodeGenerator $code,DocumentRequest $request){
        \DB::transaction(function () use ($request,$code,$attachment){
            if($request->editable == "true"){
                $data = Document::findOrFail($request->id);
                $keywords = json_decode($request->keywords,true);
                $data = Document::where('id',$request->id)->update($request->except('editable'));
                // $attachment->store($request,$data->id,$data->route_slip);
                // $data->profile()->update($request->except('email','department_id','position_id','status_id','img','editable'));
                // $data->employee()->update($request->except('firstname','lastname','middlename','extension','mobile_no','birthday','gender','email','img','editable'));
            }else{
                $code = $code->generateDoc($request->is_incoming); 
                $keywords = json_decode($request->keywords,true);
                $data = Document::create(array_merge($request->all(), ['keywords' => $keywords,'route_slip' => $code, 'encoded_by' => \Auth::user()->id]));
                $attachment->store($request,$data->id,$code);
            }
        });
    }

    public function route(RoutingRequest $request)
    {
        \DB::transaction(function () use ($request){
            $data = Document::findOrFail($request->id);
            $data->is_status = 1;
            $data->routed_by = \Auth::user()->id;
            $action = (in_array(46,json_decode($data->actions))) ? true : false;

            if($data->save()){
                $items = array();
                switch($request->option){
                    case 'By Group':    
                        $groups = json_decode($request->groups);
                        $users = UserEmployee::whereIn('department_id',$groups)->pluck('user_id');
                        $this->users($request->id,$users,$action);
                    break;
                    case 'Individually':
                        $users = json_decode($request->individuals);
                        $this->users($request->id,$users,$action);
                        
                    break;
                    case 'All Employees':
                        $users = User::where('id','!=',1)->pluck('id');
                        $this->users($request->id,$users,$action);
                    break;
                };
            }
        });
    }

    public function users($id,$users,$action)
    {  
        $items = array();
       
        foreach($users as $user){
            $count = DocumentRouting::where('document_id',$id)->where('route_to',$user)->count();

            if($count == 0){
                $item = [ 
                    'route_to' => $user,
                    'document_id' => $id,
                    'is_required' => 1,
                    'is_action' => $action,
                    'created_at'	=> now(),
                    'updated_at'	=> now()
                ];
                $items[] 	= $item;
                NotifyMail::dispatch($user,$id)->delay(now()->addSeconds(10));
                NotifySms::dispatch($user,$id)->delay(now()->addSeconds(10));
            }
        }
        DocumentRouting::insert($items);
        $data = DocumentRouting::with('document','document.router')->where('document_id',$id)->first();
        broadcast(new TraceEvent(new DocumentResource2($data)));
    }

    public function download(Request $request)
    {
        $data = DocumentAttachment::findOrFail($request->id);
        $path = $data->path;
        return \Storage::download('public/'.$path);
    }

    public function find($id)
    {
        $data = Document::where('id',$id)->with('sender','company','type','attachments')->first();
        return new DocumentResource($data);
    }

    public function viewed($id)
    {
        $data = DocumentRouting::where('document_id',$id)->where('route_to',\Auth::user()->id)->first();
        $data->is_seen_to = 1;
        ($data->is_action == 0) ? $data->is_completed = 1 : '';
        $data->seened = now();
        ($data->is_action == 0) ? $data->completed = now() : '';
        $data->save();

        return true;
    }

}
