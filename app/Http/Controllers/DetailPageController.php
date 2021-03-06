<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Detailpage;
use App\Detailpage_User;
use App\ComponentMediaItem;
use App\ComponentMediaItem_User;
use App\Sessions;

use Cache;

class DetailPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Detailpage::with('getContent')->get();
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

    public function createPage(Request $request, $type, $slug)
    {
        //Get the user information
        $userid = $request->session()->get('user.global.id');

        //Check if the page is already created
        $page = Detailpage_User::CheckPageState($slug,$userid);

        //Type of item
        $uppercase_type = ucfirst($type);

        if(isset($page) && $page != 'new'){
            return redirect()->route('UpdatePage', ['type' => $type,'detailpage_id' => $slug]);
        }else{
            //Check if the slug is related to one of the page id's of the user
            $record = Detailpage_User::checkRelation($request,$slug);

            if($record != ''){
                $detailpage_id = $slug;

                //Get the user information
                $user = $request->session()->get('user.global');

                //Set page type
                $page_type = 'concept';

                //Set the item type
                $item_type = $type;

                //return the view with the user session data
                return view('auth.detailpages.create', compact('user','detailpage_id','page_type','item_type'));
            }else{
                return view('errors.404');
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function previewPage(Request $request, $item_type, $cache_id)
    {
        //Get the preview page content
        $page_content = json_decode($request->session()->get($cache_id), true);
        
        //Get the user information
        $userid = $request->session()->get('user.global.id');

        //Return the view
        if(empty($page_content)){
            return view('auth.detailpages.preview', compact('userid','page_content','item_type','cache_id'));
        }else{
            return view('auth.detailpages.preview', compact('userid','page_content','item_type','cache_id'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePage(Request $request, $item_type, $detailpage_id)
    {
        //Get the user information
        $user = $request->session()->get('user.global');

        //Get content detailpage and check the type relations
        $page_content = Detailpage::checkPageType($detailpage_id, $item_type);

        //Set page type
        $page_type = 'update';

        //Return the view
        if(empty($page_content) || $page_content['type'] != $item_type){
            return view('errors.404');
        }else{
            return view('auth.detailpages.update', compact('user','detailpage_id','page_content', 'item_type','page_type'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $slug)
    {
        //Get the user information
        $userid = $request->session()->get('user.global.id');

        $detailpage_id = Detailpage::add($userid,$slug);

        $cache_id = str_random(20);
        Sessions::setPreviewPageSession($request, $cache_id, '');

        //return the view with the user session data
        return redirect()->route('CreatePage', ['item_type' => $slug,'detailpage_id' => $detailpage_id]);
    }

    public function deleteComponents(Request $request){
        ComponentMediaItem::deleteComponent($request);  
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
