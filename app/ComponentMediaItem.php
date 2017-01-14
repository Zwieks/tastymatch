<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;

class ComponentMediaItem extends Model
{
    protected $table = 'component_mediaitems';

    /**
	 * The users that belong to the event.
	 */
	public function users()
	{
		return $this->belongsToMany('App\ComponentMediaitem_User');
	}

	//Get all the EVENTS
	public static function getAll(){
		$events = DB::table('component_mediaitem')->get();

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
