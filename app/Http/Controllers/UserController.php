<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Sessions;
use App\Foodstandtype;
use Auth;

class UserController extends Controller
{
    /**
     * Show a list of all of the application's users.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        //Check if the user is logged in
        if(Auth::user() == true){
            //$foodstand_categories = Foodstandtype::all();

            //Check if the blog is already been viewed by the user
            if (!$request->session()->has('user.global')) {
                $user = User::with('roles','types','foodstands')->where('id', '=', Auth::user()->id)->first();

                //Set User Data Session
                Sessions::setGlobalUserSession($request, $user);
            }   

            //return the view with the user session data
            return view('auth.home-loggedin')->with('user',$request->session()->get('user.global'));
        }
        else{
            return view('auth.home');
        }
    }
}