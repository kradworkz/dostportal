<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ListRole;
use App\Models\ListGroup;
use App\Models\DocumentRouting;
use Illuminate\Http\Request;
use App\Http\Resources\DefaultResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\NamesResource;
use App\Http\Requests\UserRequest;
use App\Services\StoreImage;

class UserController extends Controller
{
    public function page(){
        return view('user_admin.employee');
    }

    public function index($keyword)
    {
        ($keyword == '-') ? $keyword = '' : $keyword;
        $data = User::with('profile')
        ->with('roles','employee','employee.department','employee.status','employee.position','employee.position.salary')
        ->whereHas('profile',function ($query) use ($keyword) {
            $query->where(\DB::raw('concat(firstname," ",lastname)'), 'LIKE', '%'.$keyword.'%')->orWhere(\DB::raw('concat(lastname," ",firstname)'), 'LIKE', '%'.$keyword.'%');
        })
        ->where('type', '!=', 'Administrator')->orderBy('id','DESC')->paginate(5);
        return UserResource::collection($data);
    }

    public function store(StoreImage $strmg,UserRequest $request){
        \DB::transaction(function () use ($request,$strmg){
            if($request->editable){
                $data = User::findOrFail($request->id);
                $data->update($request->except('img','editable'));
                $data->profile()->update($request->except('email','department_id','position_id','status_id','img','editable'));
                $data->employee()->update($request->except('firstname','lastname','middlename','extension','mobile_no','birthday','gender','email','img','editable'));
                $strmg->strmg($request,$request->id);
            }else{
                $username = strtolower($request->firstname[0].$request->middlename[0].$request->lastname[0].date("m",strtotime($request->birthday)).date("d",strtotime($request->birthday)));
                $data = User::create(array_merge($request->all(), ['username' => $username, 'password' => bcrypt('dost9ict'), 'type' => 'Member']));
                $strmg->strmg($request,$data->id);

                $data->profile()->create($request->all());
                $data->employee()->create($request->all());
            }
        });
    }

    public function search(Request $request)
    {   
        $keyword = $request->word;

        ($request->document_id) ? $users = DocumentRouting::where('document_id',$request->document_id)->pluck('route_to') : '';

        $query = User::query();
        $query->with('profile');
        ($request->document_id) ? $query->whereNotIn('id',$users) : '';
        $query->with('employee','employee.department','employee.status','employee.position','employee.position.salary')
        ->whereHas('profile',function ($query) use ($keyword) {
            $query->where(\DB::raw('concat(firstname," ",lastname)'), 'LIKE', '%'.$keyword.'%')->orWhere(\DB::raw('concat(lastname," ",firstname)'), 'LIKE', '%'.$keyword.'%');
        });
        $data = $query->where('type', '!=', 'Administrator')->orderBy('id','DESC')->paginate(5);
        return NamesResource::collection($data);
    }

    public function roles(Request $request)
    {       
        $roles =$request->roles;
        $data = User::findOrFail($request->id);
        $data->roles()->sync($roles);
    }

    public function groups(Request $request)
    {     
        $groups =$request->groups;
        $data = User::findOrFail($request->id);
        $data->groups()->sync($groups);
    }

}
