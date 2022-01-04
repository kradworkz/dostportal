<?php

namespace App\Http\Resources\Modules\Travel;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'comment' => $this->comment,
            'seened_by' => $this->seend_by,
            'avatar' => $this->user->avatar,
            'user' => $this->user->profile->firstname.' '.$this->user->profile->lastname,
            'created_at' => $this->created_at
        ];
    }
}
