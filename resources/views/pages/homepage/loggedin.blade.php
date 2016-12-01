<!-- {{$debugpath}} -->
{{--Render GoogleMaps --}}
@include('includes.googlemaps.googlemap')

{{--Render the most viewed event items--}}
@include('pages.homepage.templates.overview', ['object' => $most_viewed, 'title' => lang::get('overviewitems.featured-items-title')])

{{--Render Create products --}}
@include('pages.homepage.templates.create-product')

{{--Render the user items--}}
@include('pages.homepage.templates.useritem', ['object' => $user_items, 'title' => lang::get('overviewitems.user-items-title')])

{{--Render Agenda items --}}
@if(!empty($user->agenda) && count($user->agenda) > 0)
    @include('includes.agendaslider.agendaslider')
@endif
{{--{{ $user }}--}}
{{--{{ $most_viewed }}--}}