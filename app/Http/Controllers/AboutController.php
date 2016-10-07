<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;
use App\GlobalInfo;

class AboutController extends Controller
{
	/**
	 * Show a list of all of the application's users.
	 *
	 * @return Response
	 */
	public function index()
	{
		$AboutInfo = GlobalInfo::GetContactInfo();

		return view('auth.about', ['AboutInfo' => $AboutInfo]);
	}
}