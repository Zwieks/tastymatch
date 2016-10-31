<!-- {{$debugpath}} -->
@if(Auth::check())
	<section class="page-submenu">
		<h2 class="submenu-title">{{ Lang::get('menus.submenu-title') }}</h2>
		<ul class="submenu-items">
			<li>
				<a class="submenu-item" href="{{ Lang::get('menus.profile-url') }}" data-icon="a">{{ Lang::get('menus.profile') }}</a>
			</li>
			<li>
				<a class="submenu-item" href="{{ Lang::get('menus.profile-url') }}" data-icon="a">{{ Lang::get('menus.profile') }}</a>
			</li>
			<li>
				<a class="submenu-item active" href="{{ Lang::get('menus.profile-url') }}" data-icon="a">{{ Lang::get('menus.profile') }}</a>
			</li>
			<li>
				<a class="submenu-item" href="{{ Lang::get('menus.profile-url') }}" data-icon="a">{{ Lang::get('menus.profile') }}</a>
			</li>
		</ul>
	</section>
@endif