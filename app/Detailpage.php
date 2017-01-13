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

	/**
	 * Create a detailpage for an user. Common use on buttons
	 *
	 * @return \Illuminate\Http\Response
	 */
	public static function add($userid){
		//Create the detailpage and put the id also in the pivot table
		$detailpage_id = Detailpage::store($userid);
		Detailpage_User::store($userid, $detailpage_id);

		return $detailpage_id;
	}

	public static function store($userid){
		$Detailpage = new Detailpage;

		$Detailpage->state = 'published';
		$Detailpage->public = 1;

		$Detailpage->save();

		return $Detailpage->id;
	}
}
