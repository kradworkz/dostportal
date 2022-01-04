<?php

namespace App\Http\Resources\Modules\Travel;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\DropdownResource;

class IndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {   
        if(date("Y-m-d",strtotime($this->start_at)) == date("Y-m-d",strtotime($this->end_at))){
            $date = date("M d, Y",strtotime($this->end_at)).' ('.date("g:i a",strtotime($this->start_at)).'-'.date("g:i a",strtotime($this->end_at)).')';
        }else{
            $date = date("M d, Y",strtotime($this->start_at)).' - '.date("M d, Y",strtotime($this->end_at));
        }
        return [
            'id' => $this->id,
            'is_vehicle' => $this->is_vehicle,
            'code' => $this->code,
            'information' => $this->information,
            'destination' => $this->destination,
            'user' => new UserResource($this->user),
            'status' => $this->status,
            'mode' => new DropdownResource($this->mode),
            'vehicle' => new VehicleResource($this->vehicle),
            'employees' => EmployeeResource::collection($this->employees),
            'comments' => CommentResource::collection($this->comments->sortByDesc('created_at')),
            'start_at' => $this->start_at,
            'end_at' => $this->end_at,
            'date' => $date,
            'created_at' => $this->created_at
        ];
    }
}
