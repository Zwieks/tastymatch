<!-- {{$debugpath}} -->

{!! Form::open(['method' => 'get', 'class' => 'modal-form modal-create-agenda-items', 'id' => 'js-modal-create-agenda-items']) !!}
    <fieldset>
        <ul class="velden">
            <li class="form-input-textfield">
                @include('forms.inputerror')
                <label for="event-name">{{ Lang::get('forms.searchevent') }}<em>*</em></label>
                {!! Form::text('filter_keywords','',array_merge(['placeholder' => Lang::get('forms.placeholder-title'),'id' => 'js-filter-input', 'name' => 'searchevents','autocomplete' => 'off', 'eventid' => '', 'searchable' => '', 'new' => 'true'])) !!}
                <ul class="autocomplete mCustomScrollbar" id="js-autocomplete-results"></ul>
            </li>

            <li class="form-input-select">
                @include('forms.inputerror')
                <label for="event-type" class="multiple-title">{{ Lang::get('forms.eventtype') }}</label>
                <div class="style-select">
                    <select name="eventtype" id="event-type">
                        @foreach (Lang::get('eventtypes') as $key => $type)
                            @if (old('type') === $loop->index)
                                <option value="{{ $loop->index }}" selected>{{ $type }}</option>
                            @else
                                <option value="{{ $loop->index }}"> {{ $type }} </option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </li>

            <li class="form-input-textfield">
                @include('forms.inputerror')
                <label for="event-description">{{ Lang::get('forms.description') }}</label>
                {!! Form::textarea('description','',array_merge(['id' => 'event-description'])) !!}
            </li>

            <li class="form-input-textfield">
                @include('forms.inputerror')
                <label for="event-location">{{ Lang::get('forms.location') }}<em>*</em></label>
                {!! Form::text('location','',array_merge(['id' => 'event-location'])) !!}
            </li>

            <div class="multiple-wrapper">
                <li class="form-input-textfield">
                    @include('forms.inputerror')
                    <label for="date-start">{{ Lang::get('forms.datestart') }}<em>*</em></label>
                    {!! Form::text('datestart','',array_merge(['dp' => 'true', 'id' => 'date-start'])) !!}
                </li>
                <li>
                    <span class="form-separator">{{ Lang::get('forms.form-separator-to') }}</span>
                </li>
                <li class="form-input-textfield">
                    @include('forms.inputerror')
                    <label for="date-end">{{ Lang::get('forms.dateend') }}</label>
                    {!! Form::text('dateend','',array_merge(['dp' => 'true','id' => 'date-end'])) !!}
                </li>
            </div>
        </ul>
    </fieldset>
{!! Form::close() !!}