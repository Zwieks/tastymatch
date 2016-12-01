<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Images;

//Is searchable
use Laravel\Scout\Searchable;

class Entertainer extends Model
{
	use Searchable;

	protected $table = 'entertainers';

	/**
	 * The users that belong to the entertainer.
	 */
	public function users()
	{
		return $this->belongsToMany('App\Entertainer_User');
	}

	//Get all the EVENTS
	public static function getAll(){
		$entertainers = DB::table('entertainers')->get();

		//Get the images
		$entertainers = images::getAllImages($entertainers);

		return $entertainers;
	}
}
