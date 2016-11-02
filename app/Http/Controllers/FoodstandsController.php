<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Foodstand;

class FoodstandsController extends Controller
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
     * Shows a single post.
     *
     * @return \Illuminate\Http\Response
     */
    public function single(Request $request, $slug)
    {
        //Check if the blog is already been viewed by the user
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

        $posts = Blog::with('Author','images','comments')->where('slug', '=', $slug)->first();

        return view('auth.foodstanddetail')->with('foodstand',$posts);
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
