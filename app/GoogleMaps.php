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
		$locations = DB::table('agendas')->get();   

        $locations = images::getMapsImages($locations);
          
        return json_encode($locations);   		
	}
}
