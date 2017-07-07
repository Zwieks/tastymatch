<!-- {{$debugpath}} -->
<div class="content product-wrapper detailpage-items">
    <h2>{{ Lang::get('detailpage.event-additinaldetails') }}</h2>

	@if( isset($page_content['getEvent']->type_id))
	    <section class="detailitem-wrapper">
	    	<h3>{{ Lang::get('forms.eventtype') }}</h3>
	    	<div>
	    		{{ Lang::get('eventtypes.type-'.$page_content['getEvent']->type_id) }}
	    	</div>
	    </section>
	@endif 

	@if( isset($page_content['getEvent']->time_start) || isset($page_content['getEvent']->time_end))
	    <section class="detailitem-wrapper">
	    	<h3>{{ Lang::get('forms.eventdate') }}</h3>
	    	<div>
	    		@if( isset($page_content['getEvent']->time_start))
	    			<span>{{ Carbon\Carbon::parse($page_content['getEvent']->time_start)->format('d M Y') }}</span>
	    		@endif

	     		@if( isset($page_content['getEvent']->time_end) )
	     			<span> {{ Lang::get('forms.form-separator-to') }} </span>
	    			<span>{{ Carbon\Carbon::parse($page_content['getEvent']->time_end)->format('d M Y') }}</span>
	    		@endif
	    	</div>
	    </section>
	@endif 

	@if( isset($page_content['getEvent']->visitors_indication) )
	    <section class="detailitem-wrapper">
	    	<h3>{{ Lang::get('forms.visitorscount-label') }}</h3>
	    	<div>
	    		@if( isset($page_content['getEvent']->visitors_indication))
	    			<span>{{$page_content['getEvent']->visitors_indication}}</span>
	    		@endif
	    	</div>
	    </section>
	@endif  
</div>