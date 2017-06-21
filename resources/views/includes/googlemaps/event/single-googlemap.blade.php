<!-- {{$debugpath}} -->
<div class="formfilter-wrapper">
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