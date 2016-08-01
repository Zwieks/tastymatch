<!-- [{{$debugpath}}] -->
@extends('layouts.master')
@section('title', 'Hallo')
@section('description', 'test')

@section('menu-item-name', 'home')
@section('content') 

<form class="formlogin" role="form" method="POST" action="{{ url('/register') }}">
    <fieldset>
        <ul class="velden">
            {{ csrf_field() }}

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
                <label class="multiple-title">Geslacht</label>
                <ul class="multiple-wrapper">
                    <li class="form-input-radio">
                        <input class="radio" type="radio" value="female" name="gender" id="genderfemale">
                        <label for="genderfemale">Vrouw</label>
                    </li>
                    
                    <li class="form-input-radio">
                        <input class="radio" type="radio" value="male" name="gender" id="gendermale">
                        <label for="gendermale">Man</label>
                    </li>
                </ul>                       
            </li>

            <li class="form-input-date">    
                <label class="animating-label">Geboortedatum</label>
                <div id="PersonForm_date_of_birth">
                    <div class="style-select">
                        {{ Form::selectRange('day', 1, 31, null, ['placeholder' => Lang::get('forms.day')]) }}   
                    </div>

                    <div class="style-select">
                        <select name="month">
                            <?php $i = 0; ?>
                            @foreach (Lang::get('months') as $key=>$month)
                                <option value="{{ $i++ }}"> {{ $month }} </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="style-select">
                       {{ Form::selectRange('year', 1906, Carbon::now()->subYears(18)->year, null, ['placeholder' => Lang::get('forms.year')]) }}
                    </div>
                </div>
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

                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
            </li class="{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">

            <li>
                <label for="js-kvkapi" class="animating-label">{{ Lang::get('forms.businessdetails') }}</label>

                <input id="js-kvkapi" type="text" class="form-control" name="business_details">

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

            <li class="{{ $errors->has('confirm') ? ' has-error' : '' }}">
                <ul class="multiple-wrapper">
                    <li class="form-input-checkbox">
                        <input class="checkbox" type="checkbox" value="confirm" name="confirm" id="confirmation">
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

@stop

@section('script')

@stop  