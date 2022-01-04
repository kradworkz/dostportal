<?php

namespace App\Http\Traits;
use App\Models\Dropdown;
use App\Models\UserProfile;
use App\Models\Travel;
use App\Models\ListGroup;
use App\Http\Resources\DefaultResource;
use App\Http\Resources\BirthdayResource;

trait DropdownTrait {
    public function dropdown($classification,$type) {
        $query = Dropdown::query();
        ($type != '-') ? $query->where('type',$type) : '';
        $data = $query->where('classification',$classification)->get();

        return DefaultResource::collection($data);
    }

    public function birthday(){
        $month = date('m');
        $day = date('d');
        $data = UserProfile::whereDay('birthday','>=',$day)->whereMonth('birthday',$month)->orderBy('birthday','DESC')->get();
        return BirthdayResource::collection($data);
    }

    public function schedules(){     
        $date = date('Y-m-d');
        $data = Travel::where('start_at','>=',$date)
        ->whereHas('employees', function ($q){
            $q->where('user_id',\Auth::user()->id);
        })
        ->get();
        return DefaultResource::collection($data);

    }

    public function location(){
        $data = ListGroup::orderBy('id','ASC')->get();
        return DefaultResource::collection($data);
    }   
}