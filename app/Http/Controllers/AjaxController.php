<?php

namespace App\Http\Controllers;

use App\Detailpage_User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Search;

use App\ComponentHeaderImage;
use App\ComponentIntro;
use App\ComponentContact;
use App\ComponentMenu;
use App\ComponentMediaItem;

use App\Detailpage;
use App\ComponentMediaitem_User;

class AjaxController extends Controller
{

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

            //Return the view
            $returnHTML = view('ajax.search')->with('results', json_decode($results))->render();
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
                'jsonData.0.form.*.title' => 'bail|required|string|max:255',
                'jsonData.*.form.*.phone' => 'numeric|max:255',
                'jsonData.*.form.*.email' => 'email|max:255',
                'jsonData.*.form.*.site' =>  'url|max:30',
                'jsonData.*.form.*.twitter' => 'url|max:255',
                'jsonData.*.form.*.facebook' => 'url|max:255',
                'jsonData.*.form.*.linkedin' => 'url|max:255',
                'jsonData.*.form.*.googleplus' => 'url|max:255',
                'jsonData.*.form.*.instagram' => 'url|max:255',
                'jsonData.*.form.*.menuitem' => 'string|max:255',
            ]);

            //Get all the component data
            $data = $request->all();
            //Create the detailpage and put the id also in the pivot table
            $detailpage_id = Detailpage::Add($userid);
            Detailpage_User::Add($userid, $detailpage_id);

            //Save the Components by looping trough his own function
            foreach ($data['jsonData'] as $data_items) {
                $func = $data_items['url'];
                $this->$func($data_items,$detailpage_id);
            }

            return response()->json(array('success' => true)); 
        }  
    }

    public function SaveMediaitemComponent($data,$detailpage_id){
            //Add the component data to the component table and get the id
            $component_id = ComponentMediaItem::Add($data);

            //Add detailpage_id and component_id to component_mediaitem_user table
            ComponentMediaitem_User::Add($userid, $detailpage_id, $component_id);
    }

    public function SaveHeaderimageComponent($data,$detailpage_id){
        var_dump($data['table']);
    }


    public function SaveIntroComponent($data,$detailpage_id){
        //Add the component data to the component table and get the id
        $component_id = ComponentIntro::Add($data);
    }

    public function SaveContactComponent($data,$detailpage_id){
        var_dump($data['table']);
    }

    public function SaveMenuComponent($data,$detailpage_id){
        var_dump($data['table']);
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
