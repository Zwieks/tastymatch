<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Images;

//Is searchable
use Laravel\Scout\Searchable;

class Event extends Model
{
	use Searchable;

	protected $table = 'events';

	/**
	 * The users that belong to the event.
	 */
	public function users()
	{
		return $this->belongsToMany('App\Event_User');
	}

	//Get all the EVENTS
	public static function getAll(){
		$events = DB::table('events')->get();

		//Get the images
		$events = images::getAllImages($events);

		return $events;
	}
}
