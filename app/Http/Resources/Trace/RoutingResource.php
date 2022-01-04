<?php

namespace App\Http\Resources\Trace;

use Illuminate\Http\Resources\Json\JsonResource;

class RoutingResource extends JsonResource
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
            'seen_to' => $this->is_seen_to,
            'seen_from' => $this->is_seen_from,
            'completed' => $this->is_completed,
            'required' => $this->is_required,
            'seened_at' => $this->seened,
            'completed_at' => $this->completed,
            'name' => $this->user->profile->firstname.' '.$this->user->profile->middlename[0].'. '.$this->user->profile->lastname,
            'avatar' => $this->user->avatar,
            'comment' => new CommentResource($this->comments->first()),
            'comments' => CommentResource::collection($this->comments)

        ];
    }
}
