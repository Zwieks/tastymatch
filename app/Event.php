<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Event extends Model
{
	use Searchable;

	/**
	 * The users that belong to the role.
	 */

	public function users()
	{
		return $this->belongsToMany('App\Event_User');
	}
}
