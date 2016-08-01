<!-- [{{$debugpath}}] -->
@extends('layouts.master')
@section('title', Lang::get('loginpage.title'))
@section('description', Lang::get('loginpage.description'))
@section('menu-item-name', 'inloggen')
@section('content') 
<form class="formlogin" role="form" method="POST" action="{{ url('/password/reset') }}">
    <fieldset>
        <ul class="velden">
            {{ csrf_field() }}

            <input type="hidden" name="token" value="{{ $token }}">

            <li class="{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="animating-label">{{ Lang::get('forms.email') }}</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}">

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
            </li>

            <div class="buttons">
                <button type="submit" class="btn">{{ Lang::get('forms.resetpassword') }}/button>
            </div>
        </ul>
    </fieldset>        
</form>

@stop

@section('script')

@stop  
