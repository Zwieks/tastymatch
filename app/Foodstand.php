<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Images;
use DB;

//Is searchable
use Laravel\Scout\Searchable;

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
			
		//Get the DETAILPAGE CONTENT
        $page_content = Detailpage::with('getContact')
            ->with('getIntro')
            ->with('getMenu')
            ->with('getHeaderimage')
            ->with('getMediaItems')
            ->with('agenda')
            ->findOrFail($result->detailpage_id);

        //Get the AGENDA DETAILS and put them in the array
        $page_content = Agenda::getAllUserAgendaDetails($page_content);   

        $page_content['detailpage_id'] = $result->detailpage_id;

		return $page_content;
	}
}