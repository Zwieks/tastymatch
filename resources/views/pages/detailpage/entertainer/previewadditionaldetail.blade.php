<!-- {{$debugpath}} -->
@if(isset($page_content['info']['entertainer_types']) && $page_content['info']['entertainer_types'] != '')
    <div class="content product-wrapper details detailpage-items">
        <h2>{{ Lang::get('detailpage.entertainer-additinaldetails') }}</h2>

        @if(isset($page_content['info']['entertainer_types']))
         	@php ($types = Lang::get('entertainertypes'))
         	@php ($entertainertypes_array = explode(',',$page_content['info']['entertainer_types']))
            @php ($tags_array = explode(',',$page_content['info']['tags']))

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
@endif    