<!-- {{$debugpath}} -->
@extends('layouts.master')

{{-- Page Title --}}
@section('title', Lang::get('errors.foodstand-title'))

{{-- Name of body class --}}
@section('type','Error page')

{{-- Metadata content --}}
@section('description', 'Page not found')

{{-- Include Content --}}
@section('content')
	@include('errors.foodstandnotfound')
@stop	