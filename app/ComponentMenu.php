<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class ComponentMenu extends Model
{
    protected $table = 'component_menu';

    /**
	 * The users that belong to the event.
	 */
	public function detailpage()
	{
		return $this->belongsTo('App\ComponentDetailpage');
	}

	/**
	 * Create a comma separated string for the menu
	 */
	public static function createString($menu){
		$prefix = $stringmenu = '';

		foreach ($menu as $item)
		{
			if(isset($item['menuitem'])){
				$stringmenu .= $prefix . $item['menuitem'];
				$prefix = ',';
			}
		}

		$stringmenu = rtrim($stringmenu, ',');

		return $stringmenu;
	}

	public static function store($data){
        $ComponentMenu = new ComponentMenu;

        $menu = ComponentMenu::createString($data['form']);

        if(isset($menu) && $menu != '')
        	$ComponentMenu->content = $menu;

        $ComponentMenu->save();

        return $ComponentMenu->id;
	}

	public static function updateFields($component_id,$data){
		$menu = ComponentMenu::createString($data['form']);

		if(!isset($menu))
			$menu = '';

		DB::table('component_menu')
	    	->where('id', $component_id)
	    	->update(['content' => $menu]);
	}
}
