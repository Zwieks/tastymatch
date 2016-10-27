<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntertainerType extends Model
{

	/**
	 * The associated table.
	 *
	 */
	protected $table = 'entertainertypes';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'name_en', 'description'
	];

	public function users(){
		return $this->belongsToMany('App\Entertainer_User');
	}
}
