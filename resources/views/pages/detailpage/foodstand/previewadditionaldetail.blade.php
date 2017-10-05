<!-- {{$debugpath}} -->
@if(isset($page_content['info']['foodstand_types']))
	<div class="content product-wrapper details detailpage-items">
	    <h2>{{ Lang::get('detailpage.foodstand-additinaldetails') }}</h2>
	    @if(isset($page_content['info']['foodstand_types']))
	     	@php ($types = Lang::get('foodstandtypes'))
	     	@php ($foodstandtypes_array = explode(',',$page_content['info']['foodstand_types']))

	        <section class="detailitem-wrapper">
		    	<h3>{{ Lang::get('forms.foodstandtype') }}</h3>
		    	<div class="block-items-wrapper">
	                @foreach($types as $type)
		                @if(isset($page_content['info']['foodstand_types']) && in_array($loop->iteration,$foodstandtypes_array))
		                	<span class="block-item">{{$type}}</span>
		                @endif
	                @endforeach
		    	</div>
		    </section>
	    @endif   

	    @if(isset($page_content['info']['dimension_x']) || isset($page_content['info']['dimension_y']))
	        <section class="detailitem-wrapper">
		    	<h3>{{ Lang::get('forms.foodstanddimensions') }}</h3>
		    	<div>
		    		@if( isset($page_content['info']['dimension_x']))
		    			<span>{{ $page_content['info']['dimension_x'] }}</span>
		    		@endif

		     		@if( isset($page_content['info']['dimension_y']) )
		     			<span class="form-separator">x</span>
		    			<span>{{ $page_content['info']['dimension_y'] }}</span>
		    		@endif
		    		<span class="form-separator form-indication">m<sup>2</sup></span>
		    	</div>
		    </section>
	    @endif   
	</div>
@endif	