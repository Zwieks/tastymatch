<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Images;

use Carbon\Carbon;
//Is searchable
use Laravel\Scout\Searchable;

use DB;
class Foodstand extends Model
{
	use Searchable;

	protected $table = 'foodstands';

	/**
	 * The users that belong to the foodstand.
	 */
	public function users()
	{
		return $this->belongsToMany('App\Foodstand_User');
	}

	/**
	 * Get the user foodstands based on the session
	 */
	public static function getUserFoodstands($user){

		//Check if the users does have foodstands else return an empty array
		if(isset($user->foodstands)){
			$foodstands = $user->foodstands;
		}else{
			$foodstands = [];
		}

		return $foodstands;
	}

	/**
	 * Get the EventId based on PagedId.
	 */
	public static function GetFoodstandId($pageId){
		$eventId = DB::table('foodstands')
		->select('id')
		->where('detailpage_id', '=', $pageId)
		->first();

		return $eventId->id;
	}

	//Get all the FOODSTANDS form ALL USERS
	public static function getAll(){
		$foodstands = DB::table('foodstands')->get();

		//Get the images
		$foodstands = images::getAllImages($foodstands);

		return $foodstands;
	}

	public static function getDetailPage($slug){
		//Get the DETAILPAGE ID of the selected item
		$result = DB::table('foodstands')
			->join('detailpages', 'foodstands.detailpage_id', '=', 'detailpages.id')
			->select('detailpage_id')
			->where('slug', $slug)
			->first();

		//If there is no results found redirect to notfoud page
		if(!isset($result->detailpage_id)){
			return false;
		}	
			
		//Get the DETAILPAGE CONTENT
        $page_content = Detailpage::with('getContact')
            ->with('getIntro')
            ->with('getMenu')
            ->with('getHeaderimage')
            ->with('getMediaItems')
            ->with('getFoodstand')
            ->with('getAgendaitems')
            ->findOrFail($result->detailpage_id);

        //Get the AGENDA DETAILS and put them in the array
        $page_content = Agenda::getAllUserAgendaDetails($page_content);   

        $page_content['detailpage_id'] = $result->detailpage_id;

		return $page_content;
	}

	public static function dataFormat($data){
		$foodstandInfo = [];

		foreach ($data['jsondata'] as $key => $value) {
			if(isset($value['form'])){
				//Get the element ID
				$elementId = $value['elementid'];

				if($elementId == 'component-intro'){
					foreach ($value['form'] as $item) {
						if(isset($item['title'])){
							$foodstandInfo['info']['slug'] =  createSlug($item['title']);
						}
					}
				}	

				if($elementId == 'component-menu'){
					$menu_items = '';
					foreach ($value['form'] as $item) {
						if(isset($item['menuitem'])){
							$menu_items = $menu_items.','.$item['menuitem'];
						}
					}

					$foodstandInfo['info']['menuitems'] = trim($menu_items, ",");
				}

				if($elementId == 'component-additionalinfo'){
					$foodstand_types = '';
					$tags = '';

					foreach ($value['form'] as $item) {
						if(isset($item['foodstand_type'])){
							$foodstand_types = $foodstand_types.','.$item['foodstand_type'];
							$tags = $tags.','.trans('foodstandtypes.type-'.$item['foodstand_type']);
						}

						if(isset($item['dimensionx'])){
							$foodstandInfo['info']['dimension_x'] = $item['dimensionx'];
						}

						if(isset($item['dimensiony'])){
							$foodstandInfo['info']['dimension_y'] = $item['dimensiony'];
						}
					}

					$foodstandInfo['info']['foodstand_types'] = trim($foodstand_types, ",");
					$foodstandInfo['info']['tags'] = trim($tags, ",");
				}
			}	
		}

		return $foodstandInfo;
	}

	public static function store($data){
		$Foodstand = new Foodstand;

		if(isset($data['info'])){
			$info = $data['info'];
		}else{
			$info = [];
		}

		if(isset($info['images_id']) && $info['images_id'] != '')
			$Foodstand->images_id = $info['images_id'];

		if(isset($info['videos_id']) && $info['videos_id'] != '')
			$Foodstand->videos_id = $info['videos_id'];

		if(isset($info['slug']) && $info['slug'] != '')
			$Foodstand->slug = $info['slug'];

		if(isset($info['searchable']) && $info['searchable'] != '')
			$Foodstand->searchable = $info['searchable'];

		if(isset($info['keywords']) && $info['keywords'] != '')
			$Foodstand->keywords = $info['keywords'];

		if(isset($info['detailpage_id']) && $info['detailpage_id'] != '')
			$Foodstand->detailpage_id = $info['detailpage_id'];

		if(isset($info['foodstand_types']) && $info['foodstand_types'] != '')
			$Foodstand->foodstandtype_ids = $info['foodstand_types'];

		if(isset($info['dimension_x']) && $info['dimension_x'] != '')
			$Foodstand->dimension_x = $info['dimension_x'];

		if(isset($info['dimension_y']) && $info['dimension_y'] != '')
			$Foodstand->dimension_y = $info['dimension_y'];

		if(isset($info['tags']) && $info['tags'] != '')
			$Entertainer->tags = $info['tags'];

		$Foodstand->save();

		return $Foodstand->id;		
	}	

	public static function updateFields($foodstand_id,$data){
		if(!isset($data['info']['images_id']))
			$data['info']['images_id'] = '';

		if(!isset($data['info']['videos_id']))
			$data['info']['videos_id'] = '';

		if(!isset($data['info']['slug']))
			$data['info']['slug'] = '';

		if(!isset($data['info']['long']))
			$data['info']['long'] = '';

		if(!isset($data['info']['lat']))
			$data['info']['lat'] = '';

		if(!isset($data['info']['keywords']))
			$data['info']['keywords'] = '';

		if(!isset($data['info']['foodstand_types']))
			$data['info']['foodstand_types'] = '';

		if(!isset($data['info']['dimension_x']))
			$data['info']['dimension_x'] = '';

		if(!isset($data['info']['dimension_y']))
			$data['info']['dimension_y'] = '';

		if(!isset($data['info']['tags']))
			$data['info']['tags'] = '';

		DB::table('foodstands')
	    	->where('id', $foodstand_id)
	    	->update([
	    		'images_id' => $data['info']['images_id'],
	    		'videos_id' => $data['info']['videos_id'],
	    		'slug' => $data['info']['slug'],
	    		'long' => $data['info']['long'],
	    		'lat' => $data['info']['lat'],
	    		'keywords' => $data['info']['keywords'],
	    		'foodstandtype_ids' => $data['info']['foodstand_types'],	
	    		'dimension_x' => $data['info']['dimension_x'],		    		
	    		'dimension_y' => $data['info']['dimension_y'],
	    		'tags' => $data['info']['tags']
	    	]);
	}		
}