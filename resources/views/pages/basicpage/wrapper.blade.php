<!-- {{$debugpath}} -->
<main class="page-wrapper">
	@hasSection('heroimage')
		@yield('heroimage')
	@endif

	<article class="inner">
		@if ($type != 'homepage')
			<!-- {render style='breadcrumb'} -->
		@endif

		<div class="page-content page-overview">
			@hasSection('content')
				<div class="page-middle">
					@include('pages.basicpage.page-meta')

					<h1 itemprop="name" class="seo-title">@yield('title')</h1>

					@yield('content')
				</div>
			@endif

			@hasSection('right')
				<aside class="page-right">
					@yield('right')
				</aside>
			@endif

			@hasSection('left')
				<aside class="page-left">
					@yield('left')
				</aside>
			@endif
		</div>
	</article>
</main>