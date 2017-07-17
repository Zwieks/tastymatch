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

	public static function getDetailPage($slug){
		//Get the DETAILPAGE ID of the selected item
		$result = DB::table('events')
			->join('detailpages', 'events.detailpage_id', '=', 'detailpages.id')
			->select('detailpage_id')
			->where('slug', $slug)
			->first();

		//If there is no results found redirect to notfoud page
		if(!isset($result->detailpage_id)){
			return false;
		}
			
		//Get the DETAILPAGE CONTENT
        $page_content = Detailpage::with('getContact')
            ->with('getIntro')
            ->with('getMenu')
            ->with('getHeaderimage')
            ->with('getMediaItems')
            ->with('getEvent')
            ->with('agenda')
            ->findOrFail($result->detailpage_id);

        //Get the AGENDA DETAILS and put them in the array
        $page_content = Agenda::getAllUserAgendaDetails($page_content);   

        $page_content['detailpage_id'] = $result->detailpage_id;

		return $page_content;
	}

	/**
	 * The users that belong to the event.
	 */
	public function users()
	{
		return $this->belongsToMany('App\Event_User');
	}

	/**
	 * Get the EventId based on PagedId.
	 */
	public static function GetEventId($pageId){
		$eventId = DB::table('events')
		->select('id')
		->where('detailpage_id', '=', $pageId)
		->first();

		return $eventId->id;
	}

	public static function dataFormat($data){
		$eventInfo = [];

		foreach ($data['jsondata'] as $key => $value) {
			if(isset($value['form'])){
				//Get the element ID
				$elementId = $value['elementid'];

				if($elementId == 'component-intro'){
					foreach ($value['form'] as $item) {
						if(isset($item['title'])){
							$eventInfo['info']['slug'] =  createSlug($item['title']);
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
							$eventInfo['info']['tags'] = trans('eventtypes.type-'.$item['type']);
						}

						if(isset($item['filter_visitors'])){
							$eventInfo['info']['visitors_indication'] = $item['filter_visitors'];
						}
					}
				}

				if($elementId == 'component-standinfo'){
					foreach ($value['form'] as $item) {
						if(isset($item['filter_facility-gas'])){
							$eventInfo['info']['facility_gas'] = $item['filter_facility-gas'];
						}

						if(isset($item['filter_facility-water'])){
							$eventInfo['info']['facility_water'] = $item['filter_facility-water'];
						}	

						if(isset($item['filter_facility-electricity'])){
							$eventInfo['info']['facility_electricity'] = $item['filter_facility-electricity'];
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

		if(isset($info['slug']) && $info['slug'] != '')
			$Event->slug = $info['slug'];

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

		if(isset($info['tags']) && $info['tags'] != '')
			$Event->tags = $info['tags'];

		if(isset($info['visitors_indication']) && $info['visitors_indication'] != '')
			$Event->visitors_indication = $info['visitors_indication'];

		if(isset($info['facility_gas']) && $info['facility_gas'] != '')
			$Event->facility_gas = $info['facility_gas'];

		if(isset($info['facility_water']) && $info['facility_water'] != '')
			$Event->facility_water = $info['facility_water'];

		if(isset($info['facility_electricity']) && $info['facility_electricity'] != '')
			$Event->facility_electricity = $info['facility_electricity'];

		if(isset($info['construct_time_start']) && $info['construct_time_start'] != '')
			$Event->construct_datestart = $info['construct_time_start'];

		if(isset($info['construct_time_end']) && $info['construct_time_end'] != '')
			$Event->construct_dateend = $info['construct_time_end'];

		if(isset($info['deconstruct_time_start']) && $info['deconstruct_time_start'] != '')
			$Event->deconstruct_datestart = $info['deconstruct_time_start'];

		if(isset($info['deconstruct_time_end']) && $info['deconstruct_time_end'] != '')
			$Event->deconstruct_dateend = $info['deconstruct_time_end'];

		if(isset($info['amountstart']) && $info['amountstart'] != '')
			$Event->amountstart = $info['amountstart'];

		if(isset($info['amountend']) && $info['amountend'] != '')
			$Event->amountend = $info['amountend'];

		if(isset($info['detailpage_id']) && $info['detailpage_id'] != '')
			$Event->detailpage_id = $info['detailpage_id'];

		$Event->save();

		return $Event->id;
	}

	public static function updateFields($event_id,$data){
		if(!isset($data['info']['location']))
			$data['info']['location'] = '';

		if(!isset($data['info']['long']))
			$data['info']['long'] = '';

		if(!isset($data['info']['lat']))
			$data['info']['lat'] = '';

		if(!isset($data['info']['type_id']))
			$data['info']['type_id'] = '';

		if(!isset($data['info']['tags']))
			$data['info']['tags'] = '';

		if(!isset($data['info']['visitors_indication']))
			$data['info']['visitors_indication'] = '';

		if(!isset($data['info']['facility_gas']))
			$data['info']['facility_gas'] = '';

		if(!isset($data['info']['facility_water']))
			$data['info']['facility_water'] = '';

		if(!isset($data['info']['facility_electricity']))
			$data['info']['facility_electricity'] = '';

		if(!isset($data['info']['construct_time_start']))
			$data['info']['construct_time_start'] = '';

		if(!isset($data['info']['construct_time_end']))
			$data['info']['construct_time_end'] = '';

		if(!isset($data['info']['deconstruct_time_start']))
			$data['info']['deconstruct_time_start'] = '';

		if(!isset($data['info']['deconstruct_time_end']))
			$data['info']['deconstruct_time_end'] = '';

		if(!isset($data['info']['amountstart']))
			$data['info']['amountstart'] = '';

		if(!isset($data['info']['amountend']))
			$data['info']['amountend'] = '';

		DB::table('events')
	    	->where('id', $event_id)
	    	->update([
	    		'location' => $data['info']['location'],
	    		'long' => $data['info']['long'],
	    		'lat' => $data['info']['lat'],
	    		'type_id' => $data['info']['type_id'],
	    		'visitors_indication' => $data['info']['visitors_indication'],
	    		'slug' => $data['info']['slug'],
	    		'facility_gas' => $data['info']['facility_gas'],
	    		'facility_water' => $data['info']['facility_water'],
	    		'facility_electricity' => $data['info']['facility_electricity'],
	    		'construct_datestart' => $data['info']['construct_time_start'],
	    		'construct_dateend' => $data['info']['construct_time_end'],
	    		'deconstruct_datestart' => $data['info']['deconstruct_time_start'],
	    		'deconstruct_dateend' => $data['info']['deconstruct_time_end'],	
	    		'amountstart' => $data['info']['amountstart'],
	    		'amountend' => $data['info']['amountend'],
	    		'tags' => $data['info']['tags']
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
