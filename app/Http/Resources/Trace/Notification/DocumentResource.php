<?php

namespace App\Http\Resources\Trace\Notification;

use Illuminate\Http\Resources\Json\JsonResource;

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
            'document_id' => $this->document->id,
            'action' => $this->is_action,
            'is_completed' => $this->is_completed,
            'document_id' => $this->document->id,
            'router' => $this->document->router->username,
            'route_slip' => $this->document->route_slip,
            'subject' => $this->document->subject,
            'created_at' => $this->created_at
        ];
    }
}
