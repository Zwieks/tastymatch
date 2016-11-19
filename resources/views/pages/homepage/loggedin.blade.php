<!-- {{$debugpath}} -->
{{--Render the navigation tabs --}}
<ul class='navigation-tabs'>
	<li>
		<a class="navigation-tab" href="/">{{ Lang::get('menus.userfoodstands-title') }}</a>
	</li>
	<li>
		<a class="navigation-tab" href="/">{{ Lang::get('menus.userentertainers-title') }}</a>
	</li>
	<li>
		<a class="navigation-tab active" href="/">{{ Lang::get('menus.userevents-title') }}</a>
	</li>
</ul>

{{--Render GoogleMaps --}}
<h2>{{ Lang::get('googlemaps.maptitle-events') }}</h2>
<div id="google-maps" class="google-maps-large"></div>
@hasSection('script')
    @yield('script')
@endif

{{--Render the most viewed items--}}
@include('pages.homepage.templates.overview', ['object' => $most_viewed, 'title' => lang::get('overviewitems.mostviewed-events-title')])

{{--Render the latest items--}}
@include('pages.homepage.templates.overview', ['object' => $latest, 'title' => lang::get('overviewitems.latest-events-title')])

{{-- $user --}}