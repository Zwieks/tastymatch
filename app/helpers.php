<?php
	// Return TRUE or FALSE if $uri passed in is the current page uri
	//useful to check which menu items should be "active"
	function current_page($uri = '/')
	{
		//Check if the URL is not only a slash if so.. remove it we need the name in the url for the route
		if($uri != '/'){
			$uri = ltrim($uri, '/');
		}

		return strstr(request()->path(), strtolower($uri));
	}

	//Get the user county location based on IP
	function getUserCountry()
	{
		//Get the user IP
		$ip = $_SERVER['REMOTE_ADDR'];

		//Get the user location object
		$location = geoip()->getLocation($ip);

		//Get only the country name
		$county = $location->country;

		return $county;
	}

	function createSlug($title){
		$delimiter = '-';

		$slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $title))))), $delimiter));

		return $slug;
	}
?>