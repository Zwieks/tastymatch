<!-- {{$debugpath}} -->
{!! Form::open(['method' => 'get', 'class' => 'detailpage-locationinformation form-filter webbeheer-formulier changed', 'itemprop' => 'potentialAction', 'itemscope' => '', 'itemtype' => 'http://schema.org/SearchAction']) !!}
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<fieldset>
		<ul class="velden">
            <!-- EVENT LOCATION -->
            <li class="form-label">
                <span>{{ Lang::get('forms.route-maps') }}:</span>
            </li>

            <li class="form-input-textfield">
                {!! Form::text('eventlocation', 
                '',
                ['placeholder' => Lang::get('forms.route-placeholder'),'class' => 'smallbox text no-submit', 'id' => 'googlemaps-dropdown-route']) !!}
                <span class="icon" data-icon="y"></span>
            </li>
            @if(isset($page_content['getEvent']))
                {{ Form::hidden('lat', 
                    isset($page_content['getEvent']->lat) ? $page_content['getEvent']->lat : '',
                    array('id' => 'place_lat')) }}
                {{ Form::hidden('lng', 
                    isset($page_content['getEvent']->long) ? $page_content['getEvent']->long : '',
                    array('id' => 'place_lng')) }}
            @elseif($page_content['getLocationdetails'])
                {{ Form::hidden('lat', 
                    isset($page_content['getLocationdetails']['lat']) ? $page_content['getLocationdetails']['lat'] : '',
                    array('id' => 'place_lat')) }}
                {{ Form::hidden('lng', 
                    isset($page_content['getLocationdetails']['long']) ? $page_content['getLocationdetails']['lng'] : '',
                    array('id' => 'place_lng')) }}
            @endif


            <li class="hidden">
                @if(isset($page_content['getEvent']))
                    {!! Form::hidden('eventlocation', 
                        isset($page_content['getEvent']->location) ? $page_content['getEvent']->location : '',
                        ['placeholder' => Lang::get('forms.location-placeholder'),'class' => 'smallbox text no-submit', 'id' => 'location-end', 'readonly' => 'readonly', 'value' => isset($page_content['getEvent']->location) ? $page_content['getEvent']->location : '']) !!}
                @elseif(isset($page_content['info']))
                    {!! Form::hidden('eventlocation', 
                        isset($page_content['info']['location']) ? $page_content['info']['location'] : '',
                        ['placeholder' => Lang::get('forms.location-placeholder'),'class' => 'smallbox text no-submit', 'id' => 'location-end', 'readonly' => 'readonly', 'value' => isset($page_content['info']['location']) ? $page_content['info']['location'] : '']) !!}
                @endif    
            </li>
		</ul>
        <div id="directions-panel">
            <p class="empty">{{ Lang::get('googlemaps.mapempty-directions') }}</p>
        </div>
		<ul class="autocomplete mCustomScrollbar" id="js-autocomplete-results"></ul>
	</fieldset>
{!! Form::close() !!}