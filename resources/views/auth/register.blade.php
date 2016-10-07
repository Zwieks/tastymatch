<!-- {{$debugpath}} -->
@extends('layouts.master')

{{-- Page Title --}}
@section('title', 'Hallo')

{{-- Name of body class --}}
@section('type','registration ')

{{-- Metadata content --}}
@section('description', 'test')

{{-- Metadata content --}}
@section('heroimage')
    @include('heroimage.registration')
@stop

{{-- Include Content --}}
@section('content')
    @include('pages.registrationpage.view')
@stop

{{-- Include Right Sidebar --}}
@section('right')
    @include('sidebars.right.registration')
@stop

{{-- Include Scripts --}}
@section('script')

@stop