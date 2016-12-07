<!-- {{$debugpath}} -->
@extends('layouts.master')

{{-- Page Title --}}
@section('title', 'Foodstand')

{{-- Name of body class --}}
@section('type','Foodstand')

{{-- Metadata content --}}
@section('description', 'Foodstand')

{{-- Metadata heroimage --}}
{{--@section('heroimagetitle', Lang::get('hero.page-blog-title'))--}}
{{--@section('heroimagetext', Lang::get('hero.page-blog-text'))--}}
{{--@section('heroimage')--}}
    {{--@include('heroimage.blog')--}}
{{--@stop--}}


{{-- Include Content --}}
@section('content')
    @include('pages.foodstandpage.view')
@stop

{{-- Include Scripts --}}
@section('page-scripts')
    @include('scripts.tinymce-init')
@stop