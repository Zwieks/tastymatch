<!-- {{$debugpath}} -->
<div class="google-maps-introwrapper">
	<div class="google-maps-intro">
		<h2>{{ Lang::get('googlemaps.maptitle-events') }}</h2>
		<p>Nijestee biedt ruimte. We zijn met circa 13.500 huurwoningen de grootste corporatie in de stad Groningen. Ongeveer 22.000 mensen huren een woning van Nijestee. In vrijwel alle wijken biedt Nijestee woningen aan</p>
	</div>
	
	<ul class="google-maps-legenda">
		<li>
			<span data-icon="z">{{ Lang::get('products.product-events') }}</span>
		</li>
		<li>
			<span data-icon="d">{{ Lang::get('products.product-foodstands') }}</span>
		</li>
		<li>
			<span data-icon="L">{{ Lang::get('products.product-entertainers') }}</span>
		</li>
	</ul>	
</div>
<div id="google-maps" class="google-maps-large"></div>

<div class="formfilter-wrapper">
	@include('forms.googlemapsfilter')
</div>