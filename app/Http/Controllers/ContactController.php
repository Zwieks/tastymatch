<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
	/**
	 * Show a list of all of the application's users.
	 *
	 * @return Response
	 */
	public function index()
	{
		$globalinfo = DB::select('select `kvk`,`email` from global_info');

		return view('auth.contact', ['globalinfo' => $globalinfo]);
	}
}