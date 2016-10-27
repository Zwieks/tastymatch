<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event_User extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'event_user';


	protected $fillable = array('user_id','event_id');

	public $timestamps = true;

	public function User(){
		return $this->hasOne('App\User');
	}

	public function Event(){
		return $this->hasOne('App\Event');
	}

	public function EventType(){
		return $this->hasOne('App\EventType');
	}
}
