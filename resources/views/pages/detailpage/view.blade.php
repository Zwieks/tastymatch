<!-- {{$debugpath}} -->
<div class="component-wrapper">
    <div class="intro">
        <div id="component-intro" class="product-wrapper">
            <div class="content">
            	<h2>{{$page_content['getIntro']['name']}}</h2>
                <p>{!! html_entity_decode($page_content['getIntro']['content']) !!}</p>
            </div>
        </div>
    </div>

    <div class="details-wrapper">
        <div id="component-contact" class="details product-wrapper">
            <h2>{{ Lang::get('tinymce.detailpage-foodstand-contact-intro')  }}</h2>

            <div class="content">
               <p>{!! html_entity_decode($page_content['getContact']['content']) !!}</p>
               <ul class="velden contact-list">
               		@if($page_content['getContact']['phone'] != '')
               			<li data-icon="V">
               				<a href="tel:{{$page_content['getContact']['phone']}}">{{$page_content['getContact']['phone']}}</a>
               			</li>
               		@endif	
               		@if($page_content['getContact']['email'] != '')
               			<li data-icon="e">
               				<a href="mailto:{{$page_content['getContact']['email']}}">{{$page_content['getContact']['email']}}</a>
               			</li>
               		@endif	    
               		@if($page_content['getContact']['site'] != '')
               			<li data-icon="3">
               				<a href="{{$page_content['getContact']['site']}}" target="_blank">{{$page_content['getContact']['site']}}</a>
               			</li>
               		@endif	                   		           		
               </ul>

                <ul class="velden socialmedia-list">
               		@if($page_content['getContact']['facebook'] != '')
               			<li>
               				<a data-icon="f" href="{{$page_content['getContact']['facebook']}}" target="_blank"></a>
               			</li>
               		@endif	
               		@if($page_content['getContact']['twitter'] != '')
               			<li>
               				<a data-icon="l" href="{{$page_content['getContact']['twitter']}}" target="_blank"></a>
               			</li>
               		@endif	    
               		@if($page_content['getContact']['linkedin'] != '')
               			<li>
               				<a data-icon="g" href="{{$page_content['getContact']['linkedin']}}" target="_blank"></a>
               			</li>
               		@endif	  
               		@if($page_content['getContact']['instagram'] != '')
               			<li>
               				<a data-icon="4" href="{{$page_content['getContact']['instagram']}}" target="_blank"></a>
               			</li>
               		@endif	  
               		@if($page_content['getContact']['googleplus'] != '')
               			<li>
               				<a data-icon="q" href="{{$page_content['getContact']['googleplus']}}" target="_blank"></a>
               			</li>
               		@endif	                 		               		                 		           		
               </ul>	
            </div>
        </div>

        {{-- MENU MODULE--}}
        @include($detail)
    </div>
</div>  

<div class="component-wrapper mediaitems-wrapper">
    @foreach($page_content['getMediaItems'] as $key => $item)
        @include('layouts.templates.mediaitem', array('data'=> $item ))
    @endforeach
</div>

{{--Render GoogleMaps --}}
@include('includes.googlemaps.single-googlemap')