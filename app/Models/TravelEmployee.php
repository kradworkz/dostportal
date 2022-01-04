<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelEmployee extends Model
{
    use HasFactory;

    // protected $attributes = [
    //     'seened_by' => []
    // ];

    protected $fillable = [
        'user_id', 'travel_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function travel()
    {
        return $this->belongsTo('App\Models\Travel', 'travel_id', 'id');
    }
}
