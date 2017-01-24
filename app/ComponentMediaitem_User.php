<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class ComponentMediaitem_User extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'component_mediaitem_user';


	protected $fillable = array('user_id','component_mediaitem_id','detailpage_id');

	public $timestamps = true;

	public function User(){
		return $this->hasOne('App\User');
	}

	public function mediaItem(){
		return $this->hasOne('App\ComponentMediaitem_User');
	}

	public static function checkAlreadyUpdated($field,$detailpage_id,$userid,$mediaitem_id){
		$check = DB::table('component_mediaitem_user')
			->select($field)
			->where('detailpage_id', '=', $detailpage_id)
			->where('user_id', '=', $userid)
			->where('component_mediaitem_id', '=', $mediaitem_id)
			->first();

		if(isset($check->$field) && $check->$field != ''){
			return $check->$field;
		}else{
			return $check = '';
		}
	}

	public static function store($userid, $detailpage_id, $component_id){
		$ComponentMediaitemUser = new ComponentMediaitem_User;

		$ComponentMediaitemUser->user_id = $userid;
		$ComponentMediaitemUser->detailpage_id = $detailpage_id;
		$ComponentMediaitemUser->component_mediaitem_id = $component_id;

		$ComponentMediaitemUser->save();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  array $ids_to_delete
	 * @return \Illuminate\Http\Response
	 */
	public static function destroy($ids_to_delete)
	{
	   DB::table('component_mediaitem_user')->whereIn('id', $ids_to_delete)->delete();
	}
}
