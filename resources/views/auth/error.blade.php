<!-- {{$debugpath}} -->
@extends('layouts.master')

{{-- Page Title --}}
@section('title', 'Error')

{{-- Name of body class --}}
@section('type','error ')

{{-- Metadata content --}}
@section('description', 'Error')

{{-- Metadata heroimage --}}
@section('heroimagetitle', Lang::get('hero.page-home-title'))
@section('heroimagetext', Lang::get('hero.page-home-text'))
@section('heroimagebuttonregister', Lang::get('hero.page-home-button-register'))
@section('heroimagebuttonlogin', Lang::get('hero.page-home-button-login'))
@section('heroimage')
    @include('heroimage.home')
@stop

{{-- Include Content --}}
@section('content')
    @include('errors.503')
@stop

{{-- Include Scripts --}}
@section('script')

@stop