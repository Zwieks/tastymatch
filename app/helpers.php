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
?>