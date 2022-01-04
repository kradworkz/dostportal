<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'username' => strtoupper($this->username),
            'email' => $this->email,
            'avatar' => $this->avatar,
            'type' => $this->type,
            'user_status' => $this->status,
            'firstname' => $this->profile->firstname,
            'lastname' => $this->profile->lastname,
            'middlename' => $this->profile->middlename,
            'extension' => $this->profile->extension,
            'birthday' => $this->profile->birthday,
            'gender' => $this->profile->gender,
            'mobile_no' => $this->profile->mobile_no,
            'status' => $this->employee->status,
            'department' => $this->employee->department,
            'position' => $this->employee->position,
            'profile' => new ProfileResource($this->profile),
            'employee' => new EmployeeResource($this->employee),
            'roles' => RoleResource::collection($this->roles),
            'groups' => GroupResource::collection($this->groups),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
