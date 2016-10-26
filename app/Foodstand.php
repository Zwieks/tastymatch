<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Foodstand extends Model
{
	/**
	 * The users that belong to the role.
	 */

	public function users()
	{
		return $this->belongsToMany('App\Foodstand_User');
	}
}