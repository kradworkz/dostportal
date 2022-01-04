<?php

namespace App\Http\Resources\Trace;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ListingResource;
use App\Http\Resources\DropdownResource;

class DocumentResource extends JsonResource
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
            'route_slip' => $this->route_slip,
            'subject' => $this->subject,
            'remarks' => $this->remarks,
            'keywords' => $this->keywords,
            'actions' => $this->actions,
            'document' => date("Y-m-d",strtotime($this->document)),
            'received' => date("Y-m-d",strtotime($this->received)),
            'document_at' => $this->document,
            'received_at' => $this->received,
            'is_completed' => $this->is_completed,
            'is_status' => $this->is_status,
            'type' => new DropdownResource($this->type),
            'sender' => new ListingResource($this->sender),
            'company' => new ListingResource($this->company),
            'encoder' => ($this->encoder->profile != '') ?  new EncoderResource($this->encoder) : 'Administrator',
            'comment' => $this->commentroute(),
            'attachments' => $this->attachments,
            'routings' =>  RoutingResource::collection($this->routings),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
