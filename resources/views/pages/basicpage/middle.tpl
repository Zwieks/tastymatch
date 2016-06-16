<!-- [TID] -->
<article class="page-middle">
	{* @TODO: Vergeet niet in al je middle.tpl templates de page-meta.tpl te renderen *}
	{render style='page-meta'}
	<h1 itemprop="name">{$this->getTitle()|escape}</h1>

	{if $this->countChildComponents('intro')}
		<div class="page-intro-container">
			{$this->renderContainer('intro', 'intro')}
		</div>
	{/if}

	{render style='maincontent'}

	{if $this->countChildComponents('content')}
		<div class="page-content-container">
			{$this->renderContainer('content')}
		</div>
	{/if}

	{render style='extracontent'}
</article>