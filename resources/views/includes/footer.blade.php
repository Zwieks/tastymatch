<!-- {{$debugpath}} -->
<footer class="page-footer">
	<div class='footer-wrapper'>
		<nav class="page-footermenu" itemscope itemtype="http://schema.org/SiteNavigationElement">
			<h2 class="hide-from-layout nocontent">{{ Lang::get('basicpage.seo-footertitle') }}</h2>
			<ul>
				<li>
					<a href="{{ Lang::get('menus.contact-url') }}" itemprop="url"><span itemprop="name">{{ Lang::get('menus.contact') }}</span></a>
					<meta itemprop="position" content="1">
				</li>	

				<li>
					<a href="{{ Lang::get('menus.about-url') }}" itemprop="url"><span itemprop="name">{{ Lang::get('menus.about') }}</span></a>
					<meta itemprop="position" content="2">
				</li>	

				<li>
					<a href="{{ Lang::get('menus.blog-url') }}" itemprop="url"><span itemprop="name">{{ Lang::get('menus.blog') }}</span></a>
					<meta itemprop="position" content="3">
				</li>	

				<li>
					<a href="{{ Lang::get('menus.terms-url') }}" itemprop="url"><span itemprop="name">{{ Lang::get('menus.terms') }}</span></a>
					<meta itemprop="position" content="4">
				</li>	

				<li>
					<a href="{{ Lang::get('menus.userterms-url') }}" itemprop="url"><span itemprop="name">{{ Lang::get('menus.userterms') }}</span></a>
					<meta itemprop="position" content="5">
				</li>		

				<li>
					<a href="{{ Lang::get('menus.cookies-url') }}" itemprop="url"><span itemprop="name">{{ Lang::get('menus.cookies') }}</span></a>
					<meta itemprop="position" content="6">
				</li>														
			</ul>	
		</nav>	

		<ul class="socialmedia">
			<li><a class="facebook-item" href="#" data-icon="f"></a>
			<li><a class="twitter-item" href="#" data-icon="l"></a>
			<li><a class="youtube-item" href="#" data-icon="p"></a>
			<li><a class="googleplus-item" href="#" data-icon="q"></a>
			<li><a class="linkedin-item" href="#" data-icon="g"></a>
		</ul>	
	</div>	

	<ul class="footer-credits">
		<li><a href="//use-up.nl/" target="_blank">{{ Lang::get('basicpage.footercredits') }}</a></li>
	</ul>
</footer>