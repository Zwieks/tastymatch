<!-- {{$debugpath}} -->
<form method="get" id="js-googemap-filter" class="form-filter webbeheer-formulier" itemprop="potentialAction" itemscope itemtype="http://schema.org/SearchAction">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<fieldset>
		<ul class="velden">
            <!-- EVENT LOCATION -->
            <li class="form-label">
                <span>{{ Lang::get('forms.location-maps') }}:</span>
            </li>

            <li class="form-input-textfield">
                {!! Form::text('eventlocation', '',['placeholder' => Lang::get('forms.location-placeholder'),'class' => 'smallbox text', 'id' => 'googlemaps-dropdown']) !!}
                <span class="icon" data-icon="y"></span>
            </li>
		</ul>
		<ul class="autocomplete mCustomScrollbar" id="js-autocomplete-results"></ul>
	</fieldset>
</form>