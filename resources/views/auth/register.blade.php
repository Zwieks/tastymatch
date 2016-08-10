<!-- [{{$debugpath}}] -->
@extends('layouts.master')
@section('title', 'Hallo')
@section('description', 'test')

@section('menu-item-name', 'home')
@section('content')

    @include('forms.registration')

@stop

@section('script')

@stop  