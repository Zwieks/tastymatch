<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entertainer_User extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'entertainer_user';


	protected $fillable = array('user_id','entertainer_id');

	public $timestamps = true;

	public function User(){
		return $this->hasOne('App\User');
	}

	public function Foodstand(){
		return $this->hasOne('App\Entertainer');
	}

	public function FoodstandType(){
		return $this->hasOne('App\EntertainerType');
	}
}
