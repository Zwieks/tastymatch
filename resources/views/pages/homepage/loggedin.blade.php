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

<h2>{{ Lang::get('googlemaps.maptitle-events') }}</h2>
<div id="google-maps" class="google-maps-large"></div>
@hasSection('script')
    @yield('script')
@endif

{{--Render the most viewed items--}}
<div class="typesoverview-wrapper">
	<h2 class="typesoverview-maintitle">Meest bekeken evenementen</h2>
	@foreach($most_viewed as $item)
		<a href="/" class="typesoverview-item">
			<section class="typesoverview-item-wrapper">
				<figure class="image-wrapper">
					<img class="image" src="/img/uploads/{{ $item->images->first()['file'] }}" alt="{{ $item->name }}"/>
				</figure>
				<div class="typesoverview-text-wrapper">
					<h3 class="typesoverview-title">{{ $item->name }}</h3>
					<p class="typesoverview-text">{{ str_limit($item->description, 100) }}</p>
					<span class="typesoverview-views">{{ $item->views }} keer bekeken</span>
				</div>	
			</section>
		</a>
	@endforeach
</div>
{{$most_viewed}}