@extends('heroimage.basic')

@section('heroimagepath')
   {{--*/ $path = URL::asset('img/backgrounds/mainbg.png') /*--}}
@stop

@section('heroalinea')
   @include('heroimage.herotext')
@stop