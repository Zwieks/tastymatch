<!-- [{{$debugpath}}] -->
<div class="page-middle">
	@include('pages.basicpage.page-meta')
	<h1 itemprop="name" class="seo-title">@yield('title')</h1>
		@yield('content')
	</div>
</div>