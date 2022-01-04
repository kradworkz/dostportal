<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
            'position' => new PositionResource($this->position),
            'department' => new DefaultResource($this->department),
            'status' => new DefaultResource($this->status),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
