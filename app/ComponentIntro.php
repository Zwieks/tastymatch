<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComponentIntro extends Model
{
	protected $table = 'component_intro';

	//Get all the EVENTS
	public static function getAll(){
		$events = DB::table('component_intro')->get();

		return $events;
	}

	public static function Add($data){
		// Validate the request...

		$ComponentIntro = new ComponentIntro;

		if(isset($data['imagepath']) && $data['imagepath'] != '')
			$ComponentIntro->image = $data['imagepath'];

		if(isset($data['content']) && $data['content'] != '')
			$ComponentIntro->content = $data['content'];

		$ComponentIntro->save();

		return $ComponentIntro->id;
	}
}
