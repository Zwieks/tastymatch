<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type_User extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'type_user';


	protected $fillable = array('user_id','type_id');

	public $timestamps = true;

	public function User(){
		return $this->hasOne('App\User');
	}

	public function Role(){
		return $this->hasOne('App\Type');
	}
}
