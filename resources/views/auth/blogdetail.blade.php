<!-- {{$debugpath}} -->
@extends('layouts.master')

{{-- Page Title --}}
@section('title', 'Blog Detail')

{{-- Name of body class --}}
@section('type','blog Detail')

{{-- Metadata content --}}
@section('description', 'blog Detail')

{{-- Include Content --}}
@section('content')
    @include('pages.blogpage.blogdetailpage.view')
@stop

{{-- Include Scripts --}}
@section('script')

@stop