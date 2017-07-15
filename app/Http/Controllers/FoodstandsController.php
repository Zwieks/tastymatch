<?php

namespace App\Http\Controllers;

use Event;

use Illuminate\Http\Request;

use App\Events\ViewCounter;

use App\Sessions;

use App\Foodstand;

use App\Detailpage;

use App\Detailpage_User;

class FoodstandsController extends Controller
{
    /**
     * Get all the user foodstands
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $type, $slug)
    {

    }

    /**
     * Shows a single foodstand.
     *
     * @return \Illuminate\Http\Response
     */
    public function single(Request $request, $slug)
    {
        //Check if the foodstand is already been viewed by the user
        if (!$request->session()->has('viewed.foodstand'.$slug)) {

            //Set the Session
            Sessions::setSingleFoodstandSession($request, $slug);

            // We will just be quick here and fetch the post
            // using the Post foodstand.
            $page_content = Foodstand::getDetailPage($slug);

            if($page_content == false)
                return view('errors.foodstand-notfound');

            //Set the detailpage id
            $detailpage_id = $page_content['detailpage_id'];

            // Next, we will fire off an event and pass along
            // the post as its payload
            Event::fire(new ViewCounter($page_content)); 
        }

        //Set the item type
        $item_type = 'foodstand';

        //return the view with the user session data
        return view('auth.detailpages.view', compact('page_content','detailpage_id','item_type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request,$slug)
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
