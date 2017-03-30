<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Images;
use App\Agenda;
use App\Sessions;
use App\Foodstandtype;
use App\GoogleMaps; 
use App\globalinfo;
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

            //Check if the user is already loggedin and the session has been set
            if (!$request->session()->has('user.global')) {
                $user = User::userSessionSetup();

                //Set User Data Session
                Sessions::setGlobalUserSession($request, $user);
            }

            //Get the Google Maps locations from foodstands, entertainers and events
            $locations = GoogleMaps::getAllAgedaItemLocations($request);

            //Get the user information
            $user = $request->session()->get('user.global');

            //Get the user items
            $user_items = globalinfo::MergeUserProducts($user);

            //Get most populair items
            $most_viewed = globalinfo::GetMostPopulairItems($locations);

            //return the view with the user session data
            return view('auth.home-loggedin', compact('user','locations','user_items', 'most_viewed'));
        }
        else{
            return view('auth.home');
        }
    }
}