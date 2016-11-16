<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Foodstand extends Model
{
	use Searchable;

	/**
	 * The users that belong to the role.
	 */

	protected $table = 'foodstands';

	public function users()
	{
		return $this->belongsToMany('App\Foodstand_User');
	}
}