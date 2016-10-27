<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventType extends Model
{
	/**
	 * The associated table.
	 *
	 */
	protected $table = 'eventtypes';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'name_en', 'description'
	];

	public function users(){
		return $this->belongsToMany('App\Event_User');
	}
}
