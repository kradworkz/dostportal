<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\StringFixer;

class ListVehicle extends Model
{
    use HasFactory;

    protected $fillable = ['name','destination','plate','group_id','user_id'];

    public function getNameAttribute($value){
        return StringFixer::uppercaseExcept($value);
    }

    public function getPlateAttribute($value){
        return strtoupper($value);
    }

    public function getDestinationAttribute($value){
        return ucwords($value);
    }

    public function group()
    {
        return $this->belongsTo('App\Models\ListGroup', 'group_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('M d, Y g:i:s a', strtotime($value));
    }

    public function getCreatedAtAttribute($value)
    {
        return date('M d, Y g:i:s a', strtotime($value));
    }
}
