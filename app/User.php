<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'lastname', 'gender', 'birthday', 'tradename', 'streetnumber', 'zip', 'city'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
     return $this->belongsToMany('App\Role');
    }

    public function types()
    {
        return $this->belongsToMany('App\Type');
    }

    public function foodstands()
    {
        return $this->belongsToMany('App\Foodstand');
    }

    public function entertainers()
    {
        return $this->belongsToMany('App\entertainer');
    }

    public static function GetUserInfo() {
        $users = DB::table('users')->all();

        return $users;
    }

}
