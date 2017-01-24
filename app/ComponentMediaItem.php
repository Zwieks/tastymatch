<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use Request;

use DB;

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

	public static function updateFields($userid,$mediaitem_id,$data){
		if(!isset($data['path']))
			$data['path'] = '';

		if(!isset($data['content']))
			$data['content'] = '';

		DB::table('component_mediaitems')
			->where('id', $mediaitem_id)
			->update(['image' => $data['path'],'content' => $data['content']]);
	}

	public static function store($data){
        // Validate the request...

        $ComponentMediaItem = new ComponentMediaItem;

        if(isset($data['path']) && $data['path'] != '')
        	$ComponentMediaItem->image = $data['path'];

        if(isset($data['content']) && $data['content'] != '')
        	$ComponentMediaItem->content = $data['content'];

        $ComponentMediaItem->save();

        return $ComponentMediaItem->id;
	}

	public static function checkRecord($field,$mediaitem_id,$userid,$detailpage_id){
		$check = DB::table('component_mediaitem_user')
			->select($field)
			->where('detailpage_id', '=', $detailpage_id)
			->where('user_id', '=', $userid)
			->where('component_mediaitem_id', '=', $mediaitem_id)
			->first();

		if(isset($check->$field) && $check->$field != ''){
			return $check->$field;
		}else{
			return $check = '';
		}
	}

	public static function deleteComponent($request){
		$userid = $request->session()->get('user.global.id');

		$ids_to_delete = [];
		$media_item_ids_to_delete = [];

		//Get all the component data
		$data = $request->all();

		//Loop through the array containing the url of the images that will be deleted
		foreach ($data['jsondata'] as $media_item_id) {
			//Get the page id
			$detailpage_id = $data['userDetail']['pageid'];
			$media_item_id = $media_item_id[0];
			$component_key = $media_item_id[1];

	        //Check if the user can change the item by getting the component_media_id
	        $component_id = ComponentMediaitem::checkRecord('id',$media_item_id,$userid,$detailpage_id);

	        if($component_id != ''){
	        	$ids_to_delete[] = $component_id;
	        	$media_item_ids_to_delete[] = $media_item_id;
	        }	
		}

		if(!empty($ids_to_delete) && !empty($media_item_ids_to_delete)){
	    	ComponentMediaItem_user::destroy($ids_to_delete);  
	    	ComponentMediaItem::destroy($media_item_ids_to_delete);  
        }
	}	

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  array $ids_to_delete
	 * @return \Illuminate\Http\Response
	 */
	public static function destroy($ids_to_delete)
	{
	   DB::table('component_mediaitems')->whereIn('id', $ids_to_delete)->delete();
	}
}
