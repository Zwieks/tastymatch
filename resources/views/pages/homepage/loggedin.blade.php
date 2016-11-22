<!-- {{$debugpath}} -->
{{--Render the navigation tabs --}}
<!-- <ul class='navigation-tabs'>
	<li>
		<a class="navigation-tab active" href="/">{{ Lang::get('menus.userevents-title') }}</a>
	</li>

	<li>
		<a class="navigation-tab" href="/">{{ Lang::get('menus.userfoodstands-title') }}</a>
	</li>

	<li>
		<a class="navigation-tab" href="/">{{ Lang::get('menus.userentertainers-title') }}</a>
	</li>
</ul> -->
{{--Render GoogleMaps --}}
@include('includes.googlemaps.googlemap')

{{--Render Create products --}}
@include('pages.homepage.templates.create-product')

{{--Render the most viewed event items--}}
@include('pages.homepage.templates.overview', ['object' => $most_viewed_events, 'title' => lang::get('overviewitems.mostviewed-events-title')])

{{--Render the most viewed event items--}}
@include('pages.homepage.templates.overview', ['object' => $most_viewed_foodstands, 'title' => lang::get('overviewitems.mostviewed-foodstands-title')])

{{--Render the most viewed event items--}}
@include('pages.homepage.templates.overview', ['object' => $most_viewed_entertainers, 'title' => lang::get('overviewitems.mostviewed-entertainers-title')])

{{--Render the latest items--}}
@include('pages.homepage.templates.overview', ['object' => $latest_events, 'title' => lang::get('overviewitems.latest-events-title')])

{{--{{ $user }}--}}