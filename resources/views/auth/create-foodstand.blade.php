<!-- {{$debugpath}} -->
@extends('layouts.master')

{{-- Page Title --}}
@section('title', 'Foodstand')

{{-- Name of body class --}}
@section('type','Foodstand')

{{-- Metadata content --}}
@section('description', 'Foodstand')

{{-- Include Content --}}
@section('content')
    @include('pages.foodstandpage.view')
@stop

{{-- Include Scripts --}}
@section('page-scripts')
    @include('scripts.tinymce-init')
    @include('scripts.dropzone-init')
    @include('scripts.googlemaps-single-init')
    @include('scripts.detailpage')
@stop

{{-- Include Controls --}}
@section('sticky-content')
    @include('sidebars.sticky.templatecontrols')
@stop