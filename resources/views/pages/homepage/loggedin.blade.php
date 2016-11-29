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

{{--Render the user items--}}
@include('pages.homepage.templates.useritem', ['object' => $user_items, 'title' => lang::get('overviewitems.user-items-title')])

{{--{{ $user }}--}}
{{--$user--}}