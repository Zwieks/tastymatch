<!-- {{$debugpath}} -->
@extends('layouts.master')

{{-- Page Title --}}
@section('title', 'Welkom')

{{-- Name of body class --}}
@section('type','home ')

{{-- Metadata content --}}
@section('description', 'Homepage')

{{-- Metadata heroimage --}}
{{--@section('heroimagesearch', Lang::get('hero.page-home-search'))--}}

{{--@section('heroimage')--}}
    {{--@include('heroimage.loggedin')--}}
{{--@stop--}}

{{-- Include Left Sidebar --}}
@section('left')
    @include('sidebars.left.homelogin')
@stop

{{-- Include Content --}}
@section('content')
    @include('pages.homepage.view')
@stop

{{-- Include Right Sidebar --}}
@section('right')
    @include('sidebars.right.homelogin')
@stop

{{-- Include Scripts --}}
@section('script')

@stop