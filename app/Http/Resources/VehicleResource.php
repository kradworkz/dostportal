<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VehicleResource extends JsonResource
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
            'name' => $this->name.' ('.$this->plate.')',
            'title' => $this->name.' ('.$this->plate.')',
            'plate' => $this->plate,
            'destination' => $this->destination,
            'group' => $this->group->name,
            'user' => $this->user->profile->firstname.' '.$this->user->profile->lastname,
        ];
    }
}
