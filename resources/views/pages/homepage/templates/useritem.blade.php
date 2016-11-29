<!-- {{$debugpath}} -->
<div class="user-items-overview-wrapper">
	<h2 class="user-items-maintitle">{{ $title }}</h2>
	@foreach($object as $item)
		<a href="/{{ $item->slug }}" class="user-item-wrapper">

			<div class="user-item-image-wrapper">
				<figure class="image-wrapper image-3-5">
					<img src="/img/uploads/{{ reset($item->images)->file }}" class="image" />
				</figure>
			</div>

			<div class="user-item-detail-wrapper">
				<section class="user-item-text">
					<h3>{{ $item->name }}</h3>
					<p>{{ str_limit($item->description, 100) }}</p>
				</section>

				<div class="user-item-info">
					<dl>
						<dt>Bekeken:</dt>
						<dd>{{ $item->views }} keer</dd>
						<dt>URL:</dt>
						<dd>{{ URL::to('/')}}/{{ $item->slug  }}</dd>
						<dt>Aangemaakt op:</dt>
						<dd>{{ Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</dd>
					</dl>
				</div>
			</div>
		</a>
	@endforeach
</div>