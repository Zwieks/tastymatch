<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    /**
     * Show a list of all of the application's users.
     *
     * @return Response
     */
    public function index()
    {
        $users = DB::select('select * from users where id = ?', [1]);

        return view('auth.home', ['users' => $users]);

        //$users = User::with('roles')->get();
        //return view('auth.home')->with('users',$users);
    }
}