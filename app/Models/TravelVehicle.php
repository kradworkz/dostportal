<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelVehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id', 'travel_id'
    ];

    public function travel()
    {
        return $this->belongsTo('App\Models\Travel', 'travel_id', 'id');
    }

    public function vehicle()
    {
        return $this->belongsTo('App\Models\ListVehicle', 'vehicle_id', 'id');
    }

}
