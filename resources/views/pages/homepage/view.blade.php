@if(Auth::check())
	@include('pages.homepage.entertainer-home')
	{{$user}}
@else
	@include('pages.homepage.home')
@endif