<!-- {{$debugpath}} -->
@if(Auth::check())
	@include('pages.homepage.loggedin')
@else
	@include('pages.homepage.home')
@endif