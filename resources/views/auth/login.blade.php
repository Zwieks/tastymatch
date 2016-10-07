<!-- {{$debugpath}} -->
@extends('layouts.master')
@section('type', 'login')

{{-- Page Title --}}
@section('title', Lang::get('loginpage.title'))

{{-- Name of body class --}}
@section('type','login ')

{{-- Metadata content --}}
@section('description', Lang::get('loginpage.description'))

{{-- Include Content --}}
@section('content')
    @include('pages.loginpage.view')
@stop

{{-- Include Scripts --}}
@section('script')

@stop    