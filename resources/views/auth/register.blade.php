<!-- {{$debugpath}} -->
@extends('layouts.master')
@section('title', 'Hallo')
@section('type','registration ')
@section('description', 'test')

@section('menu-item-name', 'home')

@section('heroimage')
    @include('heroimage.registration')
@stop

@section('content')
    @include('pages.registrationpage.view')
@stop

@section('right')
    @include('sidebars.right.registration')
@stop

@section('script')

@stop