<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Agenda;
use App\Images;
use Illuminate\Http\Request;

class GoogleMaps extends Model
{
	//Get all agenda item locations to display on the map when the user is logedin
	public static function getAllAgedaItemLocations(Request $request){

		$events = GoogleMaps::getAllEventLocations();

		$foodstands = GoogleMaps::getAllFoodstandLocations();

		$entertainers = GoogleMaps::getAllEntertainerLocations();

		return json_encode(compact('events','foodstands','entertainers'));
	}

	//Get all the EVENT locations based on the user AGENDA
	public static function getAllEventLocations(){
		$locations = DB::table('events')->get();

		//Get the images
		$locations = images::getMapsImages($locations);

		return $locations;
	}

	//Get all the FOODSTANDS locations
	public static function getAllFoodstandLocations(){
		$locations = DB::table('foodstands')->get();

		//Get the images
		$locations = images::getMapsImages($locations);

		return $locations;
	}

	//Get all the ENTERTAINER locations
	public static function getAllEntertainerLocations(){
		$locations = DB::table('entertainers')->get();

		//Get the images
		$locations = images::getMapsImages($locations);

		return $locations;
	}
}
