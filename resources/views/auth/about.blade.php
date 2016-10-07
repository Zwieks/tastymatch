<!-- {{$debugpath}} -->
@extends('layouts.master')

{{-- Page Title --}}
@section('title', Lang::get('aboutpage.title'))

{{-- Name of body class --}}
@section('type','about ')

{{-- Metadata content --}}
@section('description', Lang::get('aboutpage.description'))

{{-- Hero image content --}}
@section('heroimagetitle', Lang::get('hero.page-about-title'))
@section('heroimagetext', Lang::get('hero.page-about-text'))

{{-- Include Hero Image --}}
@section('heroimage')
    @include('heroimage.about')
@stop

{{-- Include Content --}}
@section('content')
    @include('pages.aboutpage.view')
@stop

{{-- Include Scripts --}}
@section('script')

@stop