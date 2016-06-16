<!-- [TID] -->
<link rel="stylesheet" href="{{ URL::asset('css/app.css') }}" />
<!-- {if $image}
	<meta itemprop="image" content="{upload file=$image style='bestanden' noimg=true fullurl=true}">
{/if}

{$alinea = $this->getFirst('alinea')}
{if $alinea && $alinea->tekst}
	<meta itemprop="headline" content="{$alinea->tekst|html_truncate:80|escape}">
{/if}

{if $this->getKeywords()}
	<meta itemprop="keywords" content="{$this->getKeywords()|escape}">
{/if}
 -->
<!-- <meta itemprop="datePublished" content="{'c'|date:$this->getLastModified(true)|escape}">
<meta itemprop="url" content="{$this->getFullURL()|escape}">

<span itemscope itemtype="http://schema.org/Organization">
	{* @TODO: Check of het pad naar het logo nog klopt. *}
	<meta itemprop="logo" content="{$this->getFullUrl()|escape}/img/logo.svg">
	<meta itemprop="url" content="{$this->getRequest()->getProtocol()|escape}://{$this->getRequest()->getHost()|escape}">

	{symbol 'config'}
	{if $config}
		{* @TODO: Check of deze adresgegevens op de juiste manier worden opgehaald. *}
		{$address           = $config->address}
		{$house_number      = $config->house_number}
		{$zip               = $config->zip}
		{$city              = $config->city}
		{$country           = $config->country}
		{$phone_number      = $config->phone_number}
		{$fax_number        = $config->fax_number}
		{$email_address     = $config->email_address}

		<span itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
			{if $address || $house_number}
				<meta itemprop="streetAddress" content="{if $address}{$address|escape}{/if}{if $house_number} {$house_number|escape}{/if}">
			{/if}
			{if $zip}
				<meta itemprop="postalCode" content="{$zip|escape}">
			{/if}
			{if $city}
				<meta itemprop="addressLocality" content="{$city|escape}">
			{/if}
			{if $country}
				<meta itemprop="addressCountry" content="{$country|escape}">
			{/if}
			{if $phone_number}
				<meta itemprop="telephone" content="{$phone_number|escape}">
			{/if}
			{if $fax_number}
				<meta itemprop="faxNumber" content="{$fax_number|escape}">
			{/if}
			{if $email_address}
				<meta itemprop="email" content="{$email_address|escape}">
			{/if}
		</span>

		{* @TODO: Check of de social url´s op de juiste manier worden opgehaald. *}
		{$twitter   = $config->twitter_url}
		{$linkedin  = $config->linkedin_url}
		{$facebook  = $config->facebook_url}
		{$youtube   = $config->youtube_url}
		{$instagram = $config->instagram_url}

		{if $twitter}
			<meta itemprop="sameAs" content="{$twitter|url|escape}">
		{/if}
		{if $linkedin}
			<meta itemprop="sameAs" content="{$linkedin|url|escape}">
		{/if}
		{if $facebook}
			<meta itemprop="sameAs" content="{$facebook|url|escape}">
		{/if}
		{if $youtube}
			<meta itemprop="sameAs" content="{$youtube|url|escape}">
		{/if}
		{if $instagram}
			<meta itemprop="sameAs" content="{$instagram|url|escape}">
		{/if}
	{/if}
</span> -->