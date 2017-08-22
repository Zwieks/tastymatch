<!-- {{$debugpath}} -->
<div id="component-menu" class="content product-wrapper foodstand-menu-items">

    <h2>{{ Lang::get('detailpage.foodstand-details') }}</h2>
	<ul>
		@foreach(explode(',', $page_content['info']['menuitems']) as $item) 
			<li>{{$item}}</li>
		@endforeach
	</ul> 
</div>