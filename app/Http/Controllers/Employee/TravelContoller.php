<?php

namespace App\Http\Controllers\Employee;

use App\Models\Travel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Modules\Travel\TravelResource;

class TravelContoller extends Controller
{
    public function index($type,$completed,$keyword,$count)
    {  
        

        $query = Travel::query();
        $query->with('user:id,avatar', 'user.profile:user_id,firstname,lastname','vehicle:id,travel_id,vehicle_id','vehicle.vehicle:id,name,plate,group_id,user_id','vehicle.vehicle.group:id,name,acronym','mode','status','vehicle.vehicle.user:id,avatar','vehicle.vehicle.user.profile:user_id,firstname,lastname');
        ($completed == '-') ? '' : $query->where('is_completed',$completed);
        $query->whereHas('document', function ($query) use ($type,$completed,$keyword){
            $query->where(function($query) use ($keyword) {
                $query->where('subject','LIKE','%'.$keyword.'%')->orWhere('route_slip','LIKE','%'.$keyword.'%');
            });
            ($type == '-') ? '' : $query->where('type_id',$type);
        });
        $data = $query->orderBy('created_at','DESC')->paginate($count);

        return TravelResource::collection($data);
    }
}
