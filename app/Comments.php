<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
	protected $table = 'blog_comments';

	protected $fillable = array('user_id','blog_id','parrentblog_id','comment');

	public $timestamps = true;

}
