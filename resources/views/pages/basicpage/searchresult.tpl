<!-- [{{$debugpath}}] -->
{cache}
	<article class="search-result">
		<a href="{$this->getUrl()|escape}">
			<h2>{$this->getTitle()|escape|highlight:$smarty.get.q:'highlighted'}</h2>

			<ul class="search-result-url">
				<li>{_ 'Home'}</li>
				{foreach $this->getBreadcrumbs(2) as $crumb}
					{if !$crumb@last}
						<li>{$crumb->getTitle()|escape}</li>
					{else}
						<li>{$crumb->getTitle()|escape}</li>
					{/if}
				{foreachelse}
					<li>{$this->getTitle()|escape}</li>
				{/foreach}
			</ul>

			{$alinea = $this->getFirst('alinea')}
			{if $alinea && $alinea->tekst}
				<p>{$alinea->tekst|html_truncate:160|escape|highlight:$smarty.get.q:'highlighted'}</p>
				<span class="readmore">{_ 'Lees verder'}</span>
			{/if}
		</a>
	</article>
{/cache}