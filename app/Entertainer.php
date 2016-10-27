<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entertainer extends Model
{
	/**
	 * The users that belong to the role.
	 */

	public function users()
	{
		return $this->belongsToMany('App\Entertainer_User');
	}
}
