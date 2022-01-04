<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEmployee extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $fillable = ['department_id', 'position_id', 'status_id'];

    public function department()
    {
        return $this->belongsTo('App\Models\Dropdown', 'department_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\Dropdown', 'status_id', 'id');
    }

    public function position()
    {
        return $this->belongsTo('App\Models\ListPosition', 'position_id', 'id');
    }

}
