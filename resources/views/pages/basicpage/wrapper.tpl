<!-- [TID] -->
<main class="page-wrapper">
	<div class="inner">

		{*
			@TODO: Kijk goed welke containers wel en niet gerenderd worden in het project:
			- Schakel deze uit in Kirra
			- Verwijder de templates (meestal left.tpl en right.tpl)
			- Verwijder de bijbehorende CSS
			- En schoon deze template ook op
			- Kijk of submenu.tpl nodig is (anders submenu.tpl ook verwijderen)
		*}

		{if $this->getType() != 'homepage'}
			{render style='breadcrumb'}
		{/if}

		<div class="page-content page-overview">
			{render style='middle'}

			{if $hoofdmenulevel = $this->getBreadcrumbs(2)|reset}
				{$submenu = $hoofdmenulevel->getMenuItems()}
			{/if}
			{if $this->countChildComponents('left') || $submenu}
				{render style='left'}
			{/if}

			{if $this->countChildComponents('right')}
				{render style='right'}
			{/if}
		</div>
	</div>
</main>