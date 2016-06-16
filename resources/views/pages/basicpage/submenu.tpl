<!-- [TID] -->

{*
	@TODO: Wanneer dit project geen submenu bevat:
	- Verwijder deze template.
	- Verwijder de render uit 'basicpage > left.tpl'.
	- Verwijder de check uit 'basicpage > wrapper.tpl'.
	- Verwijder 'public/css/project/submenu.less'.
	- Verwijder de .submenu.less import uit site.less
*}

{if $parent = $this->getParentDocument()}
	{if $parent->getType() === 'menu' && $this->getMenuItems()}
		{function menu}
			{foreach $node->getMenuItems() as $child}
				{if $child@first}<ul>{/if}
				<li class="{if $child->isActive()}active{/if}{if $child->getMenuItems()} has-submenu{/if}">
					<a href="{$child->getUrl()|escape}">{$child->getTitle()|escape}</a>
					{menu node=$child}
				</li>
				{if $child@last}</ul>{/if}
			{/foreach}
		{/function}

		<nav class="page-submenu">
			<h2 class="hide-from-layout nocontent">{_ 'Subnavigatie'}</h2>
			{menu node=$this}
		</nav>
	{elseif $parent->getType() !== 'systemnode'}
		{render style='submenu' object=$parent}
	{/if}
{/if}