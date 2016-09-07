<!-- {{$debugpath}} -->
<main class="page-wrapper">
	<article class="inner">


		@if ($type != 'homepage')
			<!-- {render style='breadcrumb'} -->
		@endif

		<div class="page-content page-overview">
			@include('pages.basicpage.middle')
<!-- 			{if $hoofdmenulevel = $this->getBreadcrumbs(2)|reset}
				{$submenu = $hoofdmenulevel->getMenuItems()}
			{/if}
			{if $this->countChildComponents('left') || $submenu}
				{render style='left'}
			{/if}

			{if $this->countChildComponents('right')}
				{render style='right'}
			{/if} -->
		</div>
	</article>
</main>