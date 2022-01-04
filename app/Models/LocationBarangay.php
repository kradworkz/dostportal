<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationBarangay extends Model
{
    use HasFactory;

    public function municipality()
    {
        return $this->belongsTo('App\Models\Municipality', 'municipality_id', 'id');
    }

    public function address()
    {
        return $this->hasMany('App\Models\Address', 'barangay_id');
    }

    public function eventaddress()
    {
        return $this->hasMany('App\Models\EventAddress', 'barangay_id');
    }
}
