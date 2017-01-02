<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

	public function Event(){
		return $this->hasOne('App\Detailpage');
	}

	public static function Add($userid, $detailpage_id, $component_id){
		$ComponentMediaitemUser = new ComponentMediaitem_User;

		$ComponentMediaitemUser->user_id = $userid;
		$ComponentMediaitemUser->detailpage_id = $detailpage_id;
		$ComponentMediaitemUser->component_mediaitem_id = $component_id;

		$ComponentMediaitemUser->save();
	}
}
