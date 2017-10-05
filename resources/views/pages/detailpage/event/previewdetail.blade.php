<!-- {{$debugpath}} -->
@if( isset($page_content['getStandinfo']['filter_facility-gas']) || 
	isset($page_content['getStandinfo']['filter_facility-water']) ||
	isset($page_content['getStandinfo']['filter_facility-electricity']) ||
	isset($page_content['getStandinfo']['construct_datestart']) || 
	isset($page_content['getStandinfo']['construct_dateend']) || 
	isset($page_content['getStandinfo']['deconstruct_datestart']) || 
	isset($page_content['getStandinfo']['deconstruct_dateend'])	||
	isset($page_content['getStandinfo']['amountstart']) || 
	isset($page_content['getStandinfo']['amountend']))

	<div class="content product-wrapper detailpage-items">
	    @if( isset($page_content['getStandinfo']['filter_facility-gas']) || 
	    	isset($page_content['getStandinfo']['filter_facility-water']) ||
	    	isset($page_content['getStandinfo']['filter_facility-electricity']))
		    <h2>{{ Lang::get('detailpage.event-details') }}</h2>
		    <section class="detailitem-wrapper">
		    	<h3>{{ Lang::get('forms.facilities-label') }}</h3>
		    	<ul>
		    		@if( isset($page_content['getStandinfo']['filter_facility-gas']))
		    			<li>{{$page_content['getStandinfo']['filter_facility-gas']}}</li>
		    		@endif

		    		@if( isset($page_content['getStandinfo']['filter_facility-water']))
		    			<li>{{$page_content['getStandinfo']['filter_facility-water']}}</li>
		    		@endif

		    		@if( isset($page_content['getStandinfo']['filter_facility-electricity']))
		    			<li>{{$page_content['getStandinfo']['filter_facility-electricity']}}</li>
		    		@endif
		    	</ul>
		    </section>
		@endif

		@if( isset($page_content['getStandinfo']['construct_datestart']) || isset($page_content['getStandinfo']['construct_dateend']))
		    <section class="detailitem-wrapper">
		    	<h3>{{ Lang::get('forms.construct-label') }}</h3>
		    	<div>
		    		@if( isset($page_content['getStandinfo']['construct_datestart']))
		    			<span>{{$page_content['getStandinfo']['construct_datestart']}}</span>
		    		@endif

		     		@if( isset($page_content['getStandinfo']['construct_dateend']))
		     			<span> {{ Lang::get('forms.form-separator-to') }} </span>
		    			<span>{{$page_content['getStandinfo']['construct_dateend']}}</span>
		    		@endif		

		    		<span> {{ Lang::get('forms.form-indication-hours') }}</span>
		    	</div>
		    </section>
		@endif  

		@if( isset($page_content['getStandinfo']['deconstruct_datestart']) || isset($page_content['getStandinfo']['deconstruct_dateend']))
		    <section class="detailitem-wrapper">
		    	<h3>{{ Lang::get('forms.removing-label') }}</h3>
		    	<div>
		    		@if( isset($page_content['getStandinfo']['deconstruct_datestart']))
		    			<span>{{$page_content['getStandinfo']['deconstruct_datestart']}}</span>
		    		@endif

		     		@if( isset($page_content['getStandinfo']['deconstruct_dateend']))
		     			<span> {{ Lang::get('forms.form-separator-to') }} </span>
		    			<span>{{$page_content['getStandinfo']['deconstruct_dateend']}}</span>
		    		@endif		

		    		<span> {{ Lang::get('forms.form-indication-hours') }}</span>
		    	</div>
		    </section>
		@endif  

		@if( isset($page_content['getStandinfo']['amountstart']) || isset($page_content['getStandinfo']['amountend']))
		    <section class="detailitem-wrapper">
		    	<h3>{{ Lang::get('forms.form-indication-lease') }}</h3>
		    	<div>
		    		@if( isset($page_content['getStandinfo']['amountstart']))
		    			<span class="form-separator form-indication">&euro;</span>
		    			<span>{{$page_content['getStandinfo']['amountstart']}}</span>
		    		@endif

		     		@if( isset($page_content['getStandinfo']['amountend']) )
		     			<span> {{ Lang::get('forms.form-separator-to') }} </span>
		     			<span class="form-separator form-indication">&euro;</span>
		    			<span>{{$page_content['getStandinfo']['amountend']}}</span>
		    		@endif
		    	</div>
		    </section>
		@endif  	  	
	</div>
@endif	