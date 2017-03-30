<?php
namespace App\Http\Controllers\Auth;
use App\User;
use App\Type_User;
use App\Role_User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Carbon;
use Lang;

class RegisterController extends Controller
{
	/*
	|--------------------------------------------------------------------------
	| Register Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users as well as their
	| validation and creation. By default this controller uses a trait to
	| provide this functionality without requiring any additional code.
	|
	*/
	use RegistersUsers;
	/**
	 * Where to redirect users after login / registration.
	 *
	 * @var string
	 */
	protected $redirectTo = '/';
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
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
			'tradename' => 'max:100',
			'streetnumber' => 'max:100',
			'zip' => 'max:10',
			'city' => 'max:100',
			'confirm' => 'required|filled',
			'type' => 'required|numeric',
		]);
	}

	/**
	 * Check if the KVK input fields are set.
	 *
	 * @param  array  $data
	 * @return data
	 */
	protected function checkkvk($data){
		if(!isset($data['tradename'])){
			$data['tradename'] = '';
		}

		if(!isset($data['streetnumber'])){
			$data['streetnumber'] ='';
		}

		if(!isset($data['zip'])){
			$data['zip'] = '';
		}

		if(!isset($data['city'])){
			$data['city'] = '';
		}

		return $data;
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

		//check KVK inputs
		$data = $this->checkkvk($data);

		//Set role id
		$data['role_id'] = 1;

		//Insert new user in DB
		$user = User::create([
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

		//Get current user id
		$id = $user->id;

		//Get current user type
		$type = $data['type'];

		//Insert new user in role_user table
		Role_User::create([
			'user_id' =>  $id,
			'role_id' => 1,
		]);

		//Insert new user in type_user table
		Type_User::create([
			'user_id' =>  $id,
			'type_id' => $type,
		]);

		return $user;
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