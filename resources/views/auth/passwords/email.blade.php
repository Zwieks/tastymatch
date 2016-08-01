<!-- [{{$debugpath}}] -->
@section('content')
@extends('layouts.master')
@section('title', Lang::get('registerpages.title'))
@section('description', Lang::get('registerpages.description'))
@section('menu-item-name', 'inloggen')
@section('content') 
    <section class="compblock">
        <h2>{{ Lang::get('registerpages.comp-title-resetpw') }}</h2>
        <p>{{ Lang::get('loginpage.comp-intro-resetpw') }}</p>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form class="formlogin" role="form" method="POST" action="{{ url('/password/email') }}">
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

                    <div class="buttons">
                        <button type="submit" class="btn">{{ Lang::get('forms.sendresetlink') }}</button>
                    </div>
                <ul>    
            </fieldset>        
        </form>
    </section>
@stop

@section('script')

@stop  
