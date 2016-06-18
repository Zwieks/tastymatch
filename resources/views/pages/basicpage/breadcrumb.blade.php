<!-- [{{$debugpath}}] -->
{if $breadcrumb = $this->getBreadcrumbs(2)}
	<nav class="page-breadcrumb" id="js-breadcrumb">
		<h2 class="hide-from-layout nocontent">{_ 'Broodkruimelnavigatie'}</h2>
		{if $breadcrumb|count != 1}
		<button type="button" class="breadcrumb-toggler" id="js-toggle-breadcrumb" title="{_ 'Toon het kruimelpad'}" data-arrow="&#9660;"></button>
		<ol itemscope itemtype="http://schema.org/BreadcrumbList">
			{else}
			<ol itemscope itemtype="http://schema.org/BreadcrumbList" class="no-crumb-button">
				{/if}
				<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="crumb-level1">
					<a href="/{if $this->geti18nlang() && $this->geti18nlang() != $website->getI18nManager()->getAllLocaleSlugs()|reset}{$this->geti18nlang()|escape}{/if}" itemprop="item" typeof="WebPage">
						<span itemprop="name" class="crumb-name" data-backtext="{_ 'Terug naar'}">{_ 'Home'}</span>
					</a>
					<meta itemprop="position" content="1">
				</li>

				{foreach $breadcrumb as $crumb}
					<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="crumb-level1">
						{if !$crumb@last}
							<a href="{$crumb->getURL()|escape}" itemprop="item" typeof="WebPage">
								<span itemprop="name" data-backtext="{_ 'Naar'}" class="crumb-name">{$crumb->getTitle()|escape}</span>
							</a>
						{else}
							<span itemprop="name" class="crumb-name">{$crumb->getTitle()|escape}</span>
							{if $crumb->getSiblings() && $crumb->getSiblings()|count > 1}
								<ul class="subcrumb">
									<li class="crumb-active"><a href="{$crumb->getURL()|escape}">{$crumb->getTitle()|escape}</a></li>
									{foreach $crumb->getSiblings(4) as $sibling}
										<li><a href="{$sibling->getURL()|escape}">{$sibling->getTitle()|escape}</a></li>
									{/foreach}

									{if $crumb->getSiblings()|count > 4}
										<li><a href="{$crumb->getURL()|escape}">{_ 'Meer'}</a></li>
									{/if}
								</ul>
								<span class="crumb-arrow" data-arrow="&#9660;"></span>
							{/if}
						{/if}

						<meta itemprop="position" content="{$crumb@iteration+1}">
					</li>
				{/foreach}
			</ol>
	</nav>
{/if}