<?php

namespace App\Http\Resources\Modules\Travel;

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
            'avatar' => $this->user->avatar,
            'name' => $this->user->profile->firstname.' '.$this->user->profile->lastname,
        ];
    }
}
