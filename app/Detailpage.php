<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detailpage extends Model
{
	protected $table = 'detailpages';

	/**
	 * The users that belong to the entertainer.
	 */
	public function users()
	{
		return $this->belongsToMany('App\Detailpage_User');
	}

	//Get all the EVENTS
	public static function getAll(){
		$detailpages = DB::table('detailpages')->get();

		return $detailpages;
	}
}
