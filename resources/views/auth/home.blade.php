<!-- {{$debugpath}} -->
@extends('layouts.master')

{{-- Page Title --}}
@section('title', 'Homepage')

{{-- Name of body class --}}
@section('type','home ')

{{-- Metadata content --}}
@section('description', 'Homepage')

{{-- Metadata heroimage --}}
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