<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Search;

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
