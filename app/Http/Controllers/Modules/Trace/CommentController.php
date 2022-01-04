<?php

namespace App\Http\Controllers\Modules\Trace;

use App\Models\DocumentComment;
use App\Models\DocumentRouting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\DefaultResource;
use App\Http\Resources\Trace\PostCommentResource;
use App\Http\Resources\Trace\Notification\DocumentResource;

class CommentController extends Controller
{
    public function store(Request $request){
        $type = $request->type;

        if($type == 'routing'){
            $data = DocumentRouting::with('document')->where('document_id',$request->id)->where('route_to',\Auth::user()->id)->first();
            $data->is_seen_to = 1;
            $data->is_completed =1;
            $data->seened = now();
            $data->completed = now();

            if($data->save()){
                $data->comments()->create([
                    'user_id' => \Auth::user()->id,
                    'comment' => $request->text
                ]);
            }
            $data = $data->comments()->latest()->first();
        }else{
            $data = DocumentComment::find($request->input('id'));
            $data->comments()->create([
                'user_id' => \Auth::user()->id,
                'comment' => $request->input('comment')
            ]);
            $data = $data->comments()->latest()->first();
        }
        return new PostCommentResource($data);
    }
}
