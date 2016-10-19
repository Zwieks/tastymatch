<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role_User extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'role_user';


	protected $fillable = array('user_id','role_id');

	public $timestamps = true;

	public function User(){
		return $this->hasOne('App\User');
	}

	public function Role(){
		return $this->hasOne('App\Role');
	}
}
