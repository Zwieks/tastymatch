<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Event;
use Carbon\Carbon;

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
		$i = 0;
		//Get the comma separated image string from the database and get the images from the images table put this all in a new array
		foreach ($user->agenda as $item) {
        	$user['agenda'][$i]->date_start = Carbon::parse($item->date_start)->formatLocalized('%e %b %Y');
        	$user['agenda'][$i]->date_end = Carbon::parse($item->date_end)->formatLocalized('%e %b %Y');
			$item['info'] = event::where('id', '=', $item['event_id'])->first();
			$i++;
		}

		return $user;
	}
}
