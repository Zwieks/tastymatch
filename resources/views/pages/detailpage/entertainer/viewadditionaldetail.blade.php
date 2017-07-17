<!-- {{$debugpath}} -->
<div class="content product-wrapper details detailpage-items">
    <h2>{{ Lang::get('detailpage.event-additinaldetails') }}</h2>

    @if(isset($page_content['getEntertainer']->entertainertype_ids))
     	@php ($types = Lang::get('entertainertypes'))
     	@php ($entertainertypes_array = explode(',',$page_content['getEntertainer']->entertainertype_ids))

        <section class="detailitem-wrapper">
	    	<h3>{{ Lang::get('forms.entertainertype') }}</h3>
	    	<div class="block-items-wrapper">
                @foreach($types as $type)
	                @if(isset($page_content['getEntertainer']->entertainertype_ids) && in_array($loop->iteration,$entertainertypes_array))
	                	<span class="block-item">{{$type}}</span>
	                @endif
                @endforeach
	    	</div>
	    </section>
    @endif
</div>