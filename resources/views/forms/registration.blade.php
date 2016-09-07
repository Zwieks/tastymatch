<!-- {{$debugpath}} -->
<form name="general-registration" class="formlogin" role="form" method="POST" action="{{ url('/register') }}">
    <fieldset>
        <legend>{{ Lang::get('forms.legendregister')  }}</legend>
        <ul class="velden">
            {{ csrf_field() }}

            <li class="form-input-heading">
                <h2>{{ Lang::get('forms.headerregistrationtype') }}</h2>
            </li>

            <li class="{{ $errors->has('lastname') ? ' has-error' : '' }}">
                <label class="multiple-title">{{ Lang::get('forms.registertype') }}</label>
                <ul class="multiple-wrapper">
                    <li class="form-input-radio">
                        <input class="radio typechange" type="radio" value="consumer" name="type" id="typeconsumer" checked="checked" {{ old('type')=="consumer" ? 'checked='.'"'.'checked'.'"' : '' }}>
                        <label for="typeconsumer">{{ Lang::get('forms.consumer') }}</label>
                    </li>

                    <li class="form-input-radio">
                        <input class="radio typechange" type="radio" value="commercial" name="type" id="typecommercial" {{ old('type')=="commercial" ? 'checked='.'"'.'checked'.'"' : '' }}>
                        <label for="typecommercial">{{ Lang::get('forms.commercial') }}</label>
                    </li>
                </ul>
            </li>

            <li class="separator"></li>

            <li class="form-input-heading">
                <h2>{{ Lang::get('forms.headercontact') }}</h2>
            </li>

            <li class="{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="animating-label">{{ Lang::get('forms.firstname') }}</label>

                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">

                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </li>

            <li class="{{ $errors->has('lastname') ? ' has-error' : '' }}">
                <label for="lastname" class="animating-label">{{ Lang::get('forms.lastname') }}</label>

                <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}">

                @if ($errors->has('lastname'))
                    <span class="help-block">
                        <strong>{{ $errors->first('lastname') }}</strong>
                    </span>
                @endif
            </li>

            <li class="{{ $errors->has('lastname') ? ' has-error' : '' }}">
                <label class="multiple-title">{{ Lang::get('forms.gender') }}</label>
                <ul class="multiple-wrapper">
                    <li class="form-input-radio">
                        <input class="radio" type="radio" value="female" name="gender" id="genderfemale" {{ old('gender')=="female" ? 'checked='.'"'.'checked'.'"' : '' }}>
                        <label for="genderfemale">{{ Lang::get('forms.genderfemale') }}</label>
                    </li>

                    <li class="form-input-radio">
                        <input class="radio" type="radio" value="male" name="gender" id="gendermale" {{ old('gender')=="male" ? 'checked='.'"'.'checked'.'"' : '' }}>
                        <label for="gendermale">{{ Lang::get('forms.gendermale') }}</label>
                    </li>
                </ul>
            </li>

            <li class="form-input-date">
                <label class="animating-label">{{ Lang::get('forms.birthday') }}</label>
                <div id="PersonForm_date_of_birth">
                    <div class="style-select">
                        {{ Form::selectRange('day', 1, 31, null, ['placeholder' => Lang::get('forms.day')]) }}
                    </div>

                    <div class="style-select">
                        <select name="month">
                            <?php $i = 0; ?>
                            @foreach (Lang::get('months') as $key=>$month)
                                @if (old('month') === (string)$i)
                                    <option value="{{ $i++ }}" selected>{{ $month }}</option>
                                @else
                                    <option value="{{ $i++ }}"> {{ $month }} </option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="style-select">
                        {{ Form::selectRange('year', 1906, Carbon::now()->subYears(18)->year, null, ['placeholder' => Lang::get('forms.year')]) }}
                    </div>
                </div>
            </li>

            <li class="separator"></li>

            <li class="form-input-heading">
                <h2>{{ Lang::get('forms.headerlogin') }}</h2>
            </li>

            <li class="{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="animating-label">{{ Lang::get('forms.email') }}</label>

                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </li>

            <li class="{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="animating-label">{{ Lang::get('forms.password') }}</label>

                <input id="password" type="password" class="form-control" name="password">

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </li>

            <li class="{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <label for="password-confirm" class="animating-label">{{ Lang::get('forms.confirmpassword') }}</label>

                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >

                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
            </li>

            <li id="js-typechange">
                <ul class="velden">
                    <li class="separator"></li>

                    <li class="form-input-heading">
                        <h2>{{ Lang::get('forms.commercialdetails') }}</h2>
                    </li>

                    <li>
                        <label for="js-kvkapi" class="animating-label">{{ Lang::get('forms.businessdetails') }}</label>

                        <input id="js-kvkapi" type="text" class="form-control" name="business_details" value="{{ old('business_details') }}">

                        @if ($errors->has('business'))
                            <span class="help-block">
                                <strong>{{ $errors->first('business') }}</strong>
                            </span>
                        @endif
                    </li>

                    <li>
                        <label class="animating-label">{{ Lang::get('forms.businessdetailsinfo') }}</label>

                        <div id="js-kvkinfo-wrapper" class="kvkwrapper">
                            <p class='description-text'>{{ Lang::get('forms.kvknoinfo') }}</p>
                        </div>

                        <span class="help-block api-error">
                            <strong>{{ Lang::get('forms.apierrorkvk') }}</strong>
                        </span>
                    </li>
                </ul>
            </li>

            <li class="separator"></li>

            <li class="{{ $errors->has('confirm') ? ' has-error' : '' }}">
                <ul class="multiple-wrapper">
                    <li class="form-input-checkbox">
                        <input class="checkbox" type="checkbox" value="{{ old('confirm') }}" name="confirm" id="confirmation">
                        <label for="confirmation">{{ Lang::get('forms.confirmation') }} <a href="{{ Lang::get('menus.provision-url') }}">{{ Lang::get('menus.provision') }}</a></label>
                    </li>
                </ul>
                @if ($errors->has('confirm'))
                    <span class="help-block">
                        <strong>{{ $errors->first('confirm') }}</strong>
                    </span>
                @endif
            </li>

            <div class="buttons">
                <button type="submit" class="btn">{{ Lang::get('buttons.register') }}</button>
            </div>
        </ul>
    </fieldset>
</form>