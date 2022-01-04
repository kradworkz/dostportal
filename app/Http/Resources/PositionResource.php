<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PositionResource extends JsonResource
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
            'name' => $this->name,
            'code' => $this->code,
            'grade' => 'Salary Grade '.$this->salary->name,
            'rate' =>  '₱ '.number_format($this->salary->others,2),
            'salary' => $this->salary,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
