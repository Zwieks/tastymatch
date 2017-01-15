<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class ComponentHeaderImage extends Model
{
    protected $table = 'component_headerimage';

    /**
	 * The users that belong to the event.
	 */
	public function users()
	{
		return $this->belongsTo('App\ComponentHeaderimage_User');
	}

	//Get all the EVENTS
	public static function getAll(){
		$events = DB::table('component_headerimage')->get();

		return $events;
	}

	public static function store($data){
        // Validate the request...

        $ComponentHeaderImage = new ComponentHeaderImage;

        if(isset($data['path']) && $data['path'] != '')
        	$ComponentHeaderImage->path = $data['path'];

        $ComponentHeaderImage->save();

        return $ComponentHeaderImage->id;
	}

	public static function updateFields($component_id,$data){
		if(!isset($data['path']))
			$data['path'] = '';

		DB::table('component_headerimage')
	    	->where('id', $component_id)
	    	->update(['path' => $data['path']]);
	}	
}
