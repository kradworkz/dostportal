<?php

namespace App\Http\Resources\Modules\Travel;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationNew extends JsonResource
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

        return [
            'id' => $this->id,
            'action' => "requested a ".$a." to ". $subject,
            'code' => $this->code,
            'subject' => $subject,
            'user' => $this->user->profile->firstname.' '.$this->user->profile->lastname,
            'type' => "new",
            'users' => $this->employees,
            'created_at' => $this->created_at,
        ];
    }
}
