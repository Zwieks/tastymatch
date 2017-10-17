<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Images;

use Carbon\Carbon;
//Is searchable
use Laravel\Scout\Searchable;

use DB;
class Entertainer extends Model
{
	use Searchable;

	protected $table = 'entertainers';

	/**
	 * The users that belong to the entertainer.
	 */
	public function users()
	{
		return $this->belongsToMany('App\Entertainer_User');
	}

	/**
	 * Get the user entertainers based on the session
	 */
	public static function getUserEntertainers($user){

		//Check if the users does have entertainers else return an empty array
		if(isset($user->entertainers)){
			$entertainers = $user->entertainers;
		}else{
			$entertainers = [];
		}

		return $entertainers;
	}

	//Get all the EVENTS
	public static function getAll(){
		$entertainers = DB::table('entertainers')->get();

		//Get the images
		$entertainers = images::getAllImages($entertainers);

		return $entertainers;
	}

		/**
	 * Get the EntertainerId based on PagedId.
	 */
	public static function GetEntertainerId($pageId){
		$entertainerId = DB::table('entertainers')
		->select('id')
		->where('detailpage_id', '=', $pageId)
		->first();

		return $entertainerId->id;
	}

	public static function getDetailPage($slug){
		//Get the DETAILPAGE ID of the selected item
		$result = DB::table('entertainers')
			->join('detailpages', 'entertainers.detailpage_id', '=', 'detailpages.id')
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
            ->with('getHeaderimage')
            ->with('getMediaItems')
            ->with('getEntertainer')
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

				if($elementId == 'component-additionalinfo'){
					$entertainer_types = '';
					$subentertainer_types = '';
					$tags = '';
					$category = '';

					foreach ($value['form'] as $key => $item) {
						if(isset($item['entertainer_type'])){
							$entertainer_types = $entertainer_types.','.$item['entertainer_type'];
							$tags = $tags.','.trans('entertainertypes.type-'.$item['entertainer_type'].'.label');
							$category = $category.','.trans('entertainertypes.type-'.$item['entertainer_type'].'.label');
						}

						if(isset($item['subentertainer_type'])){
							$array = trans('entertainertypes');

						    foreach ($array as $parentIndex => $parentValue) {
						        foreach ($parentValue as $index => $value) {
						            if ($value == $item['subentertainer_type']) {
						            	$subentertainer_types = $subentertainer_types.','.substr($parentIndex, -1).'-'.substr($index, -1);
						               	$tags = $tags.','.trans('entertainertypes.'.$parentIndex.'.'.$index);
						            }
						        }
						    }
						}					
					}

					$foodstandInfo['info']['entertainer_types'] = trim($entertainer_types, ",");
					$foodstandInfo['info']['subentertainer_types'] = trim($subentertainer_types, ",");
					$foodstandInfo['info']['tags'] = trim($tags, ",");
					$foodstandInfo['info']['category'] = trim($category, ",");
				}
			}	
		}
		return $foodstandInfo;
	}

	public static function store($data){
		$Entertainer = new Entertainer;

		if(isset($data['info'])){
			$info = $data['info'];
		}else{
			$info = [];
		}

		if(isset($info['images_id']) && $info['images_id'] != '')
			$Entertainer->images_id = $info['images_id'];

		if(isset($info['videos_id']) && $info['videos_id'] != '')
			$Entertainer->videos_id = $info['videos_id'];

		if(isset($info['slug']) && $info['slug'] != '')
			$Entertainer->slug = $info['slug'];

		if(isset($info['searchable']) && $info['searchable'] != '')
			$Entertainer->searchable = $info['searchable'];

		if(isset($info['keywords']) && $info['keywords'] != '')
			$Entertainer->keywords = $info['keywords'];

		if(isset($info['detailpage_id']) && $info['detailpage_id'] != '')
			$Entertainer->detailpage_id = $info['detailpage_id'];

		if(isset($info['entertainer_types']) && $info['entertainer_types'] != '')
			$Entertainer->entertainertype_ids = $info['entertainer_types'];

		if(isset($info['tags']) && $info['tags'] != '')
			$Entertainer->tags = $info['tags'];

		if(isset($info['category']) && $info['category'] != '')
			$Entertainer->categories = $info['category'];

		if(isset($info['subentertainer_types']) && $info['subentertainer_types'] != '')
			$Entertainer->subentertainertype_ids = $info['subentertainer_types'];

		$Entertainer->save();

		return $Entertainer->id;		
	}


	public static function updateFields($entertainer_id,$data){
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

		if(!isset($data['info']['entertainer_types']))
			$data['info']['entertainer_types'] = '';

		if(!isset($data['info']['tags']))
			$data['info']['tags'] = '';

		if(!isset($data['info']['category']))
			$data['info']['category'] = '';

		if(!isset($data['info']['subentertainer_types']))
			$data['info']['subentertainer_types'] = '';

		DB::table('entertainers')
	    	->where('id', $entertainer_id)
	    	->update([
	    		'images_id' => $data['info']['images_id'],
	    		'videos_id' => $data['info']['videos_id'],
	    		'slug' => $data['info']['slug'],
	    		'long' => $data['info']['long'],
	    		'lat' => $data['info']['lat'],
	    		'keywords' => $data['info']['keywords'],
	    		'entertainertype_ids' => $data['info']['entertainer_types'],
	    		'tags' => $data['info']['tags'],
	    		'categories' => $data['info']['category'],
	    		'subentertainertype_ids' => $data['info']['subentertainer_types']
	    	]);
	}
}
