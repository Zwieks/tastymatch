<!-- [{{$debugpath}}] -->
<nav class="page-mainmenu" id="js-mainmenu" itemscope itemtype="http://schema.org/SiteNavigationElement">
	<h2 class="hide-from-layout nocontent">{{ Lang::get('basicpage.mainnavtitle') }}</h2>
	<ul class="level-1">

		<li class="home level-1-item">
			<a href="/" itemprop="url" data-icon="o">
				<span itemprop="name">{{ Lang::get('menus.home') }}</span>
			</a>
			<meta itemprop="position" content="1">
		</li>

		<li class="level-1-item">
			<a href="{{ Lang::get('menus.about-url') }}" itemprop="url" data-icon="c">
				<span itemprop="name">{{ Lang::get('menus.about') }}</span>
			</a>
			<meta itemprop="position" content="2">
		</li>	

		<li class="level-1-item">
			<a href="{{ Lang::get('menus.contact-url') }}" itemprop="url" data-icon="e">
				<span itemprop="name">{{ Lang::get('menus.contact') }}</span>
			</a>
			<meta itemprop="position" content="2">
		</li>	

		@if(Auth::check())
	        <li class="level-1-item">
				<a href="{{ url('/logout') }}" itemprop="url" data-icon="m">
					<span itemprop="name">{{ Lang::get('menus.logout') }}</span>
				</a>
				<meta itemprop="position" content="2">
			</li>
		@else
			<li class="level-1-item">
				<a href="{{ Lang::get('menus.register-url') }}" itemprop="url" data-icon="a">
					<span itemprop="name">{{ Lang::get('menus.register') }}</span>
				</a>
				<meta itemprop="position" content="2">
			</li>

			<li class="level-1-item">
				<a href="{{ Lang::get('menus.blog-url') }}" itemprop="url" data-icon="b">
					<span itemprop="name">{{ Lang::get('menus.blog') }}</span>
				</a>
				<meta itemprop="position" content="2">
			</li>	

			<li class="level-1-item">
				<a href="{{ Lang::get('menus.login-url') }}" itemprop="url" data-icon="n">
					<span itemprop="name">{{ Lang::get('menus.login') }}</span>
				</a>
				<meta itemprop="position" content="2">
			</li>
		@endif	

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