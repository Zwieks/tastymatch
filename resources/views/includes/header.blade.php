<!-- [{{$debugpath}}] -->
<header class="page-header">
	<div class="inner">
		<figure class="page-logo">
			 <a href="/" title="{{ Lang::get('basicpage.logotitle') }}">
				 <img src="{{ asset('img/logo.png') }}" alt="Logo {{ $globals->title }}">
			 </a>
		</figure>

		@include('pages.basicpage.navmain')

		<!-- {tray 'topright'} -->

		@if ($type != 'homepage')
			<div itemscope itemtype="http://schema.org/WebSite">
			<link itemprop="url" href="{$smarty.server.SERVER_NAME|escape}">
		@endif
<!-- 		<form class="page-searchbox" method="get" action="{$zoekpagina->getUrl()|escape}" itemprop="potentialAction" itemscope itemtype="http://schema.org/SearchAction">
			<meta itemprop="target" content="{$zoekpagina->getUrl()|escape}?q={literal}{q}{/literal}">
			<input type="search" name="q" placeholder="{_ 'Vul uw zoekterm in'}" itemprop="query-input">
			<button type="submit">{_ 'Zoek'}</button>
		</form> -->
		@if ($type != 'homepage')
			</div>
		@endif
	</div>
</header>