<?php

namespace App\Http\Resources\Modules\Travel;

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
            'name' => $this->vehicle->name,
            'plate' => $this->vehicle->plate,
            'group' => $this->vehicle->group->acronym,
            'user' => $this->vehicle->user->profile->firstname.' '.$this->vehicle->user->profile->lastname
        ];
    }
}
