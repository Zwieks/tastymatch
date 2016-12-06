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

	public static function GetAllItems() {
		$allInfo = DB::table('global_info')->get();

		return $allInfo;
	}

	public static function GetContactInfo() {
		$contactinfo = DB::table('global_info')->select('kvk', 'email')->first();

		return $contactinfo;
	}

	//Set the corresponding URL
	public static function GetCorrespondingUrl($all_items){
		foreach($all_items as $key => $object){
			if(strtolower($key) == 'events' || strtolower($key)=='evenementen'){
				$slug = strtolower(trans('products.product-event'));

				foreach ($object as $value) {
					$value->url = $slug;
				}

			}elseif(strtolower($key) == 'foodstands'){
				$slug = strtolower(trans('products.product-foodstand'));

				foreach ($object as $value) {
					$value->url = $slug;
				}
			}elseif(strtolower($key) == 'entertainers'){
				$slug = strtolower(trans('products.product-entertainer'));

				foreach ($object as $value) {
					$value->url = $slug;
				}
			}
		}

		return $all_items;
	}

	/**
	 * Merge the user items into one json object
	 *
	 * @var object
	 */
	public static function MergeUserProducts($user){
		$array = json_decode($user);

		$object = [];

		foreach($array as $key => $items){
			if($key == 'events' || $key == 'foodstands' || $key == 'entertainers'){
				$object[$key] = $items;
			}
		}

		$object = globalinfo::GetCorrespondingUrl($object);

		foreach($object as $key => $items){
			if(!empty($items)) {
				if ($key == 'events' || $key == 'foodstands' || $key == 'entertainers') {
					foreach ($items as $item) {
						if(!empty($items)) {
							$object[$key] = $item;
						}
					}
				}
			}else{
				unset($object[$key]);
			}
		}

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

		$all_items = globalinfo::GetCorrespondingUrl(json_decode($all_items));
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