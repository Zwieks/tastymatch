<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class GlobalInfo extends Model
{

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'global_info';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */

	public static function GetContactInfo() {
		$contactinfo = DB::table('global_info')->select('kvk', 'email')->first();

		return $contactinfo;
	}
}
