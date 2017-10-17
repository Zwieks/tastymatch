<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Event;
use Carbon\Carbon;
use App\Agenda_User;
use App\Event_User;
use DB;

use App\User;
use App\Sessions;
class Agenda extends Model
{
	/**
	 * The users that belong to the role.
	 */


	public function users()
	{
		return $this->belongsToMany('App\Agenda_User');
	}

	public static function store($data,$event_id,$detailpage_id){
		$Agenda = new Agenda;

		if(isset($data['info']['name']) && $data['info']['name'] != '')
			$Agenda->name = $data['info']['name'];

		if(isset($data['info']['description']) && $data['info']['description'] != '')
			$Agenda->description = $data['info']['description'];

		if(isset($event_id) && $event_id != '')
			$Agenda->event_id = $event_id;

		if(isset($data['date_start']) && $data['date_start'] != '')
			$Agenda->date_start = Carbon::parse($data['date_start'])->format('Y-m-d');

		if(isset($data['date_end']) && $data['date_end'] != '')
			$Agenda->date_end = Carbon::parse($data['date_end'])->format('Y-m-d');

		if(isset($detailpage_id) && $detailpage_id != '')
			$Agenda->detailpage_id = $detailpage_id;

		$Agenda->save();

		return $Agenda->id;
	}

	public static function updateFields($userid,$agenda_id,$data){
		if(!isset($data['date_start']))
			$data['date_start'] = '';

		if(!isset($data['date_end']))
			$data['date_start'] = '';

		DB::table('agendas')
			->where('id', $agenda_id)
			->update(['date_start' => Carbon::parse($data['date_start'])->format('Y-m-d'),'date_end' => Carbon::parse($data['date_end'])->format('Y-m-d')]);
	}

	public static function getAllUserAgendaDetails($page_content){

		$i = 0;
		//Get the comma separated image string from the database and get the images from the images table put this all in a new array
		foreach ($page_content->agenda as $item) {
        	$page_content['agenda'][$i]->date_start = Carbon::parse($item->date_start)->formatLocalized('%e %b %Y');
        	$page_content['agenda'][$i]->date_end = Carbon::parse($item->date_end)->formatLocalized('%e %b %Y');
			$item['info'] = event::where('id', '=', $item['event_id'])->first();
			$item['info']->name = $item->name;
			$item['info']->description = $item->name;
			$i++;
		}

		return $page_content;
	}

	public static function checkRecord($field,$agenda_id,$userid,$detailpage_id){
		$check = DB::table('agendas')
			->select($field)
			->join('agenda_user', 'agendas.id', '=', 'agenda_user.agenda_id')
			->where('detailpage_id', '=', $detailpage_id)
			->where('user_id', '=', $userid)
			->where('agenda_id', '=', $agenda_id)
			->first();

		if(isset($check->id) && $check->id != ''){
			return $check->id;
		}else{
			return $check = '';
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
	   DB::table('agendas')->whereIn('id', $ids_to_delete)->delete();
	}

	//Detete agenda items based on delete array
	public static function deleteAgendaItems($request){
		$userid = $request->session()->get('user.global.id');

		$ids_to_delete = [];
		$agendaids_to_delete = [];
		$eventids_to_delete = [];

		//Get all the component data
		$data = $request->all();
		$test = [];
		//Loop through the array containing the url of the images that will be deleted
		foreach ($data['jsondata'] as $item) {
			if($data['userDetail']['pageid'] != ''){
				//Get the page id
				$detailpage_id = $data['userDetail']['pageid'];
				$deleteitem = $item['deleteitem'];
				$agenda_id = $item['agenda_id'];
				if(isset($item['event_id'])){
					$event_id = $item['event_id'];
				}else{
					$event_id = '';
				}

				//Check if the user can change the item by getting the agenda_id
		        $agenda_id = Agenda::checkRecord('agendas.id',$agenda_id,$userid,$detailpage_id);

		        if($agenda_id != ''){
		        	$agendaids_to_delete[] = $agenda_id;
		        }
		        //Check if the user can change the item by getting the agenda_id
		        if($event_id != ''){
			        $searchable = Event::checkRecord('searchable',$event_id,$userid);
			        if($searchable < 1){
			        	$test[] = $searchable;
			        	$eventids_to_delete[] = $event_id;
			        }else{
			        	//Destroy items from pivot table
			        	$empty_array = [];
			        	$empty_array[] = $event_id;
						Event_User::destroy($empty_array);
			        }
		        }
		    }    
		}

		//Delete the agenda records from the pivot and agendas table
		if(!empty($agendaids_to_delete)){
			// Delete records from agenda table
			Agenda::destroy($agendaids_to_delete);
			//Destroy items from pivot table
			Agenda_User::destroy($agendaids_to_delete);
		}

		//Delete the event records from the pivot and events table
		if(!empty($eventids_to_delete)){
			// Delete records from agenda table
			Event::destroy($eventids_to_delete);
			//Destroy items from pivot table
			Event_User::destroy($eventids_to_delete);
		}
	}
}