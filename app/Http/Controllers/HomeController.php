<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Models\LocationMunicipality;
use App\Http\Resources\DefaultResource;
use App\Http\Traits\DropdownTrait;

class HomeController extends Controller
{
    use DropdownTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->type == "Administrator"){
            return view('user_admin.index');    
        }else{
            $schedules = $this->schedules();
            $birthdays = $this->birthday();
            $locations = $this->location();
            $profile = $this->profile();
            $reqtypes = $this->dropdown("Request Type","-");
            $doctypes = $this->dropdown("Document Type","-");
            $statuses = $this->dropdown("Travel Status","-");
            $modes = $this->dropdown("Travel Mode","-");
            return view('user_employee.index')->with('statuses',$statuses)->with('modes',$modes)->with('profile',$profile)->with('doctypes',$doctypes)->with('birthdays',$birthdays)->with('schedules',$schedules)->with('reqtypes',$reqtypes)->with('locations',$locations);
        }
    }

    public function management(){
        $schedules = $this->schedules();
        $birthdays = $this->birthday();
        $profile = $this->profile();
        $statuses = $this->dropdown("Travel Status","-");
        $modes = $this->dropdown("Travel Mode","-");
        $doctypes = $this->dropdown("Document Type","-");
        $docactions = $this->dropdown("Document Action","-");
        return view('user_management.index')->with('statuses',$statuses)->with('modes',$modes)->with('docactions',$docactions)->with('doctypes',$doctypes)->with('profile',$profile)->with('birthdays',$birthdays)->with('schedules',$schedules);
    }

    public function profile(){
        if(\Auth::check()){
            if(\Auth::user()->type == "Administrator"){
                return true;
            }else{
                $data = User::with('profile')->where('id',\Auth::user()->id)->first();
                return new UserResource($data);
            }
        }
    }

    public function barangays($id)
    {
        $data = LocationBarangay::where('municipality_id',1594)->orderBy('name','ASC')->get();
        return DefaultResource::collection($data);
    }


}
