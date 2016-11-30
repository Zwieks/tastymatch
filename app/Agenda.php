<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Event;

class Agenda extends Model
{
	/**
	 * The users that belong to the role.
	 */


	public function users()
	{
		return $this->belongsToMany('App\Agenda_User');
	}

	public static function getAllUserAgendaDetails($user){
		//Get the comma separated image string from the database and get the images from the images table put this all in a new array
		foreach ($user->agenda as $item) {
			$item['info'] = event::where('id', '=', $item['event_id'])->first();
		}

		return $user;
	}
}
