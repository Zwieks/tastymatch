<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Images;

//Is searchable
use Laravel\Scout\Searchable;

class Foodstand extends Model
{
	use Searchable;

	protected $table = 'foodstands';

	/**
	 * The users that belong to the foodstand.
	 */
	public function users()
	{
		return $this->belongsToMany('App\Foodstand_User');
	}

	/**
	 * Get the user foodstands based on the session
	 */
	public static function getUserFoodstands($user){

		//Check if the users does have foodstands else return an empty array
		if(isset($user->foodstands)){
			$foodstands = $user->foodstands;
		}else{
			$foodstands = [];
		}

		return $foodstands;
	}

	//Get all the FOODSTANDS form ALL USERS
	public static function getAll(){
		$foodstands = DB::table('foodstands')->get();

		//Get the images
		$foodstands = images::getAllImages($foodstands);

		return $foodstands;
	}
}