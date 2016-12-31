<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComponentMediaitemUser extends Model
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
}
