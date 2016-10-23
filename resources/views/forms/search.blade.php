<!-- {{$debugpath}} -->
test
<form name="general-search" class="formsearch webbeheer-formulier" role="form" method="POST" action="{{ url('/search') }}">
    <fieldset>
        <legend>{{ Lang::get('forms.legendsearch')  }}</legend>
        <ul class="velden">
            {{ csrf_field() }}

            <li class="form-input-heading">
                <h2>{{ Lang::get('forms.headersearch') }}</h2>
            </li>

            <li class="{{ $errors->has('search') ? ' has-error' : '' }}">
                <label for="search" class="animating-label">{{ Lang::get('forms.search') }}</label>

                <input id="search" type="text" class="form-control" name="search" value="{{ old('search') }}">

                @if ($errors->has('search'))
                    <span class="help-block">
                        <strong>{{ $errors->first('search') }}</strong>
                    </span>
                @endif
            </li>

            <div class="buttons">
                <button type="submit" class="btn">{{ Lang::get('buttons.search') }}</button>
            </div>
        </ul>    
    </fieldset> 
</form>