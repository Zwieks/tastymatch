<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class ComponentIntro extends Model
{
	protected $table = 'component_intro';

	//Get all the EVENTS
	public static function getAll(){
		$events = DB::table('component_intro')->get();

		return $events;
	}

	public static function store($data){
		// Validate the request...

		$ComponentIntro = new ComponentIntro;

		if(isset($data['content']) && $data['content'] != '')
			$ComponentIntro->content = $data['content'];

		if(isset($data['title']) && $data['title'] != '')
			$ComponentIntro->name = $data['title'];

		$ComponentIntro->save();

		return $ComponentIntro->id;
	}

	public static function updateFields($component_id,$data){
		if(!isset($data['content']))
			$data['content'] = '';

		DB::table('component_intro')
	    	->where('id', $component_id)
	    	->update(['name' => $data['form'][1]['title'], 'content' => preg_replace( "/\r|\n/", "", $data['content'])]);
	}	
}
