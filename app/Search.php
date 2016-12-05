<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Images;

class Search extends Model
{
	//This function will be called on all the search in the header of the site
	public static function onPageSearch(Request $request){
		$posts = Search::getSearchResults($request);

		//Set the missing object items and unset empty elements
		if(!empty($posts)){
			$posts = Search::specializeObject($request, $posts);
		}

		return $posts;
	}

	//This function will be called on the search result page
	public static function onSearchResult(Request $request){
		$posts = json_encode(Search::getSearchResults($request));

		return $posts;
	}

    //Default search
	public static function getSearchResults(Request $request){
		// Making sure the user entered a keyword.
		if($request->has('q')) {

			//Using the Laravel Scout syntax to search the products table EVENT.
			$posts_event = Event::search($request->get('q'))->get();
			$posts_event = json_decode($posts_event);
			$posts_event = images::getAllImages($posts_event);
			$posts[trans('products.product-events')] = $posts_event;

			//Using the Laravel Scout syntax to search the products table FOODSTAND.
			$posts_foodstand = Foodstand::search($request->get('q'))->get();
			$posts_foodstand = json_decode($posts_foodstand);
			$posts_foodstand = images::getAllImages($posts_foodstand);
			$posts[trans('products.product-foodstands')] = $posts_foodstand;

			// Using the Laravel Scout syntax to search the products table ENTERTAINER.
			$posts_entertainer = Entertainer::search($request->get('q'))->get();
			$posts_entertainer = json_decode($posts_entertainer);
			$posts_entertainer = images::getAllImages($posts_entertainer);
			$posts[trans('products.product-entertainers')] = $posts_entertainer;

			//Check if keyword is in comma seperated string
			$posts[trans('products.product-event-keywords')] = (array) search::getMatchedKeywords('events',$posts[trans('products.product-events')],$request->get('q'));

			//Check if keyword is in comma seperated string
			$posts[trans('products.product-entertainer-keywords')] = (array) search::getMatchedKeywords('entertainers',$posts[trans('products.product-entertainers')],$request->get('q'));

			//Check if keyword is in comma seperated string
			$posts[trans('products.product-foodstand-keywords')] = (array) search::getMatchedKeywords('foodstands',$posts[trans('products.product-foodstands')],$request->get('q'));

			// If there are results return them alphabetically, if none, return the error message.
			ksort($posts);
			return $posts;
		}
	}

	public static function specializeObject(Request $request,$posts){
		foreach ($posts as $key => $post) {
			//Remove object when empty
			if(empty($posts[$key]) || empty((array) $posts[$key])){
				unset($posts[$key]);
			}else{
				foreach ($post as $index => $value) {
					//Set the proper URL
					if(!isset($value->url)){
						if(strtolower($key) == 'events' || strtolower($key)=='evenementen'){
							$slug = strtolower(trans('products.product-event'));
						}elseif(strtolower($key) == 'foodstands'){
							$slug = strtolower(trans('products.product-foodstand'));
						}elseif(strtolower($key) == 'entertainers'){
							$slug = strtolower(trans('products.product-entertainer'));
						}

						//Set the URL
						$value->url = $slug.'/';
					}

					//If the search input is not in the name remove it from the list
					if(isset($value->name)){
						$pos = stripos($value->name, $request->get('q'));
						if($pos === false){
							unset($posts[$key]);
						}

					}
				}
			}
		}

		return json_encode($posts);
	}


	public static function getMatchedKeywords($type,$items,$findme){
		$found_array = [];

		foreach ($items as $key => $value) {
			$keywords = explode(',', $value->keywords);

			if(!empty($keywords)){
				$count = 0;
				foreach ($keywords as $keyword) {
					$new_found_array = (object)[];
					$pos = stripos($keyword, $findme);
					$duplicate = false;

					if(isset($found_array[$count]) && $found_array[$count]->name == $keyword){
						$duplicate = true;
					}

					if ($pos !== false && $duplicate != true) {
						$new_found_array->name = $keyword;
						$new_found_array->keyword = true;
						$new_found_array->url = strtolower(trans('menus.search'));
						$new_found_array->slug = '?q='.$findme.'&type='.$type.'&keywords=on';

						$found_array[] = $new_found_array;
						$count++;
					}	

				}
			}
		}

		return $found_array;
	}
}
