<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;
use App\GlobalInfo;

class ContactController extends Controller
{
	/**
	 * Show a list of all of the application's users.
	 *
	 * @return Response
	 */
	public function index()
	{
		$ContactInfo = GlobalInfo::GetContactInfo();

		return view('auth.contact', ['ContactInfo' => $ContactInfo]);
	}
}