<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment', 'user_id', 'seened_by'
    ];

    public function travel()
    {
        return $this->belongsTo('App\Models\Travel', 'travel_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('M d, Y g:i a', strtotime($value));
    }

    public function getCreatedAtAttribute($value)
    {
        return date('M d, Y g:i a', strtotime($value));
    }
}
