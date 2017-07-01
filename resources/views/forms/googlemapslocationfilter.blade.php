<!-- {{$debugpath}} -->
{!! Form::open(['method' => 'get', 'class' => 'detailpage-locationinformation form-filter webbeheer-formulier changed', 'itemprop' => 'potentialAction', 'itemscope' => '', 'itemtype' => 'http://schema.org/SearchAction']) !!}
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<fieldset>
		<ul class="velden">
            <!-- EVENT LOCATION -->
            <li class="form-label">
                <span>{{ Lang::get('forms.location-maps') }}:</span>
            </li>

            <li class="form-input-textfield">
                {!! Form::text('eventlocation', 
                isset($page_content['getEvent']->location) ? $page_content['getEvent']->location : '',
                ['placeholder' => Lang::get('forms.location-placeholder'),'class' => 'smallbox text no-submit', 'id' => 'googlemaps-dropdown']) !!}
                <span class="icon" data-icon="y"></span>
            </li>
                {{ Form::hidden('lat', '', array('id' => 'place_lat')) }}
                {{ Form::hidden('lng', '', array('id' => 'place_lng')) }}
		</ul>
		<ul class="autocomplete mCustomScrollbar" id="js-autocomplete-results"></ul>
	</fieldset>
{!! Form::close() !!}