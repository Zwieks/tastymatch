<!-- {{$debugpath}} -->
<div class="content product-wrapper foodstand-menu-items">
    @if( isset($page_content['getEvent']->facility_gas) || 
    	isset($page_content['getEvent']->facility_water) ||
    	isset($page_content['getEvent']->facility_electricity))
	    <h2>{{ Lang::get('detailpage.event-details') }}</h2>
	    <section>
	    	<h3>{{ Lang::get('forms.facilities-label') }}</h3>
	    	<ul>
	    		@if( isset($page_content['getEvent']->facility_gas))
	    			<li>{{$page_content['getEvent']->facility_gas}}</li>
	    		@endif

	    		@if( isset($page_content['getEvent']->facility_water))
	    			<li>{{$page_content['getEvent']->facility_water}}</li>
	    		@endif

	    		@if( isset($page_content['getEvent']->facility_electricity))
	    			<li>{{$page_content['getEvent']->facility_electricity}}</li>
	    		@endif
	    	</ul>
	    </section>
	@endif

	@if( isset($page_content['getEvent']->construct_datestart) || isset($page_content['getEvent']->construct_dateend))
	    <section>
	    	<h3>{{ Lang::get('forms.construct-label') }}</h3>
	    	<div>
	    		@if( isset($page_content['getEvent']->construct_datestart))
	    			<span>{{$page_content['getEvent']->construct_datestart}}</span>
	    		@endif

	     		@if( isset($page_content['getEvent']->construct_dateend))
	     			<span> {{ Lang::get('forms.form-separator-to') }} </span>
	    			<span>{{$page_content['getEvent']->construct_dateend}}</span>
	    		@endif		

	    		<span> {{ Lang::get('forms.form-indication-hours') }}</span>
	    	</div>
	    </section>
	@endif  

	@if( isset($page_content['getEvent']->deconstruct_datestart) || isset($page_content['getEvent']->deconstruct_dateend))
	    <section>
	    	<h3>{{ Lang::get('forms.removing-label') }}</h3>
	    	<div>
	    		@if( isset($page_content['getEvent']->deconstruct_datestart))
	    			<span>{{$page_content['getEvent']->deconstruct_datestart}}</span>
	    		@endif

	     		@if( isset($page_content['getEvent']->deconstruct_dateend))
	     			<span> {{ Lang::get('forms.form-separator-to') }} </span>
	    			<span>{{$page_content['getEvent']->deconstruct_dateend}}</span>
	    		@endif		

	    		<span> {{ Lang::get('forms.form-indication-hours') }}</span>
	    	</div>
	    </section>
	@endif  

	@if( isset($page_content['getEvent']->amountstart) || isset($page_content['getEvent']->amountend))
	    <section>
	    	<h3>{{ Lang::get('forms.form-indication-lease') }}</h3>
	    	<div>
	    		@if( isset($page_content['getEvent']->amountstart))
	    			<span class="form-separator form-indication">&euro;</span>
	    			<span>{{$page_content['getEvent']->amountstart}}</span>
	    		@endif

	     		@if( isset($page_content['getEvent']->amountend) )
	     			<span> {{ Lang::get('forms.form-separator-to') }} </span>
	     			<span class="form-separator form-indication">&euro;</span>
	    			<span>{{$page_content['getEvent']->amountend}}</span>
	    		@endif
	    	</div>
	    </section>
	@endif  	  	
</div>