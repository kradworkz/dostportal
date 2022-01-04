<?php

namespace App\Services;

use App\Models\DocumentAttachment;
use App\Http\Resources\DefaultResource;

class StoreFile {

    public static function store($request,$id,$code) {

        if($request->hasFile('files'))
        {
            $files = $request->file('files');   
            foreach ($files as $key=>$file) {
                if($key == 0){
                    $file_name = $code.'.'.$file->getClientOriginalExtension();
                }else{
                    $file_name = $code.'-'.$key.'.'.$file->getClientOriginalExtension();
                }
                $file_path = $file->storeAs('uploads/'.$code, $file_name, 'public');

                $data = new DocumentAttachment;
                $data->document_id = $id;
                $data->name = pathinfo($file_name, PATHINFO_FILENAME);
                $data->path = $file_path;
                $data->save();
            }

            return new DefaultResource($data);
        }
    }
    
}