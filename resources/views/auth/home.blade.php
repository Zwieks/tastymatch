<!-- {{$debugpath}} -->
@extends('layouts.master')

{{-- Page Title --}}
@section('title', 'Homepage')

{{-- Name of body class --}}
@section('type','home ')

{{-- Metadata content --}}
@section('description', 'Homepage')

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
    @include('pages.homepage.view')
@stop

{{-- Include Scripts --}}
@section('script')

@stop