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
use App\ComponentMediaitem_User;

class AjaxController extends Controller
{
    //GLOBALS
    protected $mediaComponents = [];


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
            ]);

            //Get all the component data
            $data = $request->all();

            //Detailpage id
            $detailpage_id = $data['userDetail']['pageid'];

            //Check if the user can access the page
            $record = Detailpage_User::checkUserRelation($userid,$detailpage_id);

            if($record == ''){
               return response()->json(array('success' => false));
            }

            //Update the state of the detailpage
            Detailpage::updateState('preview',$detailpage_id);

            //Save the Components by looping trough his own function
            foreach ($data['jsondata'] as $data_items) {
                $func = $data_items['url'];
                $this->$func($request,$data_items,$detailpage_id);
            }

            return response()->json(array('success' => true, 'mediaComponents' => json_encode($this->mediaComponents)));
        }
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
