@if(Auth::check())
	@include('pages.homepage.entertainer-home')
@else
	@include('pages.homepage.home')						
@endif