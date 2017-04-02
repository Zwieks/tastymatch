<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
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

    public static function checkRelation(Request $request,$slug)
    {
        //Get the user information
        $userid = $request->session()->get('user.global.id');

        //Check if the user can access the page
        $record = Detailpage_User::checkUserRelation($userid,$slug);

        return $record;
    }

	public static function User(){
		return $this->hasOne('App\User');
	}

	public static function CheckPageStatus($detailpage_id,$userid){

		$check = DB::table('detailpage_user')
			->select('id')
			->where('detailpage_id', '=', $detailpage_id)
			->where('user_id', '=', $userid)
			->first();

		if(isset($check->id) && $check->id != ''){
			return $check->id;
		}else{
			return $check = '';
		}
	}

	public static function CheckPageState($detailpage_id,$userid){

		$check = DB::table('detailpages')
			->join('detailpage_user', 'detailpages.id', '=', 'detailpage_user.detailpage_id')
			->select('state')
			->where('detailpage_id', '=', $detailpage_id)
			->where('user_id', '=', $userid)
			->value('state');

		if(isset($check) && $check != ''){
			return $check;
		}else{
			return $check = '';
		}
	}

	/**
	 * Check if the slug is related to one of the page id's of the user
	 */
	protected static function checkUserRelation($userid, $slug){
		//Check if the pivot table
		$id = '';

		$record = DB::table('detailpage_user')
					->where('detailpage_id', '=', $slug)
					->where('user_id', '=', $userid)
					->first();

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
