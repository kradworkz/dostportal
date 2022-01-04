<?php

namespace App\Http\Resources\Trace;

use Illuminate\Http\Resources\Json\JsonResource;

class PostCommentResource extends JsonResource
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
            'avatar' => $this->user->avatar,
            'name' => $this->user->profile->firstname.' '.$this->user->profile->lastname,
            'text' => $this->comment,
            'is_seen' => $this->is_seen,
            'created_at' => $this->created_at
        ];
    }
}
