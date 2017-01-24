<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\globalinfo;

use File;

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

			//Check if the image array is empty, ifso put our placeholder in the object
			if(empty($item['images'][0])){
				$object = (object) ['file' => 'logo.svg', 'caption' => 'TastyMatch logo', 'description' => ''];
				$item['images'][0] = $object;
			}
		}

		return $object;
	}

	public static function getAllImages($object){
		//Get the comma separated image string from the database and get the images from the images table put this all in a new array
		foreach ($object as $item) {
			$ids = GlobalInfo::explodeString($item->images_id);

			$item->images = images::whereIn('id', $ids)->get();
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

	/**
	 * Delete the images from the storage folder
	 * @return \Illuminate\Http\Response
	 */
	public static function deleteFromFolder($request){

		//Get all the component data
		$data = $request->all();

		//Loop through the array containing the url of the images that will be deleted
		foreach ($data['jsondata'] as $image_item) {

			$path = storage_path() . $image_item[0];

			//Check if image exist
			if(file_exists($path)) {
				//Delete the image from the folder
				File::delete($path);

				//REMOVE ITEM FROM DB
				//$image_item[0] = element path
				//$image_item[1] = element id
				//$image_item[2] = media id
			}
		}
	}
}
