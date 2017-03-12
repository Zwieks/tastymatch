@if(!empty($results))
<!-- {{$debugpath}} -->
    <li class="ajax-search-item">
    	<section class="autocomplete-content">
    		@foreach ($results as $index => $objects)
				@if(!empty($objects))
					<div class="items-wrapper-{{  strtolower($index) }}">
						<h3>{{ $index }}</h3>
						<ul class="autocomplete-items">
						   @foreach ($objects as $object)
							   @if($loop->iteration < 4)
								  <li>
									<a
										@if(isset($object->name))
											name="{{$object->name}}"
										@else
											name=""
										@endif
									   	id="{{$object->id}}"
									   	class="autocomplete-item"
									   	href="/{{$object->url}}{{$object->slug}}"
									   	target="_blank"
									   	@if(isset($object->location))
									   		data-loc="{{$object->location}}"
									   	@else
									   		data-loc=""
									   	@endif
									   	@if(isset($object->description))
									   		data-des="{{$object->description}}"
										@else
											data-des=""
										@endif
										@if(isset($object->type_id))
											type="{{$object->type_id}}"
										@else
											type=""
										@endif
										@if(isset($object->searchable))
											data-searchable="{{$object->searchable}}"
										@else
											data-searchable=""
										@endif										
									>
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
					</div>
				@endif
    		@endforeach
	    </section>   
    </li>
@endif
