<?php

namespace App\Http\Controllers;

use Event;

use Illuminate\Http\Request;

use App\Events\ViewCounter;

use App\Sessions;

use App\Entertainer;

use App\Detailpage;

use App\Detailpage_User;

class EntertainersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Shows a single entertainer.
     *
     * @return \Illuminate\Http\Response
     */
    public function single(Request $request, $slug)
    {
        //Check if the entertainer is already been viewed by the user
        if (!$request->session()->has('viewed.entertainer'.$slug)) {

            //Set the Session
            Sessions::setSingleEntertainerSession($request, $slug);

            // We will just be quick here and fetch the post
            // using the Post entertainer.
            $page_content = Entertainer::getDetailPage($slug);

            if($page_content == false)
                return view('errors.entertainer-notfound');

            //Set the detailpage id
            $detailpage_id = $page_content['detailpage_id'];

            // Next, we will fire off an event and pass along
            // the post as its payload
            //Event::fire(new ViewCounter($post));
        }

        //Set the item type
        $item_type = 'entertainer';

        //return the view with the user session data
        return view('auth.detailpages.view', compact('page_content','detailpage_id','item_type'));
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
