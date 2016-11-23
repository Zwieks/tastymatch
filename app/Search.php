<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Search extends Model
{
    //Default search
	public static function getSearchResults(Request $request){

		// First we define the error message we are going to show if no keywords
		// existed or if no results found.
		$error_text = [['name' => 'No results found, please try with different keywords.']];
		$error =  json_encode($error_text);

		// Making sure the user entered a keyword.
		if($request->has('q')) {

			// Using the Laravel Scout syntax to search the products table EVENT.
			$posts_event = Event::search($request->get('q'))->get();
			$posts_event = json_decode($posts_event);

			// Using the Laravel Scout syntax to search the products table FOODSTAND.
			$posts_foodstand = Foodstand::search($request->get('q'))->get();
			$posts_foodstand = json_decode($posts_foodstand);

			// Using the Laravel Scout syntax to search the products table ENTERTAINER.
			$posts_entertainer = Entertainer::search($request->get('q'))->get();
			$posts_entertainer = json_decode($posts_entertainer);

			// Merge all the array's into one
			$posts = json_encode(array_merge($posts_event, $posts_foodstand, $posts_entertainer));

			// If there are results return them, if none, return the error message.
			return $posts;
		}

		// Return the error message if no keywords existed
		return $error;
	}

	//Autocomplete search
	public static function getAutoCompleteResults(Request $request){
		// First we define the error message we are going to show if no keywords
		// existed or if no results found.
		$error_text = [['name' => 'No results found, please try with different keywords.']];
		$error =  json_encode($error_text);

		// Making sure the user entered a keyword.
		if ($request->has('q')) {
			$term = $request->get('q');
			// Using the Laravel Scout syntax to search the products table EVENT.
			$posts_event = Event::
			select('name', 'id')
				->where('name', 'LIKE', '%' . $term . '%')
				->orWhere('description', 'LIKE', '%' . $term . '%')
				->take(5)->get();
			$posts_event = json_decode($posts_event);

			//Add the type to the array
			foreach ($posts_event as $event) {
				$event->type = 'event';
			}

			// Using the Laravel Scout syntax to search the products table FOODSTAND.
			$posts_foodstand = Foodstand::
			select('name', 'id')
				->where('name', 'LIKE', '%' . $term . '%')
				->orWhere('description', 'LIKE', '%' . $term . '%')
				->take(5)->get();
			$posts_foodstand = json_decode($posts_foodstand);

			//Add the type to the array
			foreach ($posts_foodstand as $foodstand) {
				$foodstand->type = 'foodstand';
			}

			// Using the Laravel Scout syntax to search the products table ENTERTAINER.
			$posts_entertainer = Entertainer::
			select('name', 'id')
				->where('name', 'LIKE', '%' . $term . '%')
				->orWhere('description', 'LIKE', '%' . $term . '%')
				->take(5)->get();
			$posts_entertainer = json_decode($posts_entertainer);

			//Add the type to the array
			foreach ($posts_entertainer as $entertainer) {
				$entertainer->type = 'entertainer';
			}

			// Merge all the array's into one
			$posts = json_encode(array_merge($posts_event, $posts_foodstand, $posts_entertainer));

			// If there are results return them, if none, return the error message.
			return $posts;
		}

		// Return the error message if no keywords existed
		return $error;
	}
}
