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

	public static function store($data){
		$Event = new Event;
		$info = $data['info'];
		if(isset($info['name']) && $info['name'] != '')
			$Event->name = $info['name'];

		if(isset($info['description']) && $info['description'] != '')
			$Event->description = $info['description'];

		if(isset($info['location']) && $info['location'] != '')
			$Event->location = $info['location'];

		if(isset($info['long']) && $info['long'] != '')
			$Event->long = $info['long'];

		if(isset($info['lat']) && $info['lat'] != '')
			$Event->lat = $info['lat'];

		if(isset($info['searchable']) && $info['searchable'] != '')
			$Event->searchable = $info['searchable'];

		if(isset($info['eventtype']) && $info['eventtype'] != '')
			$Event->type_id = $info['eventtype'];

		$Event->save();

		return $Event->id;
	}

	//Get all the EVENTS
	public static function getAll(){
		$events = DB::table('events')->get();

		//Get the images
		$events = images::getAllImages($events);

		return $events;
	}
}
