<?php

namespace App\Http\Controllers\Modules\Travel;

use App\Models\Travel;
use App\Models\TravelComment;
use App\Models\TravelStatus;
use App\Models\TravelEmployee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Modules\Travel\NotificationNew;
use App\Http\Resources\Modules\Travel\NotificationTagged;
use App\Http\Resources\Modules\Travel\NotificationComment;
use App\Http\Resources\Modules\Travel\NotificationStatus;

class NotificationController extends Controller
{
    public function seen()
    {
        if(\Auth::user()->hasRole(["Regional Director","Travel Staff", "Assistant Regional Director"])){
            $new = Travel::selectRaw("*, 'new' as type")->with('user:id,avatar', 'user.profile:user_id,firstname,lastname')->where('is_seened',0)->paginate(5);
        }else{
            $new = [];
        }
            
        $tagged = Travel::selectRaw("*, 'tagged' as type")->with('user:id,avatar', 'user.profile:user_id,firstname,lastname')
        ->whereHas('employees', function ($q){
            $q->where('user_id',\Auth::user()->id)->where('is_seened',0);
        })
        ->get();

        $comments = TravelComment::with('travel.employees')->with('user:id,avatar', 'user.profile:user_id,firstname,lastname')
        ->whereJsonDoesntContain('seened_by', \Auth::user()->id)
        ->whereHas('travel', function ($q){
            $q->whereHas('employees', function ($q){
                $q->where('user_id',\Auth::user()->id);
            });
        })
        ->get();

        $statuses = TravelStatus::with('travel.employees')->with('status')->with('user:id,avatar', 'user.profile:user_id,firstname,lastname')
        ->whereJsonDoesntContain('seened_by', \Auth::user()->id)
        ->whereHas('travel', function ($q){
            $q->whereHas('employees', function ($q){
                $q->where('user_id',\Auth::user()->id);
            });
        })
        ->get();

    
        return $data = [
            'new' =>  NotificationNew::collection($new),
            'tagged' =>  NotificationTagged::collection($tagged),
            'comments' => NotificationComment::collection($comments),
            'statuses' => NotificationStatus::collection($statuses)
        ];
    }

    public function viewed($id,$type){

        switch($type){
            case 'new':     
                $this->new($id);
            break;
            case 'tagged': 
                $this->tagged($id);
            break;
            case 'statuses': 
                $this->status($id);
            break;
            case 'comments': 
                $this->comment($id);
            break;
        }

        return true;
    }

    public function new($id){
        $data = Travel::where('id',$id)->update(['is_seened' => 1]);
    }

    public function tagged($id){
        $data = TravelEmployee::where('travel_id',$id)->where('user_id',\Auth::user()->id)->update(['is_seened' => 1]);
    }

    public function comment($id){
        $data = TravelComment::where('id',$id)->first();
        $array = json_decode($data->seened_by);
        $array[] = \Auth::user()->id;
        $data->seened_by = json_encode($array);
        $data->save();
    }

    public function status($id){
        $data = TravelStatus::where('id',$id)->first();
        $array = json_decode($data->seened_by);
        $array[] = \Auth::user()->id;
        $data->seened_by = json_encode($array);
        $data->save();
    }
}
