<?php

namespace App\Http\Resources\Modules\Travel;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if(date("Y-m-d",strtotime($this->start_at)) == date("Y-m-d",strtotime($this->end_at))){
            $date = date("M d, Y",strtotime($this->end_at)).' ('.date("g:i a",strtotime($this->start_at)).'-'.date("g:i a",strtotime($this->end_at)).')';
        }else{
            $date = date("M d, Y",strtotime($this->start_at)).' - '.date("M d, Y",strtotime($this->end_at));
        }
        $a = ($this->is_vehicle == 0) ? 'Travel Order' : 'Vehicle Reservation' ;
        $subject = $this->destination.' on '.$date;

        if($this->type == 'new'){
            $action = "requested a ".$a." to ". $subject;
        }else{
            $action = "tagged you on a travel to ".$subject;
        }

        return [
            'id' => $this->id,
            'action' => $action,
            'code' => $this->code,
            'subject' => $subject,
            'user' => $this->user->profile->firstname.' '.$this->user->profile->lastname,
            'type' => $this->type,
            'users' => $this->employees,
            'created_at' => $this->created_at,
        ];
    }
}
