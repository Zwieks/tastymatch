<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Images;
use Carbon\Carbon;
//Is searchable
use Laravel\Scout\Searchable;

use DB;
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

		if(isset($info['images_id']) && $info['images_id'] != '')
			$Event->images_id = $info['images_id'];

		if(isset($info['videos_id']) && $info['videos_id'] != '')
			$Event->videos_id = $info['videos_id'];

		if(isset($info['slug']) && $info['slug'] != '')
			$Event->slug = $info['slug'];

		if(isset($info['keywords']) && $info['keywords'] != '')
			$Event->keywords = $info['keywords'];

		if(isset($info['location']) && $info['location'] != '')
			$Event->location = $info['location'];

		if(isset($info['long']) && $info['long'] != '')
			$Event->long = $info['long'];

		if(isset($info['lat']) && $info['lat'] != '')
			$Event->lat = $info['lat'];

		if(isset($info['time_start']) && $info['time_start'] != '')
			$Event->time_start = Carbon::parse($info['time_start'])->format('Y-m-d');

		if(isset($info['time_end']) && $info['time_end'] != '')
			$Event->time_end = Carbon::parse($info['time_end'])->format('Y-m-d');

		if(isset($info['searchable']) && $info['searchable'] != '')
			$Event->searchable = $info['searchable'];

		if(isset($info['eventtype']) && $info['eventtype'] != '')
			$Event->type_id = $info['eventtype'];

		$Event->save();

		return $Event->id;
	}

	public static function updateFields($event_id,$data){
		if(!isset($data['info']['name']))
			$data['info']['name'] = '';

		if(!isset($data['info']['description']))
			$data['info']['description'] = '';

		if(!isset($data['info']['location']))
			$data['info']['location'] = '';

		if(!isset($data['info']['long']))
			$data['info']['long'] = '';

		if(!isset($data['info']['lat']))
			$data['info']['lat'] = '';

		if(!isset($data['info']['type_id']))
			$data['info']['type_id'] = '';

		DB::table('events')
	    	->where('id', $event_id)
	    	->update([
	    		'name' => $data['info']['name'],
	    		'description' => $data['info']['description'],
	    		'location' => $data['info']['location'],
	    		'long' => $data['info']['long'],
	    		'lat' => $data['info']['lat'],
	    		'type_id' => $data['info']['type_id']
	    	]);
	}	

	public static function checkRecord($field,$event_id,$userid){
		$check = DB::table('events')
			->select($field)
			->join('event_user', 'events.id', '=', 'event_user.event_id')
			->where('user_id', '=', $userid)
			->where('event_id', '=', $event_id)
			->first();

		if(isset($check->searchable)){
			return $check->searchable;
		}else{
			return $check = '';
		}
	}

	//Get all the EVENTS
	public static function getAll(){
		$events = DB::table('events')->get();

		//Get the images
		$events = images::getAllImages($events);

		return $events;
	}
}
