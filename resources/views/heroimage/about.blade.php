@php($path = URL::asset('img/backgrounds/mainbg.png'))

@extends('heroimage.basic', ['path' => $path, 'alt'=> 'test'])

@section('heroalinea')
   @include('heroimage.herotext')
@stop