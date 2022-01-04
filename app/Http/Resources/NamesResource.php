<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NamesResource extends JsonResource
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
            'firstname' => $this->profile->firstname,
            'lastname' => $this->profile->lastname,
            'middlename' => $this->profile->middlename,
            'extension' => $this->profile->extension,
        ];
    }
}
