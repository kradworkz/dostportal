<?php

namespace App\Http\Controllers;

use App\Models\ListPosition;
use Illuminate\Http\Request;
use App\Http\Resources\DefaultResource;
use App\Http\Requests\PositionRequest;
use App\Http\Resources\PositionResource;

class PositionController extends Controller
{
    public function page(){
        return view('user_admin.position');
    }

    public function index($keyword)
    {
        ($keyword == '-') ? $keyword = '' : $keyword;
        $data = ListPosition::with('salary')->where('name','LIKE','%'.$keyword.'%')->orderBy('id','DESC')->paginate(5);
        return PositionResource::collection($data);
    }

    public function lists()
    {
        $data = ListPosition::orderBy('id','ASC')->get();
        return PositionResource::collection($data);
    }

    public function store(PositionRequest $request)
    {
        \DB::transaction(function () use ($request){
            if($request->editable){
                $data = ListPosition::findOrFail($request->id);
                $data->update($request->except('editable'));
            }else{
                $data = ListPosition::create($request->all());
            }

            return new DefaultResource($data);
        });
    }

    public function search(Request $request)
    {
        $keyword = $request->input('word');
        $data =  ListPosition::where('name','LIKE','%'.$keyword.'%')->take(5)->get();

        return PositionResource::collection($data);
    }

}
