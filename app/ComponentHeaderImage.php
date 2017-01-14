<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComponentHeaderImage extends Model
{
    protected $table = 'component_headerimage';

    /**
	 * The users that belong to the event.
	 */
	public function users()
	{
		return $this->belongsTo('App\ComponentMediaitem_User');
	}

	//Get all the EVENTS
	public static function getAll(){
		$events = DB::table('component_headerimage')->get();

		return $events;
	}

	public static function store($data){
        // Validate the request...

        $ComponentMediaItem = new ComponentMediaItem;

        if(isset($data['imagepath']) && $data['imagepath'] != '')
        	$ComponentMediaItem->image = $data['imagepath'];

        if(isset($data['content']) && $data['content'] != '')
        	$ComponentMediaItem->content = $data['content'];

        $ComponentMediaItem->save();

        return $ComponentMediaItem->id;
	}
}
