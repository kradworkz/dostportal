<?php

namespace App\Http\Resources\Trace;

use Illuminate\Http\Resources\Json\JsonResource;

class NameResource extends JsonResource
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
            'name' => $this->profile->firstname.' '.$this->profile->middlename[0].'. '.$this->profile->lastname
        ];
    }
}
