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
		$error = ['error' => 'No results found, please try with different keywords.'];

		// Making sure the user entered a keyword.
		if($request->has('q')) {

			// Using the Laravel Scout syntax to search the products table.
			$posts = Event::search($request->get('q'))->get();

			// If there are results return them, if none, return the error message.
			return $posts;
		}

		// Return the error message if no keywords existed
		return $error;
	}
}
