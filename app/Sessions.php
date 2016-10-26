<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Sessions extends Model
{
	//Set the global user sessions after the user is loggedin
	//Session is set in the User Controller
    public static function setGlobalUserSession(Request $request, $user){
        //Set the Session
       	$request->session()->put('user.global', $user);

        return true;
    }

	//When the user has been on the Blog detailpage the session will be set to affoid multple view counts in the database
	//Session is set in the Blog Controller
    public static function setSingleBlogSession(Request $request, $slug){
        //Set the Session
        $request->session()->put('viewed.blog'.$slug, true);

        return true;
    }

    //Destroys all current stored sessions
    public static function destroyAllSessions(Request $request){
    	//Set the Session
    	$request->session()->flush();

    	return true;
    }
}
