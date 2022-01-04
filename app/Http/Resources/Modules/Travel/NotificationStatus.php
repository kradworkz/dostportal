<?php

namespace App\Http\Resources\Modules\Travel;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationStatus extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if(date("Y-m-d",strtotime($this->travel->start_at)) == date("Y-m-d",strtotime($this->travel->end_at))){
            $date = date("M d, Y",strtotime($this->travel->end_at)).' ('.date("g:i a",strtotime($this->travel->start_at)).'-'.date("g:i a",strtotime($this->travel->end_at)).')';
        }else{
            $date = date("M d, Y",strtotime($this->travel->start_at)).' - '.date("M d, Y",strtotime($this->travel->end_at));
        }
        $a = ($this->travel->is_vehicle == 0) ? 'Travel Order' : 'Vehicle Reservation' ;
        $subject = $this->travel->destination.' on '.$date;

        return [
            'id' => $this->travel->id,
            'status_id' => $this->id,
            'status' => $this->status,
            'action' => strtolower($this->status->name)." a ". $a ." to ".$subject,
            'code' => $this->travel->code,
            'subject' => '',
            'user' => $this->user->profile->firstname.' '.$this->user->profile->lastname,
            'type' => ($this->type == NULL) ? 'statuses' : $this->type,
            'users' => $this->travel->employees,
            'created_at' => $this->created_at,
        ];
    }
}
