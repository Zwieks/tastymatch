<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
	protected $table = 'images';

	protected $fillable = array('blog_id','user_id','user_id','file','size','caption','description');

	public $timestamps = true;

}
