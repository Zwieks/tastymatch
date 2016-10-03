<?php
	// Return TRUE or FALSE if $uri passed in is the current page uri
	//useful to check which menu items should be "active"
	function current_page($uri = '/')
	{
		return strstr(request()->path(), strtolower($uri));
	}
?>