<!-- {{$debugpath}} -->
@extends('layouts.master')

{{-- Page Title --}}
@section('title', 'Contact')

{{-- Name of body class --}}
@section('type','contact ')

{{-- Metadata content --}}
@section('description', 'contact')

{{-- Metadata heroimage --}}
@section('heroimage')
    @include('heroimage.contact')
@stop

{{-- Include Content --}}
@section('content')
    @include('pages.contactpage.view')
@stop

{{-- Include Scripts --}}
@section('script')

@stop