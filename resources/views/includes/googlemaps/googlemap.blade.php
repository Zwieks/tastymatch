<!-- {{$debugpath}} -->
<div class="google-maps-introwrapper">
	<div class="google-maps-intro">
		<h2>{{ Lang::get('googlemaps.maptitle-events') }}</h2>
		<p>Nijestee biedt ruimte. We zijn met circa 13.500 huurwoningen de grootste corporatie in de stad Groningen. Ongeveer 22.000 mensen huren een woning van Nijestee. In vrijwel alle wijken biedt Nijestee woningen aan</p>
	</div>
	
	<ul class="google-maps-legenda">
		<li>
			<span data-icon="z">Evenementen opzoek naar entertainer en foodstands</span>
		</li>
		<li>
			<span data-icon="d">Foodstands</span>
		</li>
		<li>
			<span data-icon="L">Entertainers</span>
		</li>
	</ul>	
</div>
<div id="google-maps" class="google-maps-large"></div>

<div class="google-maps-filter-wrapper">
	@include('forms.googlemapsfilter')
</div>

@hasSection('script')
    @yield('script')
@endif
