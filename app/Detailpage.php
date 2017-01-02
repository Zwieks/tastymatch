<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Detailpage_User;

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

	public static function Add($userid){
		$Detailpage = new Detailpage;

		$Detailpage->state = 'published';
		$Detailpage->public = 1;

		$Detailpage->save();

		return $Detailpage->id;
	}
}
