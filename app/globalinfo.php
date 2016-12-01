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
	 * Merge the user items into one json object
	 *
	 * @var object
	 */
	public static function MergeUserProducts($user){

		//Decode the user json
		$array = json_decode($user);

		//Get the sub URL
		foreach ($array->events as $value) {
			$value->url = strtolower(trans('products.product-event'));
		}

		foreach ($array->foodstands as $value) {
			$value->url = strtolower(trans('products.product-foodstand'));
		}

		foreach ($array->entertainers as $value) {
			$value->url = strtolower(trans('products.product-entertainer'));
		}


		//Merge the EVENTS, FOODSTANDS and ENTERTAINERS arrays and create a new json object
		$object = array_merge($array->events, $array->foodstands, $array->entertainers);

		return $object;
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

	/**
	 * Get them most populair items by month
	 *
	 * @return object
	 */
	public static function GetMostPopulairItems($all_items)
	{
		$all_items =  json_decode($all_items);
		$builder = [];

		foreach($all_items as $key => $item_list){
			foreach($item_list as $items)   {

				//Check if the image array is empty, ifso put our placeholder in the object
				if(empty($items->images)){
					$object = (object) ['file' => 'logo.svg', 'caption' => 'TastyMatch logo', 'description' => ''];
					$items->images[0] = $object;
				}

				$builder[] = (array)$items;
			}
		}

		//Sort on Views
		uasort($builder, function($a,$b) {
			if ($a['views'] == $b['views'])
				return 0;

			return ($a['views'] > $b['views']) ? -1 : 1;
		});

		//Return the first 6 items
		return json_encode((object)array_slice($builder, 0, 6));
	}
}