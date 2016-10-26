<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodstandType extends Model
{

	/**
	 * The associated table.
	 *
	 */
	protected $table = 'foodstandtypes';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'name_en', 'description'
	];

	public function users(){
		return $this->belongsToMany('App\Foodstand_User');
	}
}
