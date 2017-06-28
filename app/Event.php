<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Images;

use Carbon\Carbon;
//Is searchable
use Laravel\Scout\Searchable;

use DB;
class Event extends Model
{
	use Searchable;

	protected $table = 'events';

	/**
	 * The users that belong to the event.
	 */
	public function users()
	{
		return $this->belongsToMany('App\Event_User');
	}

	public static function dataFormat($data){
		$eventInfo = [];

		foreach ($data['jsondata'] as $key => $value) {
			//Get the element ID
			$elementId = $value['elementid'];

			if($elementId == 'component-intro'){
				foreach ($value['form'] as $item) {
					if(isset($item['title'])){
						$eventInfo['info']['name'] = $item['title'];
						$info['info']['slug'] =  createSlug($item['title']);
					}

					if(isset($item['content'])){
						$eventInfo['info']['description'] = $item['content'];
					}
				}
			}	

			if($elementId == 'component-locationdetails'){
				foreach ($value['form'] as $item) {
					if(isset($item['eventlocation'])){
						$eventInfo['info']['location'] = $item['eventlocation'];
					}

					if(isset($item['lat'])){
						$eventInfo['info']['lat'] = $item['lat'];
					}	

					if(isset($item['lng'])){
						$eventInfo['info']['long'] = $item['lng'];
					}
				}
			}

			if($elementId == 'component-additionalinfo'){
				foreach ($value['form'] as $item) {
					if(isset($item['eventdatestart'])){
						$eventInfo['info']['time_start'] = $item['eventdatestart'];
					}

					if(isset($item['eventdateend'])){
						$eventInfo['info']['time_end'] = $item['eventdateend'];
					}	

					if(isset($item['type'])){
						$eventInfo['info']['type_id'] = $item['type'];
					}

					if(isset($item['filter_visitors'])){
						$eventInfo['info']['filter_visitors'] = $item['filter_visitors'];
					}
				}
			}

			if($elementId == 'component-standinfo'){
				foreach ($value['form'] as $item) {
					if(isset($item['filter_facility-gas'])){
						$eventInfo['info']['facility-gas'] = $item['filter_facility-gas'];
					}

					if(isset($item['filter_facility-water'])){
						$eventInfo['info']['facility-water'] = $item['filter_facility-water'];
					}	

					if(isset($item['filter_facility-electricity'])){
						$eventInfo['info']['facility-electricity'] = $item['filter_facility-electricity'];
					}

					if(isset($item['construct_datestart'])){
						$eventInfo['info']['construct_time_start'] = $item['construct_datestart'];
					}

					if(isset($item['construct_dateend'])){
						$eventInfo['info']['construct_time_end'] = $item['construct_dateend'];
					}

					if(isset($item['deconstruct_datestart'])){
						$eventInfo['info']['deconstruct_time_start'] = $item['deconstruct_datestart'];
					}

					if(isset($item['deconstruct_dateend'])){
						$eventInfo['info']['deconstruct_time_end'] = $item['deconstruct_dateend'];
					}

					if(isset($item['amountstart'])){
						$eventInfo['info']['amountstart'] = $item['amountstart'];
					}

					if(isset($item['amountend'])){
						$eventInfo['info']['amountend'] = $item['amountend'];
					}
				}
			}
		}

		return $eventInfo;
	}

	public static function store($data){
		$Event = new Event;

		if(isset($data['info'])){
			$info = $data['info'];
		}else{
			$info = [];
		}

		if(isset($info['name']) && $info['name'] != '')
			$Event->name = $info['name'];

		if(isset($info['description']) && $info['description'] != '')
			$Event->description = $info['description'];

		if(isset($info['images_id']) && $info['images_id'] != '')
			$Event->images_id = $info['images_id'];

		if(isset($info['videos_id']) && $info['videos_id'] != '')
			$Event->videos_id = $info['videos_id'];

		if(isset($info['slug']) && $info['slug'] != '')
			$Event->slug = $info['slug'];

		if(isset($info['keywords']) && $info['keywords'] != '')
			$Event->keywords = $info['keywords'];

		if(isset($info['location']) && $info['location'] != '')
			$Event->location = $info['location'];

		if(isset($info['long']) && $info['long'] != '')
			$Event->long = $info['long'];

		if(isset($info['lat']) && $info['lat'] != '')
			$Event->lat = $info['lat'];

		if(isset($info['time_start']) && $info['time_start'] != '')
			$Event->time_start = Carbon::parse($info['time_start'])->format('Y-m-d');

		if(isset($info['time_end']) && $info['time_end'] != '')
			$Event->time_end = Carbon::parse($info['time_end'])->format('Y-m-d');

		if(isset($info['searchable']) && $info['searchable'] != '')
			$Event->searchable = $info['searchable'];

		if(isset($info['type_id']) && $info['type_id'] != '')
			$Event->type_id = $info['type_id'];

		if(isset($info['visitors_indication']) && $info['visitors_indication'] != '')
			$Event->visitors_indication = $info['visitors_indication'];

		$Event->save();

		return $Event->id;
	}

	public static function updateFields($event_id,$data){
		if(!isset($data['info']['name']))
			$data['info']['name'] = '';

		if(!isset($data['info']['description']))
			$data['info']['description'] = '';

		if(!isset($data['info']['location']))
			$data['info']['location'] = '';

		if(!isset($data['info']['long']))
			$data['info']['long'] = '';

		if(!isset($data['info']['lat']))
			$data['info']['lat'] = '';

		if(!isset($data['info']['type_id']))
			$data['info']['type_id'] = '';

		if(!isset($data['info']['visitors_indication']))
			$data['info']['visitors_indication'] = '';

		DB::table('events')
	    	->where('id', $event_id)
	    	->update([
	    		'name' => $data['info']['name'],
	    		'description' => $data['info']['description'],
	    		'location' => $data['info']['location'],
	    		'long' => $data['info']['long'],
	    		'lat' => $data['info']['lat'],
	    		'type_id' => $data['info']['type_id'],
	    		'visitors_indication' => $data['info']['visitors_indication']
	    	]);
	}	

	public static function checkRecord($field,$event_id,$userid){
		$check = DB::table('events')
			->select($field)
			->join('event_user', 'events.id', '=', 'event_user.event_id')
			->where('user_id', '=', $userid)
			->where('event_id', '=', $event_id)
			->first();

		if(isset($check->searchable)){
			return $check->searchable;
		}else{
			return $check = '';
		}
	}

	//Get all the EVENTS
	public static function getAll(){
		$events = DB::table('events')->get();

		//Get the images
		$events = images::getAllImages($events);

		return $events;
	}

		/**
	 * Remove the specified resource from storage.
	 *
	 * @param  array $ids_to_delete
	 * @return \Illuminate\Http\Response
	 */
	public static function destroy($ids_to_delete)
	{
	   DB::table('events')->whereIn('id', $ids_to_delete)->delete();
	}
}
