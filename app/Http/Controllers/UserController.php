<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;
use App\User;
use Auth;

class UserController extends Controller
{
    /**
     * Show a list of all of the application's users.
     *
     * @return Response
     */
    public function index()
    {
        //$users = DB::select('select * from users where id = ?', [1]);
        //return view('auth.home', ['users' => $users]);

        $users = User::with('roles','types')->where('id', '=', Auth::user()->id)->first();;
        return view('auth.home')->with('users',$users);
    }
}