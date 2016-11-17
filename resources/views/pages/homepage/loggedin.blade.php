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

{{--Render the most viewed items--}}
<div class="typesoverview-wrapper">
	@foreach($most_viewed as $item)
		<a href="/" class="typesoverview-item">
			<section>
				<figure class="image-wrapper">
					<img class="image" src="/img/uploads/{{ $item->images->first()['file'] }}" alt="{{ $item->name }}"/>
				</figure>
				<h2>{{ $item->name }}</h2>
				<p>{{ $item->description }}</p>
				<span class="views">{{ $item->views }}</span>
			</section>
		</a>
	@endforeach
</div>
{{$most_viewed}}