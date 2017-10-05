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
                @if(isset($page_content['getContact']['content']) && $page_content['getContact']['content'] != '')
                  <p>{!! html_entity_decode($page_content['getContact']['content']) !!}</p>
                @endif  
               <ul class="velden contact-list">
               		@if(isset($page_content['getContact']['phone']) && $page_content['getContact']['phone'] != '')
               			<li data-icon="V">
               				<a href="tel:{{$page_content['getContact']['phone']}}">{{$page_content['getContact']['phone']}}</a>
               			</li>
               		@endif	
               		@if(isset($page_content['getContact']['email']) && $page_content['getContact']['email'] != '')
               			<li data-icon="e">
               				<a href="mailto:{{$page_content['getContact']['email']}}">{{$page_content['getContact']['email']}}</a>
               			</li>
               		@endif	    
               		@if(isset($page_content['getContact']['site']) && $page_content['getContact']['site'] != '')
               			<li data-icon="3">
               				<a href="{{$page_content['getContact']['site']}}" target="_blank">{{$page_content['getContact']['site']}}</a>
               			</li>
               		@endif	                   		           		
               </ul>

                <ul class="velden socialmedia-list">
               		@if(isset($page_content['getContact']['facebook']) && $page_content['getContact']['facebook'] != '')
               			<li>
               				<a data-icon="f" href="{{$page_content['getContact']['facebook']}}" target="_blank"></a>
               			</li>
               		@endif	
               		@if(isset($page_content['getContact']['twitter']) && $page_content['getContact']['twitter'] != '')
               			<li>
               				<a data-icon="l" href="{{$page_content['getContact']['twitter']}}" target="_blank"></a>
               			</li>
               		@endif	    
               		@if(isset($page_content['getContact']['linkedin']) && $page_content['getContact']['linkedin'] != '')
               			<li>
               				<a data-icon="g" href="{{$page_content['getContact']['linkedin']}}" target="_blank"></a>
               			</li>
               		@endif	  
               		@if(isset($page_content['getContact']['instagram']) && $page_content['getContact']['instagram'] != '')
               			<li>
               				<a data-icon="4" href="{{$page_content['getContact']['instagram']}}" target="_blank"></a>
               			</li>
               		@endif	  
               		@if(isset($page_content['getContact']['googleplus']) && $page_content['getContact']['googleplus'] != '')
               			<li>
               				<a data-icon="q" href="{{$page_content['getContact']['googleplus']}}" target="_blank"></a>
               			</li>
               		@endif	                 		               		                 		           		
               </ul>	
            </div>
        </div>

        {{-- ADDITIONAL DETAIL MODULE--}}
        @include($additionaldetail)

        {{-- DETAIL MODULE--}}
        @include($detail)
    </div>
</div>  

<div class="component-wrapper mediaitems-wrapper">


@if(isset($page_content))
  @foreach($page_content as $key => $item)
    @if("getMediaitems" == substr($key,0,13))
      @if(isset($item['path']) && $item['path'] != '' ||
        (isset($item['content']) && $item['content'] != '') ||
        (isset($item['video']) && $item['video'] != ''))
          @include('layouts.templates.preview-mediaitem', array('data'=> $item ))
      @endif
    @endif
  @endforeach
@endif  
</div>

{{--Render GoogleMaps --}}
@if(isset($page_content['agenda'][0]) || $item_type === 'event' || isset($page_content['getAgendaItems']))
  @include($googlemaps)
@endif  