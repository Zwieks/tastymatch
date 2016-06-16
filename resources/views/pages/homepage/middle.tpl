<!-- [TID] -->
<section class="page-middle">
	{render style='page-meta'}

	{* @TODO: Make sure you set a new H1 on the homepage *}
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
</section>