<?php

namespace App\Http\Resources\Modules\Travel;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationComment extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $a = ($this->is_vehicle == 0) ? 'Travel Order' : 'Vehicle Registration' ;

        return [
            'id' => $this->travel->id,
            'comment_id' => $this->id,
            'action' => " commented on a ". $a ." that you're tagged in.",
            'action2' => " commented on a ". $a ." request.",
            'code' => $this->travel->code,
            'subject' => $this->comment,
            'user' => $this->user->profile->firstname.' '.$this->user->profile->lastname,
            'type' => ($this->type == NULL) ? 'comments' : $this->type,
            'users' => $this->travel->employees,
            'comment_by' => $this->user_id,
            'created_at' => $this->created_at,
        ];
    }
}
