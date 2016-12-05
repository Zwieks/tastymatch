<!-- {{$debugpath}} -->
@extends('layouts.master')

{{-- Page Title --}}
@section('title', 'Welkom')

{{-- Name of body class --}}
@section('type','home ')

{{-- Metadata content --}}
@section('description', 'Homepage')

{{-- Include Content --}}
@section('content')
    @include('pages.homepage.view')
@stop

{{-- Include Scripts --}}
@section('page-scripts')
    @include('scripts.googlemaps-init')
    @include('scripts.owlslider-init')
@stop