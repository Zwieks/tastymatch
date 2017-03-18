<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use App\Agenda;

use App\User;
use Session;
use App\Sessions;

class AgendaController extends Controller
{
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

    /**
     * Delete agenda items
     *
     * @param  array  jsondata, object userDetail
     * @return \Illuminate\Http\Response
     */
    public function deleteAgendaItems(Request $request){
       Session::forget('user.global.agenda');
  
        Agenda::deleteAgendaItems($request);  

        //Update the Session
        $user = User::userSessionSetup();

        //Set User Data Session
        Sessions::setGlobalUserSession($request, $user);

        //Return succes
        return response()->json(array('success' => true));
    }
}
