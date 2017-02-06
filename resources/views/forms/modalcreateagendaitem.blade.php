<!-- {{$debugpath}} -->

{!! Form::open(['method' => 'get', 'class' => 'modal-form modal-create-agenda-items']) !!}
    <fieldset>
        <ul class="velden">
            <li class="form-input-textfield">
                @include('forms.inputerror')
                <label for="event-name">{{ Lang::get('forms.searchevent') }}<em>*</em></label>
                {!! Form::text('filter_keywords','',array_merge(['id' => 'js-filter-input', 'name' => 'search-events','autocomplete' => 'off'])) !!}
                <ul class="autocomplete mCustomScrollbar" id="js-autocomplete-results"></ul>
            </li>

            <div class="multiple-wrapper">
                <li class="form-input-textfield">
                    @include('forms.inputerror')
                    <label for="date-start">{{ Lang::get('forms.datestart') }}<em>*</em></label>
                    {!! Form::text('date-start','',array_merge(['dp' => 'true', 'id' => 'date-start'])) !!}
                </li>

                <li class="form-input-textfield">
                    @include('forms.inputerror')
                    <label for="date-end8">{{ Lang::get('forms.dateend') }}<em>*</em></label>
                    {!! Form::text('date-end','',array_merge(['dp' => 'true','id' => 'date-end'])) !!}
                </li>
            </div>
        </ul>
    </fieldset>
{!! Form::close() !!}