<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
	/**
	 * The users that belong to the role.
	 */

	public function users()
	{
		return $this->belongsToMany('App\Event_User');
	}
}
