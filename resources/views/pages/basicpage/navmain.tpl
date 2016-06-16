<!--[TID]-->
{cache cache_key='mainnav_'|cat:$website->getRepositoryRevision():'_':$this->getLanguageCode()}
	<nav class="page-mainmenu" id="js-mainmenu" itemscope itemtype="http://schema.org/SiteNavigationElement">
		<h2 class="hide-from-layout nocontent">{_ 'Hoofdnavigatie'}</h2>
		<ul class="level-1">
			{symbol 'startpagina'}
			{if $startpagina}
				<li class="home level-1-item" data-staticid="{$startpagina->getStaticId()|escape}">
					<a href="{$startpagina->getCanonicalUrl()|escape}" itemprop="url">
						<span itemprop="name">{_ 'Home'}</span>
					</a>
					<meta itemprop="position" content="1">
				</li>
			{/if}

			{symbol 'hoofdmenu'}
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
			{/if}
		</ul>
	</nav>
{/cache}

{* Execute this Javascript early, so the iNav plugin handles the active classes correctly *}
{require_inline_script offset=1}
	jQuery.each({$this->getStaticPath()|split:'/'|json_encode}, function(key, value){
		if( !value ) {
			return;
		}

		// Set active menu item
		jQuery('#js-mainmenu').find('li[data-staticid="' + value + '"]').addClass('active');
	});
{/require_inline_script}