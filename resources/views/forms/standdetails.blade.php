<!-- {{$debugpath}} -->
{!! Form::open(['method' => 'post', 'class' => 'detailpage detailpage-additionaldetails changed']) !!}
    <fieldset>
        <ul class="velden">
            <!-- VOORZIENINGEN -->
            <li class="form-label">
                <span>{{ Lang::get('forms.facilities-label') }}:</span>
            </li>
            <div class="multiple-wrapper">
                <li class="form-input-checkbox">
                    <input class="checkbox checkboxfilter" type="checkbox" value="{{ Lang::get('forms.facilities-gas') }}" name="filter_facility-gas" id="filter-1" {{ isset($page_content['getEvent']->facility_gas) && $page_content['getEvent']->facility_gas == Lang::get('forms.facilities-gas') ? 'checked' : ''}}>
                    <label for="filter-1">{{ Lang::get('forms.facilities-gas') }}</label>
                </li>

                <li class="form-input-checkbox">
                    <input class="checkbox checkboxfilter" type="checkbox" value="{{ Lang::get('forms.facilities-water') }}" name="filter_facility-water" id="filter-2" {{ isset($page_content['getEvent']->facility_water) && $page_content['getEvent']->facility_water == Lang::get('forms.facilities-water') ? 'checked' : ''}}>
                    <label for="filter-2">{{ Lang::get('forms.facilities-water') }}</label>
                </li>

                <li class="form-input-checkbox">
                    <input class="checkbox checkboxfilter" type="checkbox" value="{{ Lang::get('forms.facilities-electricity') }}" name="filter_facility-electricity" id="filter-3" {{ isset($page_content['getEvent']->facility_electricity) && $page_content['getEvent']->facility_electricity == Lang::get('forms.facilities-electricity') ? 'checked' : ''}}>
                    <label for="filter-3">{{ Lang::get('forms.facilities-electricity') }}</label>
                </li>
            </div>

            <!-- OPBOUWEN -->
            <li class="form-label">
                <span>{{ Lang::get('forms.construct-label') }}:</span>
            </li>

            <div class="multiple-wrapper">
                <li class="form-input-textfield">
                    {!! Form::text('construct_datestart',
                    isset($page_content['getEvent']->construct_datestart) ? Carbon\Carbon::parse($page_content['getEvent']->construct_datestart)->format('H:i:s') : '',
                    array_merge(['data-dtp' => 'true', 'class' => 'smallbox', 'id' => 'date-start', 'data-update' => 'false', 'placeholder' => 'mm:hh'])) !!}
                </li>
                <li>
                    <span class="form-separator">{{ Lang::get('forms.form-separator-to') }}</span>
                </li>
                <li class="form-input-textfield">
                    @include('forms.inputerror')
                    {!! Form::text('construct_dateend',
                    isset($page_content['getEvent']->construct_dateend) ? Carbon\Carbon::parse($page_content['getEvent']->construct_dateend)->format('H:i:s') : '',
                    array_merge(['data-dtp' => 'true', 'class' => 'smallbox', 'id' => 'date-end', 'data-update' => 'false', 'placeholder' => 'mm:hh'])) !!}
                </li>
                <li>
                    <span class="form-separator form-indication">{{ Lang::get('forms.form-indication-hours') }}</span>
                </li>
            </div>

            <!-- AFBOUWEN -->
            <li class="form-label">
                <span>{{ Lang::get('forms.removing-label') }}:</span>
            </li>

            <div class="multiple-wrapper">
                <li class="form-input-textfield">
                    {!! Form::text('deconstruct_datestart',
                    isset($page_content['getEvent']->deconstruct_datestart) ? Carbon\Carbon::parse($page_content['getEvent']->deconstruct_datestart)->format('H:i:s') : '',
                    array_merge(['data-dtp' => 'true', 'class' => 'smallbox', 'id' => 'date-start', 'data-update' => 'false', 'placeholder' => 'mm:hh'])) !!}

                </li>
                <li>
                    <span class="form-separator">{{ Lang::get('forms.form-separator-to') }}</span>
                </li>
                <li class="form-input-textfield">
                    @include('forms.inputerror')
                    {!! Form::text('deconstruct_dateend',
                    isset($page_content['getEvent']->deconstruct_dateend) ? Carbon\Carbon::parse($page_content['getEvent']->deconstruct_dateend)->format('H:i:s') : '',
                    array_merge(['data-dtp' => 'true', 'class' => 'smallbox', 'id' => 'date-end', 'data-update' => 'false', 'placeholder' => 'mm:hh'])) !!}
                </li>
                <li>
                    <span class="form-separator form-indication">{{ Lang::get('forms.form-indication-hours') }}</span>
                </li>
            </div>

            <li class="form-label">
                <span>{{ Lang::get('forms.form-indication-lease') }}:</span>
            </li>
            <div class="multiple-wrapper">
                <li>
                    <span class="form-separator form-indication">&euro;</span>
                </li>
                <li class="form-input-textfield">
                    @include('forms.inputerror')
                    {!! Form::number('amountstart',
                    isset($page_content['getEvent']->amountstart) ? $page_content['getEvent']->amountstart : '',
                    array_merge(['class' => 'smallbox', 'id' => 'amount-start', 'placeholder' => Lang::get('forms.value-label')])) !!}
                </li>
                <li>
                    <span class="form-separator">{{ Lang::get('forms.form-separator-to') }}</span>
                </li>
                <li>
                    <span class="form-separator form-indication">&euro;</span>
                </li>
                <li class="form-input-textfield">
                    @include('forms.inputerror')
                    {!! Form::number('amountend',
                    isset($page_content['getEvent']->amountend) ? $page_content['getEvent']->amountend : '',
                    array_merge(['class' => 'smallbox', 'id' => 'amount-end', 'placeholder' => Lang::get('forms.value-label')])) !!}
                </li>
            </div>    
        </ul>
    </fieldset>
{!! Form::close() !!}