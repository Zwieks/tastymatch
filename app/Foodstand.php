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

	//Get all the EVENTS
	public static function getAll(){
		$foodstands = DB::table('foodstands')->get();

		//Get the images
		$foodstands = images::getAllImages($foodstands);

		return $foodstands;
	}
}