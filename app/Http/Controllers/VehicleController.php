<?php

namespace App\Http\Controllers;

use App\Models\ListVehicle;
use App\Models\Travel;
use Illuminate\Http\Request;
use App\Http\Resources\DefaultResource;
use App\Http\Requests\VehicleRequest;
use App\Http\Resources\VehicleResource;

class VehicleController extends Controller
{
    public function page(){
        return view('user_admin.vehicle');
    }

    public function index($keyword)
    {
        ($keyword == '-') ? $keyword = '' : $keyword;
        $data = ListVehicle::with('group','user:id','user.profile:user_id,firstname,lastname')->where('name','LIKE','%'.$keyword.'%')->orderBy('id','DESC')->paginate(5);
        return VehicleResource::collection($data);
    }

    public function lists()
    {
        $data = ListVehicle::with('group','user')->orderBy('id','ASC')->get();
        return VehicleResource::collection($data);
    }

    public function store(VehicleRequest $request)
    {
        \DB::transaction(function () use ($request){
            if($request->editable){
                $data = ListVehicle::findOrFail($request->id);
                $data->update($request->except('editable'));
            }else{
                $data = ListVehicle::create($request->all());
            }

            return new DefaultResource($data);
        });
    }

    public function search(Request $request)
    {
        $keyword = $request->input('word');
        $data =  ListVehicle::where('name','LIKE','%'.$keyword.'%')->take(5)->get();

        return VehicleResource::collection($data);
    }

    public function check(Request $request)
    {
        $start = $request->start;
        $end = $request->end;

       $check = Travel::where('start_at','>=',$start)->where('end_at','>=',$end)->count();
        return $check = Travel::where('start_at','>=',$start)->where('end_at','>=',$end)->count();

        $keyword = $request->input('word');
        $data =  ListVehicle::where('name','LIKE','%'.$keyword.'%')->take(5)->get();

        return VehicleResource::collection($data);
    }
}
