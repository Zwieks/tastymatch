<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompontentMediaItem extends Model
{
    protected $table = 'component_mediaitems';

    /**
	 * The users that belong to the event.
	 */
	public function users()
	{
		return $this->belongsToMany('App\ComponentMediaitem_User');
	}

	//Get all the EVENTS
	public static function getAll(){
		$events = DB::table('component_mediaitem')->get();

		return $events;
	}
}
