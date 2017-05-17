<!-- {{$debugpath}} -->
{!! Form::open(['method' => 'post', 'class' => 'detailpage detailpage-standdetails changed']) !!}
    <fieldset>
        <ul class="velden">
            <!-- VOORZIENINGEN -->
            <li class="form-label">
                <span>{{ Lang::get('forms.facilities-label') }}:</span>
            </li>
            <div class="multiple-wrapper">
                <li class="form-input-checkbox">
                    <input class="checkbox checkboxfilter" type="checkbox" value="foodstands" name="filter_type" id="filter-1" checked>
                    <label for="filter-1">{{ Lang::get('forms.facilities-gas') }}</label>
                </li>

                <li class="form-input-checkbox">
                    <input class="checkbox checkboxfilter" type="checkbox" value="foodstands" name="filter_type" id="filter-2" checked>
                    <label for="filter-2">{{ Lang::get('forms.facilities-water') }}</label>
                </li>

                <li class="form-input-checkbox">
                    <input class="checkbox checkboxfilter" type="checkbox" value="foodstands" name="filter_type" id="filter-3" checked>
                    <label for="filter-3">{{ Lang::get('forms.facilities-electricity') }}</label>
                </li>
            </div>

            <!-- OPBOUWEN -->
            <li class="form-label">
                <span>{{ Lang::get('forms.construct-label') }}:</span>
            </li>

            <div class="multiple-wrapper">
                <li class="form-input-textfield">
                    {!! Form::text('datestart','',array_merge(['data-dtp' => 'true', 'class' => 'smallbox', 'id' => 'date-start', 'data-update' => 'false', 'placeholder' => 'mm:hh'])) !!}

                </li>
                <li>
                    <span class="form-separator">{{ Lang::get('forms.form-separator-to') }}</span>
                </li>
                <li class="form-input-textfield">
                    @include('forms.inputerror')
                    {!! Form::text('dateend','',array_merge(['data-dtp' => 'true', 'class' => 'smallbox', 'id' => 'date-end', 'data-update' => 'false', 'placeholder' => 'mm:hh'])) !!}
                </li>
            </div>

            <!-- AFBOUWEN -->
            <li class="form-label">
                <span>{{ Lang::get('forms.removing-label') }}:</span>
            </li>

            <div class="multiple-wrapper">
                <li class="form-input-textfield">
                    {!! Form::text('datestart','',array_merge(['data-dtp' => 'true', 'class' => 'smallbox', 'id' => 'date-start', 'data-update' => 'false', 'placeholder' => 'mm:hh'])) !!}

                </li>
                <li>
                    <span class="form-separator">{{ Lang::get('forms.form-separator-to') }}</span>
                </li>
                <li class="form-input-textfield">
                    @include('forms.inputerror')
                    {!! Form::text('dateend','',array_merge(['data-dtp' => 'true', 'class' => 'smallbox', 'id' => 'date-end', 'data-update' => 'false', 'placeholder' => 'mm:hh'])) !!}
                </li>
            </div>
        </ul>
    </fieldset>
{!! Form::close() !!}