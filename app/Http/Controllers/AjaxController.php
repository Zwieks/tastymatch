<?php

namespace App\Http\Controllers;

use App\Detailpage_User;
use Illuminate\Http\Request;

use App\Search;

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

    public function SaveMediaComponent(Request $request){
        if($this->checkAjaxRequest($request) == true){
            $userid = $request->session()->get('user.global.id');

            //Get all the component data
            $data = $request->all();

            //Add the component data to the component table and get the id
            $component_id = ComponentMediaItem::Add($data);

            //Create the detailpage and put the id also in the pivot table
            $detailpage_id = Detailpage::Add($userid);
           Detailpage_User::Add($userid, $detailpage_id);

            //Add detailpage_id and component_id to component_mediaitem_user table
            ComponentMediaitem_User::Add($userid, $detailpage_id, $component_id);

            return response()->json(array('success' => true));
        }    
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
