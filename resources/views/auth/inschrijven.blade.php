<!-- [{{$debugpath}}] -->
@extends('layouts.master')
@section('title', Lang::get('loginpage.title'))
@section('description', Lang::get('loginpage.description'))
@section('menu-item-name', 'inloggen')
@section('content') 
    <section class="compblock">
        <h2>{{ Lang::get('loginpage.comp-title-createaccount') }}</h2>
        <p>{{ Lang::get('loginpage.comp-intro-createaccount') }}</p>
        <a href="{{ Lang::get('menus.register-url') }}" class="btn">{{ Lang::get('buttons.register') }}</a>
    </section>    

    <div class="compblock comp-login">
        <h2 class="login-title">{{ Lang::get('loginpage.titlemainnav') }}</h2>
        <div class="social-login">
            <h3>{{ Lang::get('loginpage.facebook-login-title') }}</h3>
            <a href="{{ Lang::get('menus.facebook-url') }}" class="facebook-btn">{{ Lang::get('menus.facebook') }}</a>
        </div>

        <form class="formlogin" role="form" method="POST" action="{{ url('/login') }}">
            <fieldset>
                <ul class="velden">
                    {{ csrf_field() }}

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

                    <li class="form-input-checkbox">
                        <div class="checkbox">
                            <input id="remembercheckbox" type="checkbox" name="remember"> 
                            <label for="remembercheckbox">
                                {{ Lang::get('forms.rememberme') }}
                            </label>
                        </div>
                    </li>
                </ul>    

                <div class="buttons">
                    <button type="submit" class="btn">{{ Lang::get('forms.login') }}</button>
                </div>
            </fieldset>    
        </form>
    </div>  

    <div class="compblock comp-resetpw">
        <h2 class="resetpw-title">{{ Lang::get('loginpage.comp-title-resetpw') }}</h2>
        <p>{{ Lang::get('loginpage.comp-intro-resetpw') }}</p>
        <a href="{{ url('/password/reset') }}">{{ Lang::get('forms.forgotpw') }}</a>
    </div>  
@stop

@section('script')

@stop    