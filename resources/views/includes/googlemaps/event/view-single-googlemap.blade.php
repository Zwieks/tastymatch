<!-- {{$debugpath}} -->
<div class="google-maps-introwrapper">
	<div class="google-maps-intro">
		<h2>{{ Lang::get('googlemaps.filter-view-location-label') }}</h2>
		<p>{{ Lang::get('googlemaps.filter-view-location-text') }}</p>
	</div>

	<div id="component-locationdetails" class="changed product-wrapper">
		@include('forms.googlemapsdirectionfilter')
	</div>	
</div>

<div class="google-maps-wrapper">
	<div id="google-maps" class="google-maps-large"></div>
	<div id="infowindow-content">
    	<img src="" width="16" height="16" id="place-icon">
    	<span id="place-name"  class="title"></span><br>
    	<span id="place-address"></span>
   	</div>
</div>