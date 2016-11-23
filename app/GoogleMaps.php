<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Agenda;
use Illuminate\Http\Request;

class GoogleMaps extends Model
{
	//Get all agenda item locations to display on the map when the user is logedin
	public static function getAllAgedaItemLocations(Request $request){
		// $locations = Agenda::select('description' ,'long', 'lat')
  //          	->get();


		$locations = DB::table('agendas')
            ->join('images', 'agendas.image_id', '=', 'images.id')
            ->select('agendas.description', 'agendas.long', 'agendas.lat', 'images.file')
            ->get();

        return $locations;   		
	}
}
