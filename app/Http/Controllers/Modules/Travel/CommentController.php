<?php

namespace App\Http\Controllers\Modules\Travel;

use App\Models\Travel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\DefaultResource;
use App\Http\Resources\Modules\Travel\CommentResource;
use App\Http\Resources\Modules\Travel\NotificationComment;
use App\Events\TravelEvent;

class CommentController extends Controller
{
    public function store(Request $request){
        $data = Travel::findOrFail($request->id);
        $data->comments()->create([
            'comment' => $request->text,
            'user_id' => \Auth::user()->id,
            'seened_by' => "[]"
        ]);

        $data = $data->comments()->latest()->first();
        broadcast(new TravelEvent(new NotificationComment($data)));
        return new CommentResource($data);
    }
}
