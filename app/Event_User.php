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

	public static function store($userid,$event_id,$data){
		$EventUser = new Event_User;
		$info = $data['info'];
		if(isset($userid) && $userid != '')
			$EventUser->user_id = $userid;

		if(isset($event_id) && $event_id != '')
			$EventUser->event_id = $event_id;

		$EventUser->save();

		return $EventUser->id;
	}
}
