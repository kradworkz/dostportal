<?php

namespace App\Http\Controllers\Modules\Trace;

use App\Models\Document;
use App\Models\DocumentRouting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\DefaultResource;
use App\Http\Resources\Trace\Notification\DocumentResource;

class NotificationController extends Controller
{
    public function seen()
    {
        $data = DocumentRouting::with('document','document.router')->where('is_seen_to',0)->where('route_to',\Auth::user()->id)->paginate(5);
        return DocumentResource::collection($data);
    }
}
