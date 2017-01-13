<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Detailpage_User extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'detailpage_user';


	protected $fillable = array('user_id','detailpage_id');

	public $timestamps = true;

	public function User(){
		return $this->hasOne('App\User');
	}

	/**
	 * Check if the slug is related to one of the page id's of the user
	 */
	protected static function checkUserRelation($userid, $slug){
		//Check if the pivot table
		$id = '';

		$record = DB::table('detailpage_user')->where('detailpage_id', '=', $slug)->where('user_id', '=', $userid)->first();

		if(isset($record)){
			$id = $record->id;
		}

		return $id;
	}

	public function Entertainer(){
		return $this->hasOne('App\Detailpage');
	}

	public static function store($userid, $detailpage_id){
		$DetailpageUser = new Detailpage_User;

		$DetailpageUser->user_id = $userid;
		$DetailpageUser->detailpage_id = $detailpage_id;

		$DetailpageUser->save();
	}
}
