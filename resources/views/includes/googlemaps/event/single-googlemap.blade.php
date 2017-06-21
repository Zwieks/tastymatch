<!-- {{$debugpath}} -->
<div class="google-maps-introwrapper">
	<div class="google-maps-intro">
		<h2>Bekijk alle evenementen op de kaart</h2>
		<p>Nijestee biedt ruimte. We zijn met circa 13.500 huurwoningen de grootste corporatie in de stad Groningen. Ongeveer 22.000 mensen huren een woning van Nijestee. In vrijwel alle wijken biedt Nijestee woningen aan</p>
	</div>
	@include('forms.googlemapslocationfilter')
</div>

<div class="google-maps-wrapper">
	<div id="google-maps" class="google-maps-large"></div>
	<div id="infowindow-content">
    	<img src="" width="16" height="16" id="place-icon">
    	<span id="place-name"  class="title"></span><br>
    	<span id="place-address"></span>
   	</div>
</div>