<!-- {{$debugpath}} -->
@extends('layouts.master')

{{-- Page Title --}}
@section('title', 'Blog')

{{-- Name of body class --}}
@section('type','blog ')

{{-- Metadata content --}}
@section('description', 'blog')

{{-- Include Content --}}
@section('content')
    @include('pages.blogpage.view')
@stop

{{-- Include Scripts --}}
@section('script')

@stop