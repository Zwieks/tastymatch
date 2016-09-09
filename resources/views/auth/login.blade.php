<!-- {{$debugpath}} -->
@extends('layouts.master')
@section('type', 'login')
@section('title', Lang::get('loginpage.title'))
@section('description', Lang::get('loginpage.description'))

@section('menu-item-name', 'inloggen')

@section('content')
    @include('pages.loginpage.view')
@stop

@section('script')

@stop    