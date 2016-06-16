<!--[TID]-->
<header class="page-header">
	<div class="inner">
		<figure class="page-logo">
			 <a href="/{if $this->geti18nlang() && $this->geti18nlang() != $website->getI18nManager()->getAllLocaleSlugs()|reset}{$this->geti18nlang()|escape}{/if}" title="{_ 'Ga naar de homepage'}">
				 <img src="/img/logo.svg" alt="Logo {$website->getWebsiteName()|escape}">
			 </a>
		</figure>

		{render style='navmain'}

		{tray 'topright'}

		{if $this->getType() != 'homepage'}
			<div itemscope itemtype="http://schema.org/WebSite">
			<link itemprop="url" href="{$smarty.server.SERVER_NAME|escape}">
		{/if}
		<form class="page-searchbox" method="get" action="{$zoekpagina->getUrl()|escape}" itemprop="potentialAction" itemscope itemtype="http://schema.org/SearchAction">
			<meta itemprop="target" content="{$zoekpagina->getUrl()|escape}?q={literal}{q}{/literal}">
			<input type="search" name="q" placeholder="{_ 'Vul uw zoekterm in'}" itemprop="query-input">
			<button type="submit">{_ 'Zoek'}</button>
		</form>
		{if $this->getType() != 'homepage'}
			</div>
		{/if}
	</div>
</header>