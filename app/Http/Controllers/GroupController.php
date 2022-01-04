<?php

namespace App\Http\Controllers;

use App\Models\ListGroup;
use Illuminate\Http\Request;
use App\Http\Resources\DefaultResource;

class GroupController extends Controller
{
    public function page(){
        return view('user_admin.group');
    }

    public function index($keyword)
    {
        ($keyword == '-') ? $keyword = '' : $keyword;
        $data = ListGroup::where('name','LIKE','%'.$keyword.'%')->orderBy('id','DESC')->paginate(5);
        return DefaultResource::collection($data);
    }

    public function lists()
    {
        $data = ListGroup::orderBy('id','ASC')->get();
        return DefaultResource::collection($data);
    }

    public function store(Request $request)
    {
        \DB::transaction(function () use ($request){
            if($request->editable){
                $data = ListGroup::findOrFail($request->id);
                $data->update($request->except('editable'));
            }else{
                $data = ListGroup::create($request->all());
            }

            return new DefaultResource($data);
        });
    }

    public function search(Request $request)
    {
        $keyword = $request->input('word');
        $data =  ListGroup::where('name','LIKE','%'.$keyword.'%')->take(5)->get();

        return DefaultResource::collection($data);
    }
}
