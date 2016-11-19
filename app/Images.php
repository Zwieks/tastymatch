<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\globalinfo;

class Images extends Model
{
	protected $table = 'images';

	protected $fillable = array('blog_id','user_id','user_id','file','size','caption','description');

	public $timestamps = true;

	public static function getProductImages($object){
		//Get the comma separated image string from the database and get the images from the images table put this all in a new array
		foreach ($object as $item) {
			$ids = GlobalInfo::explodeString($item['images_id']);

			$item['images'] = images::whereIn('id', $ids)->get();
		}

		return $object;
	}

	public static function getAllUserProductImages($user){
		//Get the event images
        $user->events = images::getProductImages($user->events);   

        //Get the foodstand images
        $user->foodstands = images::getProductImages($user->foodstands);   

         //Get the entertainer images
        $user->entertainers = images::getProductImages($user->entertainers); 

        return $user;
	}
}
