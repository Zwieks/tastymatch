<!-- {{$debugpath}} -->
<div class="content product-wrapper details detailpage-items">
    <h2>{{ Lang::get('detailpage.entertainer-additinaldetails') }}</h2>

    @if(isset($page_content['getEntertainer']->entertainertype_ids))
     	@php ($types = Lang::get('entertainertypes'))
     	@php ($entertainertypes_array = explode(',',$page_content['getEntertainer']->entertainertype_ids))
        @php ($tags_array = explode(',',$page_content['getEntertainer']->tags))

        <section class="detailitem-wrapper">
	    	<h3>{{ Lang::get('forms.entertainertags-label') }}</h3>
	    	<div class="block-items-wrapper">
                @foreach($tags_array as $tag)
	                	<span class="block-item">{{$tag}}</span>
                @endforeach
	    	</div>
	    </section>
    @endif
</div>