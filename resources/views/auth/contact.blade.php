<!-- {{$debugpath}} -->
@extends('layouts.master')
@section('title', 'Contact')
@section('type','contact ')
@section('description', 'contact')

@section('menu-item-name', 'contact')

@section('heroimage')
    @include('heroimage.contact')
@stop

@section('content')
    @include('pages.contactpage.view')
@stop

@section('script')

@stop