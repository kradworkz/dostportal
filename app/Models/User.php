<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'type',
        'status',
        'avatar'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile()
    {
        return $this->hasOne('App\Models\UserProfile', 'user_id');
    } 

    public function employee()
    {
        return $this->hasOne('App\Models\UserEmployee', 'user_id');
    } 

    public function vehicle()
    {
        return $this->hasOne('App\Models\ListVehicle', 'user_id');
    } 

    public function comments()
    {
        return $this->hasMany('App\Models\DocumentComment', 'user_id');
    } 

    public function groups()
    {
        return $this->morphedByMany(ListGroup::class, 'userable');
    }

    public function roles()
    {
        return $this->morphedByMany(ListRole::class, 'userable');
    }


    // public function roles()
    // {
    //     return $this->morphedByMany('App\User', 'withable');
    // }

 
    // public function groups()
    // {
    //     return $this->hasMany('App\Models\UserWith', 'user_id')->with('withable');
    // } 

    public function hasRole($roles)
    {
        foreach ($roles as $role) {
            foreach($this->roles as $r){
                if($r->name == $role){
                    return true;
                }
            } 
        }
        return false;
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
