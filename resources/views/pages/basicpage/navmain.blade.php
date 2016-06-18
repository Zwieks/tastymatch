<!-- [{{$debugpath}}] -->
<nav class="page-mainmenu" id="js-mainmenu" itemscope itemtype="http://schema.org/SiteNavigationElement">
	<h2 class="hide-from-layout nocontent">{{ Lang::get('basicpage.mainnavtitle') }}</h2>
	<ul class="level-1">
		<li class="home level-1-item">
			<a href="/" itemprop="url">
				<span itemprop="name">{{ Lang::get('basicpage.titlemainnav') }}</span>
			</a>
			<meta itemprop="position" content="1">
		</li>

<!-- 		{symbol 'hoofdmenu'}
		{if $hoofdmenu}
			{foreach $hoofdmenu->getMenuItems() as $doc}
				{$childdocs = $doc->getMenuItems()}
				<li data-staticid="{$doc->getStaticId()|escape}" class="level-1-item{if $childdocs} subnav{/if}">
					<a href="{$doc->getUrl()|escape}" itemprop="url">
						<span itemprop="name">{$doc->getTitle()|escape}</span>
					</a>
					<meta itemprop="position" content="{$doc@iteration + 1}">

					{if $childdocs}
						<ul class="level-2">
							{foreach $childdocs as $childdoc}
								<li data-staticid="{$childdoc->getStaticId()|escape}" class="level-2-item">
									<a href="{$childdoc->getUrl()|escape}" itemprop="url"><span itemprop="name">{$childdoc->getTitle()|escape}</span></a>
								</li>
							{/foreach}
						</ul>
						<span class="js-open-subnav open-subnav"></span>
					{/if}
				</li>
			{/foreach}
		{/if} -->
	</ul>
</nav>

<!-- Execute this Javascript early, so the iNav plugin handles the active classes correctly -->
@yield('script')