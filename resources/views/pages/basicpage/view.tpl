<!DOCTYPE html>
{$type = $this->getType()}
<html lang="{$this->geti18nlang()|escape}" itemscope {if $type === 'homepage'}itemtype="http://schema.org/WebSite"{else}itemtype="http://schema.org/WebPage"{/if}>
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		{* Above meta-tag has to be set directly after opening <head> tag *}

		<!--  _______________________________  -->
		<!-- |							     | -->
		<!-- | Realisatie:  iWink			 | -->
		<!-- | Website:	    www.iwink.nl	 | -->
		<!-- | E-Mail:	    info@iwink.nl	 | -->
		<!-- | Tel. nr.:	050 - 210 12 00  | -->
		<!-- |_______________________________| -->
		<!--								   -->

		{*
			ORIGINEEL PROJECTTEAM:

			Projectmanager: @TODO: Invullen
			Designer:       @TODO: Invullen
			Codeur:         @TODO: Invullen
			Programmeur:    @TODO: Invullen
		*}

		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
		{cache}
			{render style='head-meta'}
			{render style='head-socials'}
			{render style='head-link'}
		{/cache}

		{require_css href='/css/site.less' media='screen' less=true output='html5'}
		{require_css href='/css/print.less' media='print' less=true output='html5'}
		{* @TODO: Remove the line below at start project, also remove the 'test' folder from this project *}
		{require_css href='/css/test/test.less' less=true output='html5'}
		{render style='add-to-header'}
		{render_css}

		{render style='favicons'}

		{strip}
			{capture assign='pagetitle'}
				{if $this->getSEOTitle()}
					{$this->getSEOTitle()|escape}
				{elseif $type === 'homepage'}
					{$website->getWebsiteName()|escape}
				{else}
					{$this->getTitle()|escape} › {$website->getWebsiteName()|escape}
				{/if}
			{/capture}
		{/strip}

		<title>{$pagetitle|raw}</title>
	</head>

	<body{if $type === 'homepage'} itemscope itemtype="http://schema.org/WebSite"{/if} class="component-{$this->getType()|escape} preload">
		{* heading for document outline *}
		<h2 class="hide-from-layout">{$pagetitle|raw}</h2>

		{* Responsive navigation trigger *}
		{* @TODO: Remove this checkbox below if you don't have a responsive website, otherwise remove this line *}
		<input type="checkbox" id="js-nav-trigger" class="nav-trigger">

		{render style='header'}

		<div class="page-website-wrapper">
			{render style='wrapper'}

			{render style='footer'}
		</div>

		{* @TODO: Remove code below if you don't have a responsive website, otherwise remove this line *}
		<div class="page-mobile-nav-container">
			{* The 'for' of the labels correspondents with the 'id' of the input below the body-tag *}
			{* Responsive navigation is handles with Less in the inav.less files *}
			<label class="nav-toggle" id="js-nav-toggle" for="js-nav-trigger"><span class="wrapper"><span></span></span><strong>{_ 'Menu'}</strong></label>
            <div class="nav-wrapper" id="js-nav-wrapper"></div>
            <div class="nav-closer" id="js-nav-closer"></div>
		</div>

		{* JAVASCRIPT *}
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
		{render style='add-to-bottom'}
		{render style='google-analytics'}
		{render style='scripts'}
	</body>
</html>