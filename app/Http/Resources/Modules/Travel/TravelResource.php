<?php

namespace App\Http\Resources\Modules\Travel;

use Illuminate\Http\Resources\Json\JsonResource;

class TravelResource extends JsonResource
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
            'title' => $this->destination,
            'start' => date("Y-m-d H:i:s",strtotime($this->start_at)),
            'end' => date("Y-m-d H:i:s",strtotime($this->end_at)),
            'resourceId' => ($this->vehicle) ? $this->vehicle->vehicle_id : '',
            'classNames' => "bg-primary krad",
            'display' => "block",
        ];
    }
}
