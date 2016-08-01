<?php

namespace App\Http\Controllers\Auth;


use Socialite;
use Validator;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Carbon;
use Lang;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'lastname' => 'required|max:255',
            'gender' => 'required|max:25',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'day' => 'required|numeric',
            'month' => 'required|max:25',
            'year' => 'required|numeric',
            'tradename' => 'required|max:100',
            'streetnumber' => 'required|max:100',
            'zip' => 'required|max:10',
            'city' => 'required|max:100',
            'confirm' => 'required|filled',
            'user_type' => 'required|numeric',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $year = $data['year']; 
        $month = $data['month']; 
        $day = $data['day'];

        $DB_date = Carbon::createFromDate($year,$month,$day);

        return User::create([
            'name' => $data['name'],
            'lastname' => $data['lastname'],
            'gender' => $data['gender'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'birthday' => $DB_date,
            'tradename' => $data['tradename'],
            'streetnumber' => $data['streetnumber'],
            'zip' => $data['zip'],
            'city' => $data['city'],               
        ]);
    }


    protected $redirectPath = '/';

    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();
        } catch (Exception $e) {
            return redirect('auth/facebook');
        }

        $authUser = $this->findOrCreateUser($user);

        Auth::login($authUser, true);

        return redirect()->route('home');
    }

    /**
     * Return user if exists; create and return if doesn't
     *
     * @param $facebookUser
     * @return User
     */
    private function findOrCreateUser($facebookUser)
    {
        $authUser = User::where('facebook_id', $facebookUser->id)->first();

        if ($authUser){
            return $authUser;
        }

        return User::create([
            'name' => $facebookUser->name,
            'email' => $facebookUser->email,
            'facebook_id' => $facebookUser->id,
            'avatar' => $facebookUser->avatar
        ]);
    }
}
