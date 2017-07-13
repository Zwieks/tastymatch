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

	public static function store($userid,$foodstand_id,$data){
		$FoodstandUser = new Foodstand_User;
		$info = $data['info'];
		if(isset($userid) && $userid != '')
			$FoodstandUser->user_id = $userid;

		if(isset($foodstand_id) && $foodstand_id != '')
			$FoodstandUser->foodstand_id = $foodstand_id;

		$FoodstandUser->save();

		return $FoodstandUser->id;
	}
}
