<?php

namespace App\Http\Controllers\Employee;

use App\Models\Document;
use App\Models\DocumentRouting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\DefaultResource;
use App\Http\Resources\Trace\Notification\DocumentResource;

class DocumentController extends Controller
{   
    public function index($type,$completed,$keyword,$count)
    {
        $query = DocumentRouting::query();
        $query->with('document');
        $query->where('route_to',\Auth::user()->id);
        ($completed == '-') ? '' : $query->where('is_completed',$completed);
        $query->whereHas('document', function ($query) use ($type,$completed,$keyword){
            $query->where(function($query) use ($keyword) {
                $query->where('subject','LIKE','%'.$keyword.'%')->orWhere('route_slip','LIKE','%'.$keyword.'%');
            });
            ($type == '-') ? '' : $query->where('type_id',$type);
        });
        $data = $query->orderBy('created_at','DESC')->paginate($count);

        return DocumentResource::collection($data);
    }
}
