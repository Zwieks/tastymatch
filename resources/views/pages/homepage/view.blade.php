@if(Auth::check())
	@include('pages.homepage.entertainer-home')
	{{$users}}
@else
	@include('pages.homepage.home')
@endif