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
    public function index(Request $request)
    {
        //Get the user information
        $user = $request->session()->get('user.global');

        $foodstands = Foodstand::getUserFoodstands($user);
        //return the view with the user session data
        return view('auth.foodstand', compact('foodstands'));
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
            $post = Foodstand::where('slug', $slug)->first();

            // Next, we will fire off an event and pass along
            // the post as its payload
            Event::fire(new ViewCounter($post));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request,$slug)
    {
        //Get the user information
        $user_detail = $request->session()->get('user.global');

        //Check if the user can access the page
        $record = Detailpage_User::checkUserRelation($user_detail->id,$slug);

        if($record != ''){
            $detailpage_id = $slug;

            //Get the user information
            $user = $request->session()->get('user.global');

            //return the view with the user session data
            return view('auth.create-foodstand', compact('user','detailpage_id'));
        }
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
