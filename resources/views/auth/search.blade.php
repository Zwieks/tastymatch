<!-- {{$debugpath}} -->
@extends('layouts.master')

{{-- Page Title --}}
@section('title', 'Search')

{{-- Name of body class --}}
@section('type','search ')

{{-- Metadata content --}}
@section('description', 'Search')

{{-- Include Content --}}
@section('content')
    @include('pages.searchpage.view')
@stop

{{-- Include Scripts --}}
@section('page-scripts')
    @include('scripts.filtersearch')
@stop