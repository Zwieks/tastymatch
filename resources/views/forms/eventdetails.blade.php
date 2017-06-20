<!-- {{$debugpath}} -->
{!! Form::open(['method' => 'post', 'class' => 'detailpage detailpage-additionaldetails changed']) !!}
    <fieldset>
        <ul class="velden">
            <!-- EVENT TYPE SELECT -->
            <li class="form-label">
                <span>{{ Lang::get('forms.eventtype') }}:</span>
            </li>
            <div class="multiple-wrapper">
                <li>
                    {{ Form::select('size', 
                        ['placeholder' => Lang::get('eventtypes.type'),
                                    '1' => Lang::get('eventtypes.dance'), 
                                    '2' => Lang::get('eventtypes.food'),
                                    '3' => Lang::get('eventtypes.sport'),
                                    '4' => Lang::get('eventtypes.wedding')]) }}
                </li>                    
            </div> 

            <!-- EVENT TYPE SELECT -->
            <li class="form-label">
                <span>{{ Lang::get('forms.eventdate') }}:</span>
            </li>
            <div class="multiple-wrapper">
                <li class="form-input-textfield">
                    @include('forms.inputerror')
                    {!! Form::text('eventdatestart','',array_merge(['placeholder' => Lang::get('forms.datestart'),'data-dp-event-from' => 'true', 'id' => 'date-start', 'data-update' => 'false', 'class' => 'smallbox date'])) !!}
                </li>
                <li>
                    <span class="form-separator">{{ Lang::get('forms.form-separator-to') }}</span>
                </li>
                <li class="form-input-textfield">
                    @include('forms.inputerror')
                    {!! Form::text('eventdateend','',array_merge(['placeholder' => Lang::get('forms.dateend'), 'data-dp-event-to' => 'true','id' => 'date-end', 'data-update' => 'false', 'class' => 'smallbox date'])) !!}
                </li>
            </div>

            <!-- EVENT LOCATION -->
            <li class="form-label">
                <span>{{ Lang::get('forms.location-maps') }}:</span>
            </li>

            <li class="form-input-textfield">
                {!! Form::text('eventlocation', '',['placeholder' => Lang::get('forms.location-placeholder'),'class' => 'smallbox text', 'id' => 'googlemaps-dropdown']) !!}
            </li>

            <!-- VISITORS COUNT -->
            <li class="form-label">
                <span>{{ Lang::get('forms.visitorscount-label') }}:</span>
            </li>
            <div class="multiple-wrapper">
                <li class="form-input-radio">
                    <input class="radio checkboxfilter" type="radio" value="1" name="filter_type" id="visitorsfilter-1">
                    <label for="visitorsfilter-1">{{ Lang::get('forms.visitorscount-small') }}</label>
                </li>

                <li class="form-input-radio">
                    <input class="radio checkboxfilter" type="radio" value="2" name="filter_type" id="visitorsfilter-2" checked>
                    <label for="visitorsfilter-2">{{ Lang::get('forms.visitorscount-medium') }}</label>
                </li>

                <li class="form-input-radio">
                    <input class="radio checkboxfilter" type="radio" value="3" name="filter_type" id="visitorsfilter-3">
                    <label for="visitorsfilter-3">{{ Lang::get('forms.visitorscount-big') }}</label>
                </li>
            </div>      
        </ul>
    </fieldset>
{!! Form::close() !!}