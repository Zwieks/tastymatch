<!-- {{$debugpath}} -->
<div class="typesoverview-wrapper {{strtolower(str_replace(' ', '-', $title))}}">
	<h2 class="typesoverview-maintitle">{{ $title }}</h2>
	@foreach(json_decode($object) as $item)
		@if($loop->iteration <= 4)
			@if(isset($item->url) && isset($item->slug))
				<a href="/{{$item->url}}/{{$item->slug}}" class="typesoverview-item">
			@else
				<div class="typesoverview-item">
			@endif
				<section class="typesoverview-item-wrapper">
					@if(isset(reset($item->images)->file))
						@php($image = reset($item->images)->file)
					@else
						@php($image = 'logo.svg')
					@endif

					@if($image != '')
						<figure class="image-wrapper image-2-3">
							<img class="image" src="/img/uploads/{{ $image }}"/>
						</figure>
					@endif

					<div class="typesoverview-text-wrapper">
						@if(isset($item->name))
							<h3 class="typesoverview-title">{{ $item->name }}</h3>
						@endif

						@if(isset($item->description))
							<p class="typesoverview-text">{{ str_limit($item->description, 100) }}</p>
						@endif

						@if(isset($item->views))
							<span class="typesoverview-views">{{ $item->views }} keer bekeken</span>
						@endif
					</div>

					@if(isset($item->keywords) && !empty($item->keywords))
						<div class="typesoverview-keywords">
							<h3 class="typesoverview-title">{{Lang::get('overviewitems.keywords-title-'.strtolower($title))}}</h3>
							<ul class="keyword-items">
								@foreach(explode(',', $item->keywords) as $keyword)
									<li class="keyword-item">{{ $keyword }}</li>
								@endforeach	
							</ul>	
						</div>	
					@endif	
				</section>

			@if(isset($item->url) && isset($item->slug))
				</a>
			@else
				</div>
			@endif
		@endif
	@endforeach
</div>