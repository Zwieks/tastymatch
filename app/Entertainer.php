<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Entertainer extends Model
{
	use Searchable;

	/**
	 * The users that belong to the entertainer.
	 */

	public function users()
	{
		return $this->belongsToMany('App\Entertainer_User');
	}
}
