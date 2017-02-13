<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;

class User extends Authenticatable
{
    use Notifiable;
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

    public static function userSessionSetup(){
        $user = User::with('roles','types','foodstands', 'entertainers', 'events','agenda')->where('id', '=', Auth::user()->id)->first();

        //Get the product images
        $user = Images::getAllUserProductImages($user);

        //Get the agenda items
        $user = Agenda::getAllUserAgendaDetails($user);

        return $user;
    }

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
        return $this->belongsToMany('App\Entertainer');
    }

    public function events()
    {
        return $this->belongsToMany('App\Event');
    }

    public function agenda()
    {
        return $this->belongsToMany('App\Agenda');
    }

    public static function GetUserInfo() {
        $users = DB::table('users')->all();

        return $users;
    }

}
