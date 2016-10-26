<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodstandType extends Model
{

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $table = 'foodstandtypes';

	protected $fillable = [
		'name', 'name_en', 'description'
	];

	public function users(){
		return $this->belongsToMany('App\Foodstand_User');
	}
}
