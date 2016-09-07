<!-- {{$debugpath}} -->
<meta itemprop="image" content="{{ URL::asset('img/logo.svg') }} ">
<meta itemprop="headline" content="@yield('title')">
{{-- <meta itemprop="datePublished" content="{{File::lastModified(Route::getCurrentRoute()->getPath())}}"> --}}
<meta itemprop="url" content="{{Request::url()}}">
<meta itemprop="keywords" content="{{ Lang::get('basicpage.keywords') }}">

<span itemscope itemtype="http://schema.org/Organization">
	<meta itemprop="logo" content="{{ URL::asset('img/logo.svg') }}">
	<meta itemprop="url" content="{{ Request::url() }}">
	<meta itemprop="streetAddress" content="{{ $globals->adress }}">
	<meta itemprop="postalCode" content="{{ $globals->postcode }}">
	<meta itemprop="addressLocality" content="{{ $globals->city }}">
	<meta itemprop="addressCountry" content="{{ $globals->country }}">
	<meta itemprop="telephone" content="{{ $globals->phone }}">
	<meta itemprop="email" content="{{ $globals->email }}">

	@if (isset($globals->twitter) && $globals->twitter != '')
		<meta itemprop="sameAs" content="{{ $globals->twitter }}">
	@endif

	@if (isset($globals->linkedin) && $globals->linkedin != '')
		<meta itemprop="sameAs" content="{{ $globals->linkedin }}">
	@endif

	@if (isset($globals->facebook) && $globals->facebook != '')
		<meta itemprop="sameAs" content="{{ $globals->facebook }}">
	@endif

	@if (isset($globals->youtube) && $globals->youtube != '')
		<meta itemprop="sameAs" content="{{ $globals->youtube }}">
	@endif		

	@if (isset($globals->instagram) && $globals->instagram != '')
		<meta itemprop="sameAs" content="{{ $globals->instagram }}">
	@endif
</span>