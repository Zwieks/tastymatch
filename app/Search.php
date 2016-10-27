<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    //Default search
	public static function getSearchResults($input){

		tidy_get_opt_doc()
		//Search Logic here
		return $input;
	}
}
