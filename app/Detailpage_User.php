<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detailpage_User extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'detailpage_user';


	protected $fillable = array('user_id','detailpage_id');

	public $timestamps = true;

	public function User(){
		return $this->hasOne('App\User');
	}

	public function Entertainer(){
		return $this->hasOne('App\Detailpage');
	}

	public static function Add($userid, $detailpage_id){
		$DetailpageUser = new Detailpage_User;

		$DetailpageUser->user_id = $userid;
		$DetailpageUser->detailpage_id = $detailpage_id;

		$DetailpageUser->save();
	}
}
