<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Search;
use File;

use App\ComponentHeaderImage;
use App\ComponentIntro;
use App\ComponentContact;
use App\ComponentMenu;
use App\ComponentMediaItem;

use App\Detailpage_User;
use App\Detailpage;

use App\Agenda_User;
use App\Agenda;

use App\Event_User;
use App\Event;

use App\Foodstand_User;
use App\Foodstand;

use App\Entertainer_User;
use App\Entertainer;

use App\ComponentMediaitem_User;

use App\User;
use App\Sessions;

class AjaxController extends Controller
{
    //GLOBALS
    protected $mediaComponents = [];
    protected $agendaItems = [];

    /**
     * Validate Form inputs with AJAX
     *
     * @return \Illuminate\Http\Response
     */
    public function getValidation(Request $request)
    {
        if($this->checkAjaxRequest($request) == true) {

            //Validate the input, when this fails it will return a json error
            $this->validate($request, [
                'jsondata.searchevents' => 'bail|required|string',
                'jsondata.eventtype' => 'numeric|between:0,10',
                'jsondata.description' => 'sometimes|string',
                'jsondata.location' => 'required|string',
                'jsondata.datestart' => 'required|date|before:jsondata.dateend',
                'jsondata.dateend' => 'date',
            ]);
        }

        return response()->json(array('success' => true));
    }

    /**
     * Get the search results from the AJAX request
     *
     * @return \Illuminate\Http\Response
     */
    public function getSearch(Request $request)
    {
        if($this->checkAjaxRequest($request) == true){
            //Perform the search
            $results = Search::onPageSearch($request);

            if(!empty($results)){
                //Return the view
                $returnHTML = view('ajax.search')->with('results', json_decode($results))->render();   
            }else{
                $returnHTML = '';
            }
            return response()->json(array('success' => true, 'html'=>$returnHTML));
        }
    }


    /**
     * Get the search results from the AJAX request
     *
     * @return \Illuminate\Http\Response
     */
    public function uploadImage(Request $request)
    {
        if($this->checkAjaxRequest($request) == true){
            //Perform the upload
            return true;
        }
    }

    /**
     * AUTOCOMPLETE
     * Get the search results from the AJAX request
     *
     * @return \Illuminate\Http\Response
     */
    public function getAutoComplete(Request $request)
    {
        if($this->checkAjaxRequest($request) == true){
            //Perform the search
            $results = Search::getAutoCompleteResults($request);

            //Return the view
            $returnHTML = view('ajax.search')->with('results', $results)->render();
            return response()->json(array('success' => true, 'html'=>$returnHTML));
        }
    }

    /**
     * Checks if the request is indeed AJAX
     *
     * @return true or false
     */
    public function checkAjaxRequest($request){
        if($request->ajax()){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Add a default Media item template. Commomn use in the user detail page
     *
     * @return \Illuminate\Http\Response
     */
    public function AddMediaItem(Request $request){
        if($this->checkAjaxRequest($request) == true){
            //Return the view
            $data = $request->all();

            $returnHTML = view('layouts.templates.empty-mediaitem')->with('data', $data['count'])->render();
            return response()->json(array('success' => true, 'html'=>$returnHTML, 'id'=>$data['count']));
        }
    }

    public function SaveComponents(Request $request){
        if($this->checkAjaxRequest($request) == true){
            //User id
            $userid = $request->session()->get('user.global.id');

            //Validate the input, when this fails it will return a json error
            $this->validate($request, [
                'jsondata.0.form.1.title' => 'bail|required|string|max:255',
                'jsondata.*.form.*.phone' => 'numeric',
                'jsondata.*.form.*.email' => 'email|max:255',
                'jsondata.*.form.*.site' =>  'url|max:30',
                'jsondata.*.form.*.twitter' => 'url|max:255',
                'jsondata.*.form.*.facebook' => 'url|max:255',
                'jsondata.*.form.*.linkedin' => 'url|max:255',
                'jsondata.*.form.*.googleplus' => 'url|max:255',
                'jsondata.*.form.*.instagram' => 'url|max:255',
                'jsondata.*.form.*.menuitem' => 'string|max:255',
                'jsondata.*.form.*.menuitem' => 'string|max:255',
                'jsondata.*.form.*.amountstart' => 'string|max:255',
            ]);

            //Get all the component data
            $data = $request->all();

            //Detailpage id
            $detailpage_id = $data['userDetail']['pageid'];

            //Type of the page based on Foodstand, Event or Entertainer
            $type = $data['itemType'];

            //Get the item status
            $status = $data['itemStatus'];

            //Check if the user can access the page
            $record = Detailpage_User::checkUserRelation($userid,$detailpage_id);

            if($record == ''){
               return response()->json(array('success' => false));
            }

            //Update the state of the detailpage and add the type
            Detailpage::updateState('preview',$detailpage_id, $type);

            //Check if the detailpage is new or an excisting
            //IF THE STATUS IS NEW CREATE A NEW PRODUCT BASED ON THE TYPE
            if($status == 'create'){
                //Check the type of the new created detailpage
                if($type == 'event'){
                    //Add the new event in the event table and return the ID
                    $event_id = Event::store($data);
                    //Add the Event User table
                    Event_User::store($userid,$event_id,$data);
                }elseif($type == 'foodstand'){
                    //Add the new event in the event table and return the ID
                    $foodstand_id = Foodstand::store($data);
                    //Add the Event User table
                    Foodstand_User::store($userid,$foodstand_id,$data);
                }elseif($type == 'entertainer'){
                    //Add the new event in the event table and return the ID
                    $entertainer_id = Entertainer::store($data);
                    //Add the Event User table
                    Entertainer_User::store($userid,$entertainer_id,$data);
                }
            }
            echo $status.' en '.$type;
return false;
            $this->SaveAdditionalinfoComponent($request,$data_items,$detailpage_id);
            return false;

            //Save the Components by looping trough his own function
            foreach ($data['jsondata'] as $data_items) {
                $func = $data_items['url'];
                //$this->$func($request,$data_items,$detailpage_id);
            }

            return response()->json(array('success' => true, 'mediaComponents' => json_encode($this->mediaComponents),'agendaItems' => json_encode($this->agendaItems)));
        }
    }

    public function SaveAgendaitemsComponent(Request $request,$data,$detailpage_id){
        //Check if the status property has been set
        if(isset($data['info']['status']) && $data['info']['status'] != ''){
            //Set the status
            $status = $data['info']['status'];
            //Get the userid
            $userid = $request->session()->get('user.global.id');
            //Set the eventid
            if(isset($data['event_id'])){
                $event_id = $data['event_id'];
                //Check if the agenda item is already create before
                $agenda_id = Agenda_User::CheckAlreadyUpdated('agendas.id',$event_id,$userid);
            }else{
                $event_id = '';
                $agenda_id = '';
            }

            if($status == 'new'){
                //Check if the user create a new event
                if($event_id == ''){
                   $event_id = Event::store($data);
                }
                //Add the component data to the component table and get the id
                $agenda_id = Agenda::store($data,$event_id,$detailpage_id);

                //Add detailpage_id and $agenda_id to component_mediaitem_user table
                Agenda_User::store($userid, $agenda_id);
                //Add the Event User table
                Event_User::store($userid,$event_id,$data);
                //Add item data to the global variable
                $this->agendaItems[] = ['name' => $data['info']['name'],'eventid' => $event_id, 'agendaid' => $agenda_id, 'random' => $data['info']['random']];
            }else if($status == 'update' && $agenda_id != ''){
                //Update the event
                Event::updateFields($event_id,$data);
                //Update the possible agenda dates
                Agenda::updateFields($userid,$agenda_id,$data);  
            }else if($status == 'update-agenda-only' && $agenda_id != ''){
                //Update ONLY the agenda data fields
                Agenda::updateFields($userid,$agenda_id,$data);  
            }
        }
    }

    public function resetSession(Request $request){
        //Update the Session
        $user = User::userSessionSetup();

        //Set User Data Session
        Sessions::setGlobalUserSession($request, $user);

        return response()->json(array('success' => true));
    }

    public function SaveMediaitemsComponent(Request $request,$data,$detailpage_id){
        $userid = $request->session()->get('user.global.id');
        $mediaitem_id = '';
        if(!isset($data['delete'])){

            //Check if the user can change the item by getting the component_media_id
            if(isset($data['mediaid'])){
                $mediaitem_id = $data['mediaid'];
                $component_id = ComponentMediaitem_User::CheckAlreadyUpdated('id',$detailpage_id,$userid,$mediaitem_id);
            }

            //If the check give a valid component id related to the user update the field else add a new item to the DB en pivot
            if(isset($component_id) && $component_id != ''){
                ComponentMediaItem::updateFields($userid,$mediaitem_id,$data);
            }else{
                //Add the component data to the component table and get the id
                $component_id = ComponentMediaItem::store($data);

                //Add item data to the global variable
                $this->mediaComponents[] = ['componentid' => $component_id, 'elementid' => $data['elementid']];

                //Add detailpage_id and component_id to component_mediaitem_user table
                ComponentMediaitem_User::store($userid, $detailpage_id, $component_id);
            }
        }
    }

    public function SaveHeaderimageComponent(Request $request,$data,$detailpage_id){
        $component_id = Detailpage::CheckAlreadyUpdated('headerimage_id',$detailpage_id);

        if($component_id != 0){
            ComponentHeaderImage::updateFields($component_id,$data);
        }else{
            //Add the component data to the component table and get the id
            $component_id = ComponentHeaderImage::store($data);
        }

        //Store component ID in the detailpage table
        Detailpage::storeHeaderimage($detailpage_id, $component_id);
    }

    public function SaveIntroComponent(Request $request,$data,$detailpage_id){
        $component_id = Detailpage::CheckAlreadyUpdated('intro_id',$detailpage_id);

        if($component_id != 0){
            ComponentIntro::updateFields($component_id,$data);
        }else{
            //Add the component data to the component table and get the id
            $component_id = ComponentIntro::store($data);
        }

        //Store component ID in the detailpage table
        Detailpage::storeIntro($detailpage_id, $component_id);
    }

    public function SaveAdditionalinfoComponent(Request $request,$data,$detailpage_id){
        $component_id = Detailpage::CheckAlreadyUpdated('contact_id',$detailpage_id);

        if($component_id != 0){
            ComponentAdditionalinfo::updateFields($component_id,$data);
        }else{
            //Add the component data to the component table and get the id
            $component_id = ComponentAdditionalinfo::store($data);
        }

        //Store component ID in the detailpage table
        Detailpage::storeAdditionalinfo($detailpage_id, $component_id);
    }

    public function SaveStandinfoComponent(Request $request,$data,$detailpage_id){
        $component_id = Detailpage::CheckAlreadyUpdated('contact_id',$detailpage_id);

        if($component_id != 0){
            ComponentStandinfo::updateFields($component_id,$data);
        }else{
            //Add the component data to the component table and get the id
            $component_id = ComponentStandinfo::store($data);
        }

        //Store component ID in the detailpage table
        Detailpage::storeStandinfo($detailpage_id, $component_id);
    }

    public function SaveLocationdetailsComponent(Request $request,$data,$detailpage_id){
        $component_id = Detailpage::CheckAlreadyUpdated('contact_id',$detailpage_id);

        if($component_id != 0){
            ComponentLocationdetails::updateFields($component_id,$data);
        }else{
            //Add the component data to the component table and get the id
            $component_id = ComponentLocationdetails::store($data);
        }

        //Store component ID in the detailpage table
        Detailpage::storeLocationdetails($detailpage_id, $component_id);
    }

    public function SaveContactComponent(Request $request,$data,$detailpage_id){
        $component_id = Detailpage::CheckAlreadyUpdated('contact_id',$detailpage_id);

        if($component_id != 0){
            ComponentContact::updateFields($component_id,$data);
        }else{
            //Add the component data to the component table and get the id
            $component_id = ComponentContact::store($data);
        }

        //Store component ID in the detailpage table
        Detailpage::storeContact($detailpage_id, $component_id);
    }

    public function SaveMenuComponent(Request $request,$data,$detailpage_id){
        $component_id = Detailpage::CheckAlreadyUpdated('menu_id',$detailpage_id);

        if($component_id != 0){
            ComponentMenu::updateFields($component_id,$data);
        }else{
            //Add the component data to the component table and get the id
            $component_id = ComponentMenu::store($data);
        }

        //Store component ID in the detailpage table
        Detailpage::storeMenu($detailpage_id, $component_id);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
