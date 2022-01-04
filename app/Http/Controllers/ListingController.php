<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use App\Http\Resources\DefaultResource;
use App\Http\Requests\ListingRequest;

class ListingController extends Controller
{
    public function index(){

    }

    public function store(ListingRequest $request)
    {   
        $data = new Listing;
        $data->name = ucwords($request->name);
        $data->is_company = ($request->type == 'company') ? 1 : 0;
        $data->added_by = \Auth::user()->id;
        $data->save();

        return new DefaultResource($data);
    }

    public function search(Request $request)
    {
        $keyword = $request->word;
        $type = ($request->type == 'company') ? $type = 1 : $type = 0;

        $data =  Listing::where('name','LIKE','%'.$keyword.'%')->where('is_company',$type)->take(5)->get();
        return DefaultResource::collection($data);
    }

}
