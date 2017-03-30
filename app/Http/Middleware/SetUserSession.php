<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use App\Sessions;
use Auth;

class SetUserSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
         if(Auth::user() == true){
            //Check if the user is already loggedin and the session has been set
            if (!$request->session()->has('user.global')) {

                $user = User::userSessionSetup();

                //Set User Data Session
                Sessions::setGlobalUserSession($request, $user);
                 return redirect('/');
            }

        }else{
            return redirect('/');
        }
        
        return $next($request);
    }
}
