<!-- {{$debugpath}} -->
{{--Render GoogleMaps --}}
@include('includes.googlemaps.googlemap')

{{--Render Create products --}}
@include('pages.homepage.templates.create-product')

{{--Render the user items--}}
@include('pages.homepage.templates.useritem', ['object' => $user_items, 'title' => lang::get('overviewitems.user-items-title')])

{{--Render GoogleMaps --}}
@include('includes.agendaslider.agendaslider')
{{--{{ $user }}--}}