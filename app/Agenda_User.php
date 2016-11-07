<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agenda_User extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'agenda_user';


	protected $fillable = array('user_id','agenda_id');

	public $timestamps = true;

	public function User(){
		return $this->hasOne('App\User');
	}

	public function Agenda(){
		return $this->hasOne('App\Agenda');
	}
}
