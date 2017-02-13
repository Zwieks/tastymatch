<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

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

	public static function store($userid, $agenda_id){
		$AgendaUser = new Agenda_User;

		$AgendaUser->user_id = $userid;
		$AgendaUser->agenda_id = $agenda_id;

		$AgendaUser->save();
	}

	public static function checkAlreadyUpdated($field,$event_id,$userid){
		$check = DB::table('agenda_user')
			->join('agendas', 'agenda_user.agenda_id', '=', 'agendas.id')
			->select($field)
			->where('event_id', '=', $event_id)
			->where('user_id', '=', $userid)
			->first();

		if(isset($check->$field) && $check->$field != ''){
			return $check->$field;
		}else{
			return $check = '';
		}
	}
}