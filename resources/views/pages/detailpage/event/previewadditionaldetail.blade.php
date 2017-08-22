<!-- {{$debugpath}} -->
<div class="content product-wrapper details detailpage-items">
    <h2>{{ Lang::get('detailpage.event-additinaldetails') }}</h2>

	@if( isset($page_content['getLocationdetails']['eventlocation']))
	    <section class="detailitem-wrapper">
	    	<h3>{{ Lang::get('forms.eventlocation') }}</h3>
	    	<div>
	    		{{ $page_content['getLocationdetails']['eventlocation']}}
	    	</div>
	    </section>
	@endif 

	@if( isset($page_content['getAdditionalinfo']['type']))
	    <section class="detailitem-wrapper">
	    	<h3>{{ Lang::get('forms.eventtype') }}</h3>
	    	<div>
	    		{{ Lang::get('eventtypes.type-'.$page_content['getAdditionalinfo']['type']) }}
	    	</div>
	    </section>
	@endif 

	@if( isset($page_content['getAdditionalinfo']['eventdatestart']) || isset($page_content['getAdditionalinfo']['eventdateend']))
	    <section class="detailitem-wrapper">
	    	<h3>{{ Lang::get('forms.eventdate') }}</h3>
	    	<div>
	    		@if( isset($page_content['getAdditionalinfo']['eventdatestart']))
	    			<span>{{ Carbon\Carbon::parse($page_content['getAdditionalinfo']['eventdatestart'])->format('d M Y') }}</span>
	    		@endif

	     		@if( isset($page_content['getAdditionalinfo']['eventdateend']) )
	     			<span> {{ Lang::get('forms.form-separator-to') }} </span>
	    			<span>{{ Carbon\Carbon::parse($page_content['getAdditionalinfo']['eventdateend'])->format('d M Y') }}</span>
	    		@endif
	    	</div>
	    </section>
	@endif 

	@if( isset($page_content['getAdditionalinfo']['filter_visitors']) )
	    <section class="detailitem-wrapper">
	    	<h3>{{ Lang::get('forms.visitorscount-label') }}</h3>
	    	<div>
	    		@if( isset($page_content['getAdditionalinfo']['filter_visitors']))
	    			<span>{{$page_content['getAdditionalinfo']['filter_visitors']}}</span>
	    		@endif
	    	</div>
	    </section>
	@endif  
</div>