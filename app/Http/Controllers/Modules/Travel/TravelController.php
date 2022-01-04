<?php

namespace App\Http\Controllers\Modules\Travel;

use App\Models\Travel;
use App\Models\TravelStatus;
use App\Models\TravelEmployee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CodeGenerator;
use App\Http\Resources\Modules\Travel\TravelResource;
use App\Http\Resources\Modules\Travel\IndexResource;
use App\Http\Resources\Modules\Travel\NotificationStatus;
use App\Http\Resources\Modules\Travel\NotificationNew;
use App\Http\Resources\Modules\Travel\NotificationTagged;
use App\Http\Requests\Travel\TravelRequest;
use App\Events\TravelEvent;
use App\Http\Resources\DefaultResource;

class TravelController extends Controller
{   
    public function index($type,$status,$mode,$keyword,$page){
        $query = Travel::query()->with('user:id,avatar', 'user.profile:user_id,firstname,lastname','vehicle:id,travel_id,vehicle_id','vehicle.vehicle:id,name,plate,group_id,user_id','vehicle.vehicle.group:id,name,acronym','mode','status','vehicle.vehicle.user:id,avatar','vehicle.vehicle.user.profile:user_id,firstname,lastname')
        ->whereHas('employees', function ($query){
           $query->whereIn('user_id',[\Auth::user()->id]);
        });
        ($status == '-') ? '' : $query->where('status_id',$status);
        ($mode == '-') ? '' : $query->where('mode_id',$mode);
        $data = $query->paginate($page);
        return IndexResource::collection($data);
    }

    public function admin($type,$status,$mode,$keyword,$page){
        $query = Travel::query()->with('user:id,avatar', 'user.profile:user_id,firstname,lastname','vehicle:id,travel_id,vehicle_id','vehicle.vehicle:id,name,plate,group_id,user_id','vehicle.vehicle.group:id,name,acronym','mode','status','vehicle.vehicle.user:id,avatar','vehicle.vehicle.user.profile:user_id,firstname,lastname');
        ($status == '-') ? '' : $query->where('status_id',$status);
        ($mode == '-') ? '' : $query->where('mode_id',$mode);
        ($type == '-') ? '' : $query->where('is_vehicle',$type);
        $data = $query->paginate($page);
        return IndexResource::collection($data);
    }

    public function lists(){
        $data = Travel::with('vehicle','mode','status')->get();
        return TravelResource::collection($data);
    }

    public function view($id){
        $data = Travel::with('user:id,avatar', 'user.profile:user_id,firstname,lastname','vehicle:id,travel_id,vehicle_id','vehicle.vehicle:id,name,plate,group_id,user_id','vehicle.vehicle.group:id,name,acronym','mode','status','vehicle.vehicle.user:id,avatar','vehicle.vehicle.user.profile:user_id,firstname,lastname')
        ->where('id',$id)
        ->first();
        return new IndexResource($data);
    }

    public function store(TravelRequest $request,CodeGenerator $code){
        $data = \DB::transaction(function () use ($request,$code){
            if($request->editable == "true"){
                $data = Document::findOrFail($request->id);
                $data->update($request->except('img','editable'));
                $data->profile()->update($request->except('email','department_id','position_id','status_id','img','editable'));
                $data->employee()->update($request->except('firstname','lastname','middlename','extension','mobile_no','birthday','gender','email','img','editable'));
            }else{
                if($request->is_vehicle != 1){
                    $additional[] = [
                        'fund' => $request->fund,
                        'a1' => ($request->a1 == "true") ? 1 : 0,
                        'a2' => ($request->a2 == "true") ? 1 : 0,
                        'p1' => ($request->p1 == "true") ? 1 : 0,
                        'p2' => ($request->p2 == "true") ? 1 : 0,
                    ];
                }else{
                    $additional = [];
                }

                $information[] = [
                    'purpose' => $request->purpose,
                    'remarks' => ($request->remarks != null) ? $request->remarks : "",
                    'others' => ($request->others != null) ?  json_decode($request->others,true) : "",
                    'additional' =>  $additional,
                ];

                $code = $code->generateTrvl($request->is_vehicle); 
                $data = Travel::create(array_merge($request->all(), ['information' => json_encode($information), 'code' => $code, 'user_id' => \Auth::user()->id]));
                $this->employees($data->id,$request);
                ($request->vehicle_id) ? $data->vehicle()->create($request->all()) : '';
                broadcast(new TravelEvent(new NotificationNew($data)));
                broadcast(new TravelEvent(new NotificationTagged($data)));
               return $data;
            }
        });

        return new TravelResource($data);
    }

    public function employees($id,$request){
        $employees = json_decode($request->employees);
        foreach($employees as $employee){
            $data = Travel::findOrFail($id);
            $data->employees()->create([
                'user_id' => $employee,
            ]);
        }
        return true;
    }

    public function status(Request $request){
    
        $data = Travel::findOrFail($request->id);
        $data->status_id = $request->status_id;
        if($data->save()){
            $data = new TravelStatus;
            $data->status_id = $request->status_id;
            $data->travel_id = $request->id;
            $data->user_id = \Auth::user()->id;
            $data->seened_by = "[]";
            if($data->save()){
                $status_id = $data->id;
            }
        }


        $statuses = TravelStatus::selectRaw("*, 'statuses' as type")->with('travel')->with('travel.employees:user_id,travel_id')->with('status')->with('user:id,avatar', 'user.profile:user_id,firstname,lastname')
        ->where('id',$status_id)
        ->first();
        broadcast(new TravelEvent(new NotificationStatus($statuses)));

        $data = Travel::with('user:id,avatar', 'user.profile:user_id,firstname,lastname','vehicle:id,travel_id,vehicle_id','vehicle.vehicle:id,name,plate,group_id,user_id','vehicle.vehicle.group:id,name,acronym','mode','status','vehicle.vehicle.user:id,avatar','vehicle.vehicle.user.profile:user_id,firstname,lastname')
        ->where('id',$request->id)
        ->first();

        return new IndexResource($data);
    }

}
