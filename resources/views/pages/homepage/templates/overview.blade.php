<!-- {{$debugpath}} -->
<div class="typesoverview-wrapper">
	<h2 class="typesoverview-maintitle">{{ $title }}</h2>
	@foreach($object as $item)
		@if($loop->iteration <= 6)
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
		@endif	
	@endforeach
</div>