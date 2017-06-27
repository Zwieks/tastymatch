<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComponentAdditionalinfo extends Model
{
    protected $table = 'events';

    public static function getFormInput($form){
        $sortArray = [];

        foreach ($form as $contact) {
            foreach ($contact as $key => $value) {
                $sortArray[$key] = $value;
            }
        }

        return $sortArray;
    }

	public static function store($data){
        $ComponentAdditionalinfo = new ComponentAdditionalinfo;

        if(isset($data['form']))
            $form = ComponentAdditionalinfo::getFormInput($data['form']);

        if(isset($data['type']) && $data['type'] != '')
        	$ComponentAdditionalinfo->type_id = $data['type'];

        if(isset($form['eventdatestart']) && $form['eventdatestart'] != '')
        	$ComponentAdditionalinfo->time_start = $form['eventdatestart'];

        if(isset($form['eventdateend']) && $form['eventdateend'] != '')
        	$ComponentAdditionalinfo->time_end = $form['eventdateend'];

        if(isset($form['filter_visitors']) && $form['filter_visitors'] != '')
        	$ComponentAdditionalinfo->visitors_indication = $form['filter_visitors'];

        $ComponentAdditionalinfo->save();

        return $ComponentAdditionalinfo->id;
	}

	public static function updateFields($component_id,$data){
        if(isset($data['form'])){
            $form = ComponentAdditionalinfo::getFormInput($data['form']);
        }else{
            $data['form'] = [];
        }

		if(!isset($data['type']))
			$data['type'] = '';

		if(!isset($form['eventdatestart']))
			$form['eventdatestart'] = '';

        if(!isset($form['eventdateend']))
            $form['eventdateend'] = '';

		if(!isset($form['filter_visitors']))
			$form['filter_visitors'] = '';

		DB::table('events')
	    	->where('id', $event_id)
	    	->update(['type_id' => $data['type'],
                      'time_start' => $form['eventdatestart'],
                      'time_end' => $form['eventdateend'],
                      'visitors_indication' => $form['filter_visitors']]);
	}
}
