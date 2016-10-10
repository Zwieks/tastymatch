<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model {

	protected $table = 'blog';

	protected $fillable = array('title','content','author_id');

	public $timestamps = true;

	public function Author(){

    	return $this->belongsTo('App\User');
	}
}