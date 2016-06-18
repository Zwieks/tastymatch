	<footer class="page-footer">
		<div class="inner">
			{symbol 'footermenu'}
			{if $footermenu}
				{if $documents = $footermenu->getMenuItems()}
					<nav class="page-footermenu" itemscope itemtype="http://schema.org/SiteNavigationElement">
						<h2 class="hide-from-layout nocontent">{_ 'Secundaire navigatie'}</h2>
						<ul>
							{foreach $documents as $document}
								<li>
									<a href="{$document->getUrl()|escape}" itemprop="url"><span itemprop="name">{$document->getTitle()|escape}</span></a>
									<meta itemprop="position" content="{$document@iteration}">
								</li>
							{/foreach}
						</ul>
					</nav>
				{/if}
			{/if}

			<ul class="footer-credits">
				{* @TODO: Indien ontwerp en ontwikkeling: Realisatie: iWink *}
				{* @TODO: Indien alleen ontwikkeling: Technische realisatie: iWink *}
				<li><a href="//iwink.nl/" target="_blank">Realisatie: iWink</a></li>
				<li><a href="//kirra.nl/" target="_blank">Powered by Kirra</a></li>
			</ul>
		</div>
	</footer>