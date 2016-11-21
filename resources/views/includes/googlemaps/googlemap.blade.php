<!-- {{$debugpath}} -->
<h2>{{ Lang::get('googlemaps.maptitle-events') }}</h2>
<div id="google-maps" class="google-maps-large"></div>
@hasSection('script')
    @yield('script')
@endif
