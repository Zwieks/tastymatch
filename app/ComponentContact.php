<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class ComponentContact extends Model
{
    protected $table = 'component_contact';

	public static function detailpage()
	{
		return $this->belongsTo('App\ComponentDetailpage');
	}

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
        $ComponentContact = new ComponentContact;

        if(isset($data['form']))
            $form = ComponentContact::getFormInput($data['form']);

        if(isset($data['content']) && $data['content'] != '')
        	$ComponentContact->content = $data['content'];

        if(isset($form['phone']) && $form['phone'] != '')
        	$ComponentContact->phone = $form['phone'];

        if(isset($form['email']) && $form['email'] != '')
        	$ComponentContact->email = $form['email'];

        if(isset($form['site']) && $form['site'] != '')
        	$ComponentContact->site = $form['site'];

        if(isset($form['facebook']) && $form['facebook'] != '')
        	$ComponentContact->facebook = $form['facebook'];

        if(isset($form['twitter']) && $form['twitter'] != '')
        	$ComponentContact->twitter = $form['twitter'];

        if(isset($form['linkedin']) && $form['linkedin'] != '')
        	$ComponentContact->linkedin = $form['linkedin'];

        if(isset($form['instagram']) && $form['instagram'] != '')
        	$ComponentContact->instagram = $form['instagram'];

        if(isset($form['googleplus']) && $form['googleplus'] != '')
        	$ComponentContact->googleplus = $form['googleplus'];

        $ComponentContact->save();

        return $ComponentContact->id;
	}

	public static function updateFields($component_id,$data){
        if(isset($data['form'])){
            $form = ComponentContact::getFormInput($data['form']);
        }else{
            $data['form'] = [];
        }

		if(!isset($data['content']))
			$data['content'] = '';

		if(!isset($form['phone']))
			$form['phone'] = '';

        if(!isset($form['email']))
            $form['email'] = '';

		if(!isset($form['site']))
			$form['site'] = '';

        if(!isset($form['facebook']))
            $form['facebook'] = '';

        if(!isset($form['twitter']))
            $form['twitter'] = '';

        if(!isset($form['linkedin']))
            $form['linkedin'] = '';

		if(!isset($form['instagram']))
			$form['instagram'] = '';	

        if(!isset($form['googleplus']))
            $form['googleplus'] = '';    

		DB::table('component_contact')
	    	->where('id', $component_id)
	    	->update(['content' => $data['content'],
                      'phone' => $form['phone'],
                      'email' => $form['email'],
                      'site' => $form['site'],
                      'facebook' => $form['facebook'],
                      'twitter' => $form['twitter'],
                      'linkedin' => $form['linkedin'],
                      'instagram' => $form['instagram'],
                      'googleplus' => $form['googleplus']]);
	}
}
