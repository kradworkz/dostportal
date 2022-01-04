<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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
            'name' => $this->lastname.', '.$this->firstname.' '.$this->middlename[0].'.',
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'middlename' => $this->middlename,
            'extension' => $this->extension,
            'gender' => $this->gender,
            'birthday' => $this->birthday,
            'mobile_no' => $this->mobile_no,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
