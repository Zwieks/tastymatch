<!-- [{{$debugpath}}] -->

{* VARIABLES *}

{$website_name = $website->getWebsiteName()}

{if $this->getTitle()}
	{$sm_title = $this->getTitle()}
{/if}

{if $this->getDescription()}
	{$sm_desc = $this->getDescription()}
{elseif $alinea && $alinea->tekst}
	{$sm_desc = $alinea->tekst|html_truncate:160}
{/if}

{if $startpagina && $startpagina->getName()}
	{$homeTitle = $startpagina->getName()|escape}
{/if}

{* OPEN GRAPH / FACEBOOK *}
<meta property="og:type" content="article">
<meta property="og:locale" content="{$this->getLocale()|escape}">
{if $this->getType() === 'homepage' && $startpagina && $homeTitle}
	<meta property="og:url" content="{$this->getFullUrl()|escape|replace:$homeTitle:''}">
{else}
	<meta property="og:url" content="{$this->getFullUrl()|escape}">
{/if}
{if $settings && $settings->title}
	<meta property="og:site_name" content="{$settings->title|escape}">
{/if}
{if $sm_title}
	<meta property="og:title" content="{$sm_title|escape}">
{/if}
{if $sm_desc}
	<meta property="og:description" content="{$sm_desc|escape}">
{/if}
{if $image && $image->attachment}
	<meta property="og:image" content="{upload file=$image->attachment style='og_image' fullurl=true noimg=true}">
{/if}

{* TWITTER CARDS *}
<meta name="twitter:card" content="summary">
{if $image && $image->attachment}
	<meta name="twitter:image" content="{upload file=$image->attachment style='tw_image' fullurl=true noimg=true}">
{/if}
{if $sm_title}
	<meta name="twitter:title" content="{$sm_title|escape}">
{/if}
{if $sm_desc}
	<meta name="twitter:description" content="{$sm_desc|escape}">
{/if}

{* GOOGLE+ *}
{if $sm_title}
	<meta itemprop="name" content="{$sm_title|escape}">
{/if}
{if $website_name}
	<meta itemprop="headline" content="{$website_name|escape}">
{/if}
{if $sm_desc}
	<meta itemprop="description" content="{$sm_desc|escape}">
{/if}
{if $image && $image->attachment}
	<meta itemprop="image" content="{upload file=$image->attachment style='itemprop_image' fullurl=true noimg=true}">
{/if}