<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Detailpage_User;

use DB;

class Detailpage extends Model
{
	protected $table = 'detailpages';

	/**
	 * The users that belong to the entertainer.
	 */
	public function users()
	{
		return $this->belongsTo('App\Detailpage_User');
	}

	/**
	 * Get all the CONTACT components of the detailpages
	 */
	public function getIntro(){
		return $this->belongsTo('App\ComponentIntro','intro_id');
	}

	/**
	 * Get all the INTRO components of the detailpages
	 */
	public function getContact(){
		return $this->belongsTo('App\ComponentContact','contact_id');
	}

	/**
	 * Get all the MENU components of the detailpages
	 */
	public function getMenu(){
		return $this->belongsTo('App\ComponentMenu','menu_id');
	}

	/**
	 * Get all the HEADERIMAGE components of the detailpages
	 */
	public function getHeaderimage(){
		return $this->belongsTo('App\ComponentHeaderimage','headerimage_id');
	}

	/**
	 * Get all the MEDIA ITEMS components of the detailpages
	 */
	public function getMediaItems(){
		return $this->hasMany('App\ComponentMediaitem_User')
					->join('component_mediaitems', 'component_mediaitem_user.component_mediaitem_id', '=', 'component_mediaitems.id');
	}

	/**
	 * Get all the AGENDA ITEMS components of the detailpages
	 */
	public function agenda(){
		return $this->hasMany('App\Agenda');
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

	/**
	 * Update the state of the detailpage
	 * possilbe returns: new, preview, published
	 */
	public static function updateState($state,$detailpage_id){
		DB::table('detailpages')
			->where('id', $detailpage_id)
			->update(['state' => $state]);
	}

	static function checkAlreadyUpdated($field,$detailpage_id){
	    $check = DB::table('detailpages')
	    	->select($field)
	        ->where('id', '=', $detailpage_id)
	        ->first();
	        
	    return $check->$field;
	}

	public static function storeHeaderimage($detailpage_id, $component_id){
		DB::table('detailpages')
	    	->where('id', $detailpage_id)
	    	->update(['headerimage_id' => $component_id]);
	}

	public static function storeIntro($detailpage_id, $component_id){
		DB::table('detailpages')
	    	->where('id', $detailpage_id)
	    	->update(['intro_id' => $component_id]);
	}

	public static function storeContact($detailpage_id, $component_id){
		DB::table('detailpages')
	    	->where('id', $detailpage_id)
	    	->update(['contact_id' => $component_id]);
	}

	public static function storeMenu($detailpage_id, $menu){
		DB::table('detailpages')
	    	->where('id', $detailpage_id)
	    	->update(['menu_id' => $menu]);
	}

	/**
	 * Store the new create detailpage
	 */
	public static function store($userid){
		$Detailpage = new Detailpage;

		$Detailpage->state = 'new';
		$Detailpage->public = 1;

		$Detailpage->save();

		return $Detailpage->id;
	}
}
