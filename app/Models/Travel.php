<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    use HasFactory;

    protected $table = 'travels';
    protected $fillable = [
        'code',
        'destination',
        'information',
        'mode_id',
        'user_id',
        'status_id',
        'start_at',
        'end_at',
        'is_vehicle'
    ];

    public function vehicle()
    {
        return $this->hasOne('App\Models\TravelVehicle', 'travel_id');
    } 

    public function employees()
    {
        return $this->hasMany('App\Models\TravelEmployee', 'travel_id');
    } 

    public function comments()
    {
        return $this->hasMany('App\Models\TravelComment', 'travel_id');
    } 

    public function statuses()
    {
        return $this->hasMany('App\Models\TravelStatus', 'travel_id');
    } 

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\Dropdown', 'status_id', 'id');
    }

    public function mode()
    {
        return $this->belongsTo('App\Models\Dropdown', 'mode_id', 'id');
    }

    public function getStartAtAttribute($value)
    {
        return date('M d, Y g:i a', strtotime($value));
    }

    public function getEndAtAttribute($value)
    {
        return date('M d, Y g:i a', strtotime($value));
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
