<?php

namespace App\Http\Controllers;

use Event;

use App\Events\ViewCounter;

use App\Blog;

use App\Sessions;

use Illuminate\Http\Request;

use App\Http\Requests;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts = Blog::with('Author','images')-> orderBy('id', 'DESC')->paginate(10);

        return view('auth.blog')->with('blog',$posts);
    }

    /**
     * Shows a single post.
     *
     * @return \Illuminate\Http\Response
     */
    public function single(Request $request, $slug)
    {
        //Check if the blog is already been viewed by the user
        if (!$request->session()->has('viewed.blog'.$slug)) {

            //Set the Session
            Sessions::setSingleBlogSession($request, $slug);

            // We will just be quick here and fetch the post
            // using the Post model.
            $post = Blog::where('slug', $slug)->first();

            // Next, we will fire off an event and pass along
            // the post as its payload
            Event::fire(new ViewCounter($post));
        }

        $posts = Blog::with('Author','images','comments')->where('slug', '=', $slug)->first();

        //Chop up the content text
        $posts->content = explode("<br><br>", $posts->content);

        return view('auth.blogdetail')->with('blog',$posts);
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function admin($id)
    {
        //
    }
}
