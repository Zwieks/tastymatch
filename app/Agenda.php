<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Event;
use Carbon\Carbon;

use DB;
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
			$i++;
		}

		return $page_content;
	}
}
