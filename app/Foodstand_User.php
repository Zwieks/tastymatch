<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Foodstand;

class Foodstand_User extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'foodstand_user';


	protected $fillable = array('user_id','foodstand_id');

	public $timestamps = true;

	public function User(){
		return $this->hasOne('App\User');
	}

	public function Foodstand(){
		return $this->hasOne('App\Foodstand');
	}

	public function FoodstandType(){
		return $this->hasOne('App\FoodstandType');
	}
}
