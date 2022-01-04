<?php

namespace App\Http\Controllers\Employee;

use App\Models\Travel;
use App\Models\Document;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function counts()
    {
        $document = Document::whereHas('routings', function($q){
            $q->where('route_to',\Auth::user()->id)->where('is_completed',0);
        })->count();

        $travel = Travel::where('status_id',60)->whereHas('employees', function($q){
            $q->where('user_id',\Auth::user()->id);
        })->count();

        $data = [
            "document" => $document,
            "travel" => $travel
        ];

        return $data;
    }
}
