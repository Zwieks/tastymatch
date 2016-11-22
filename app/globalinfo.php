<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Event;
use App\Images;

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
	public static function getProductOverviewInfo($type, $sort){
		//Check the content you want to obtain
		//Events, Foodstands or Entertainers
		if($type == null || $type == 'events'){
			$info = event::get();
		}elseif($type == 'foodstands'){
			$info = foodstand::get();
		}else{
			$info = entertainer::get();
		}

		//Get the product images
		$info = images::getProductImages($info);

		//Return the new object
		if($sort == 'most-viewed'){
			return $info->sortByDesc('views');
		}else if($sort == 'latest'){
			return $info->sortByDesc('created_at');
		}
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