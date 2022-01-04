<?php

namespace App\Http\Controllers;

use App\Models\ListRole;
use Illuminate\Http\Request;
use App\Http\Resources\DefaultResource;

class RoleController extends Controller
{
    public function page(){
        return view('user_admin.role');
    }

    public function index($keyword)
    {
        ($keyword == '-') ? $keyword = '' : $keyword;
        $data = ListRole::where('name','LIKE','%'.$keyword.'%')->orderBy('id','DESC')->paginate(5);
        return DefaultResource::collection($data);
    }

    public function lists()
    {
        $data = ListRole::orderBy('id','ASC')->get();
        return DefaultResource::collection($data);
    }

    public function store(Request $request)
    {
        \DB::transaction(function () use ($request){
            if($request->editable){
                $data = ListRole::findOrFail($request->id);
                $data->update($request->except('editable'));
            }else{
                $data = ListRole::create($request->all());
            }

            return new DefaultResource($data);
        });
    }

    public function search(Request $request)
    {
        $keyword = $request->input('word');
        $data =  ListRole::where('name','LIKE','%'.$keyword.'%')->take(5)->get();

        return DefaultResource::collection($data);
    }
}
