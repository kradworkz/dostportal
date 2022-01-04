<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dropdown extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    // public function roles()
    // {
    //     return $this->hasMany('App\Models\UserRole', 'role_id');
    // } 

    public function mode()
    {
        return $this->hasMany('App\Models\Travel', 'mode_id');
    } 

    public function status()
    {
        return $this->hasMany('App\Models\Travel', 'status_id');
    } 

    public function salaries()
    {
        return $this->hasMany('App\Models\Position', 'salary_id');
    } 

    public function departments()
    {
        return $this->hasMany('App\Models\UserEmployee', 'department_id');
    }

    public function employementstatus()
    {
        return $this->hasMany('App\Models\UserEmployee', 'status_id');
    }

    public function users()
    {
        return $this->morphToMany(User::class, 'userable');
    }
    
    public function getColorAttribute($value)
    {
        if($value == 'violet' ){
            return 'primary';
        }else if($value == 'blue'){
            return 'info';
        }else if($value == 'red'){
            return 'danger';
        }else if($value == 'yellow'){
            return 'warning';
        }else if($value == 'black'){
            return 'dark';
        }else if($value == 'gray'){
            return 'secondary';
        }else{
            return 'success';
        }
    }

}
