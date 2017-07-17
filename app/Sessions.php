<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\User;
class Sessions extends Model
{
	//Set the global user sessions after the user is loggedin
	//Session is set in the User Controller
    public static function setGlobalUserSession(Request $request, $user){
	    if($request->session()->has('user.global')){
		    $request->session()->pull('user.global', '');
        }

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

	//When the user has been on the Blog detailpage the session will be set to affoid multple view counts in the database
	//Session is set in the Blog Controller
	public static function setSingleFoodstandSession(Request $request, $slug){
		//Set the Session
		$request->session()->put('viewed.foodstands'.$slug, true);

		return true;
	}

    //When the user has been on the Event detailpage the session will be set to affoid multple view counts in the database
    //Session is set in the Event Controller
    public static function setSingleEventSession(Request $request, $slug){
        //Set the Session
        $request->session()->put('viewed.events'.$slug, true);

        return true;
    }

    //When the user has been on the Entertainer detailpage the session will be set to affoid multple view counts in the database
    //Session is set in the Entertainer Controller
    public static function setSingleEntertainerSession(Request $request, $slug){
        //Set the Session
        $request->session()->put('viewed.entertainers'.$slug, true);

        return true;
    }

    //Destroys all current stored sessions
    public static function destroyAllSessions(Request $request){
    	//Set the Session
    	$request->session()->flush();

    	return true;
    }
}
