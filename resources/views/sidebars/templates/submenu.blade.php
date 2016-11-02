<!-- {{$debugpath}} -->
@if(Auth::check())
	<section class="page-submenu">
		<h2 class="sidebar-title">{{ Lang::get('menus.submenu-create') }}</h2>
		<ul class="submenu-items">
			<li>
				<a class="submenu-item" href="{{ Lang::get('menus.createfoodstand-url') }}" data-icon="d">{{ Lang::get('menus.createfoodstand') }}</a>
			</li>
			<li>
				<a class="submenu-item" href="{{ Lang::get('menus.createentertainer-url') }}" data-icon="L">{{ Lang::get('menus.createentertainer') }}</a>
			</li>
			<li>
				<a class="submenu-item" href="{{ Lang::get('menus.createevent-url') }}" data-icon="z">{{ Lang::get('menus.createevent') }}</a>
			</li>
		</ul>

		<h2 class="sidebar-title">{{ Lang::get('menus.submenu-items') }}</h2>
		<ul class="submenu-items">
			<li>
				<a class="submenu-item" href="{{ Lang::get('menus.settings-url') }}" data-icon="F">{{ Lang::get('menus.settings') }}</a>
			</li>
			<li>
				<a class="submenu-item" href="{{ Lang::get('menus.profile-url') }}" data-icon="a">{{ Lang::get('menus.profile') }}</a>
			</li>
			<li>
				<a class="submenu-item" href="{{ Lang::get('menus.agenda-url') }}" data-icon="H">{{ Lang::get('menus.agenda') }}</a>
			</li>
		</ul>
	</section>
@endif