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
		$users = DB::select('select * from users where id = ?', [1]);

		return view('auth.contact', ['users' => $users]);
	}
}