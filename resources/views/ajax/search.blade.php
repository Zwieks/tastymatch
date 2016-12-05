<!-- {{$debugpath}} -->
@if(!empty($results))
    <li class="ajax-search-item">
    	<section class="autocomplete-content">
    		@foreach ($results as $index => $objects)
    			@if(!empty($objects))
	    			<h3>{{ $index }}</h3>
	    			<ul class="autocomplete-items">
				       @foreach ($objects as $object)
					       @if($loop->iteration < 4)
					          <li>
					          	<a class="autocomplete-item" href="/{{$object->url}}{{$object->slug}}" target="_blank">
					          		@if(isset($object->images[0]) && $object->images[0]->file != '')
					          			@php($image = $object->images[0]->file)
					          		@elseif(!isset($object->keyword))
					          			@php($image = 'logo.svg')
					          		@else	
					          			@php($image = '')
					          		@endif

					          		@if($image != '')
							          	<figure class="image-wrapper image-2-3">
							          		<img class="image" src="/img/uploads/{{ $image }}"/>
							          	</figure>
							        @endif  	
						          	<div class="autocomplete-text">
						          		<h4 class="autocomplete-name">{{ $object->name }}</h4>
						          	</div>
						        </a>  	
					          </li>
					        @endif  
				       @endforeach
	    			</ul>	
	    		@endif	
    		@endforeach
	    </section>   
    </li>
@endif
