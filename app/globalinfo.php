<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Event;

class GlobalInfo extends Model
{

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'global_info';

	public static function GetContactInfo() {
		$contactinfo = DB::table('global_info')->select('kvk', 'email')->first();

		return $contactinfo;
	}

	/**
	 * Get the global information based on product type 
	 * Used on overviewpages
	 *
	 * @var object
	 */
	public static function getProductOverviewInfo($type){
		//Check the content you want to obtain
		//Events, Foodstands or Entertainers
		if($type == null || $type == 'events'){
			$info = event::get();
		}elseif($type == 'foodstands'){
			$info = foodstand::get();
		}else{
			$info = entertainer::get();
		}

		//Get the comma separated image string from the database and get the images from the images table put this all in a new array
		foreach ($info as $item) {
			$ids = GlobalInfo::explodeString($item['images_id']);

			$item['images'] = images::whereIn('id', $ids)->get();
		}

		//Return the new object
		return $info;
	}

	/**
	 * Accessor for images_id property.
	 *
	 * @return array
	 */
	public static function explodeString($commaSeparatedIds)
	{
	    return explode(',', $commaSeparatedIds);
	}

}