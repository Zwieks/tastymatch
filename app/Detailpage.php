<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Detailpage_User;
use App\Images;

use File;
use Storage;
use URL;
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

	public static function checkPageType($detailpage_id, $type){
	    $result = Detailpage::with('getContact')
	            ->with('getIntro')
	            ->with('getMenu')
	            ->with('getHeaderimage')
	            ->with('getMediaItems')
	            ->with('agenda')
	            ->with('getEvent')
	            ->with('getFoodstand')	
	            ->with('getEntertainer')		                        
	            ->findOrFail($detailpage_id);
	    return $result;        
	}


	public static function PreviewComponentData($data){
		$eventInfo = [];
		$agendaInfo = [];

		foreach ($data['jsondata'] as $key => $value) {
			if(isset($value['table'])){
				$pieces = explode("_", $value['table']);

				if(isset($pieces[1])){
					$type = $pieces[1];
				}else{
					$type = '';
				}
				
				if($type != 'mediaitems'){
					$eventInfo['get'.ucwords($type)] = $value;

					if($type === 'agendaitems'){
						$uniqueId = $value['info']['random'];
						$inArray = false;

						foreach ($agendaInfo as $key => $item) {
							if($uniqueId == $item['info']['random']){
								$inArray = true;
							}
						}

						if($inArray == false){
							$agendaInfo[] = $value;
						}	

						$eventInfo['getAgendaItems'] = $agendaInfo;
					}
				}
			}

			if(isset($value['elementid'])){
				$pieces = explode("-", $value['elementid']);
				$type = $pieces[1];

				//CHECK IF THE IMAGE EXISTS
				$value = Images::checkImagePath($value);

				if($type == 'mediaitems'){
					//var_dump($pieces);
				}

				if(count($pieces) > 2 && $type == 'mediaitems'){
					$eventInfo['get'.ucwords($type).$pieces[2]] = $value;
				}else{
					$eventInfo['get'.ucwords($type)] = $value;
				}
			}

			if(isset($value['form'])){
				foreach ($value['form'] as $form_key => $form_value) {
					foreach ($form_value as $keyitem => $item) {
						if($keyitem === 'title')
							$keyitem = 'name';

						$eventInfo['get'.ucwords($type)][$keyitem] = $item;
					}
				}
			}
		}

		return $eventInfo;
	}	


	/**
	 * Get all the CONTACT components of the detailpages
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
	 * Get all the EVENTS of the user
	 */
	public function getEvent(){
		return $this->hasOne('App\Event');
	}

	/**
	 * Get all the FOODSTAND of the user
	 */
	public function getFoodstand(){
		return $this->hasOne('App\Foodstand');
	}

	/**
	 * Get all the ENTERTAINER of the user
	 */
	public function getEntertainer(){
		return $this->hasOne('App\Entertainer');
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
	public static function add($userid,$slug){
		//Create the detailpage and put the id also in the pivot table
		$detailpage_id = Detailpage::store($userid,$slug);
		Detailpage_User::store($userid, $detailpage_id);

		return $detailpage_id;
	}

	/**
	 * Create content for the preview page
	 * possilbe returns: View
	 */
	public static function previewPage($data,$type){
		
	}

	/**
	 * Update the state of the detailpage
	 * possilbe returns: new, preview, published
	 */
	public static function updateState($state,$detailpage_id,$type,$view_state){
		DB::table('detailpages')
			->where('id', $detailpage_id)
			->update(['state' => $state, 'type' => $type, 'public' => $view_state]);
	}

	static function CheckAlreadyUpdated($field,$detailpage_id){
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
	public static function store($userid,$type){
		$Detailpage = new Detailpage;

		$Detailpage->state = 'concept';
		$Detailpage->type = $type;
		$Detailpage->public = 0;

		$Detailpage->save();

		return $Detailpage->id;
	}
}
