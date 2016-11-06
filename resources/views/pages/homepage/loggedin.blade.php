<ul class='navigation-tabs'>
	<li>
		<a class="navigation-tab" href="/">{{ Lang::get('menus.userfoodstands-title') }}</a>
	</li>
	<li>
		<a class="navigation-tab" href="/">{{ Lang::get('menus.userentertainers-title') }}</a>
	</li>
	<li>
		<a class="navigation-tab active" href="/">{{ Lang::get('menus.userevents-title') }}</a>
	</li>
</ul>	

<div id="google-maps" class="google-maps-large"></div>
@hasSection('script')
    @yield('script')
@endif
{{$user}}