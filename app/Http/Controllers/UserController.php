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
        //Check if the user is logged in
        if(Auth::user() == true){
            $user = User::with('roles','types')->where('id', '=', Auth::user()->id)->first();
            return view('auth.home')->with('user',$user);
        }    
        else{
            return view('auth.home');
        }    
    }
}