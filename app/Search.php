<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    //Default search
	public static function getSearchResults($input){
		return $input;
	}
}
