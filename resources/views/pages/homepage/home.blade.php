@extends('layouts.master')
@section('title', Lang::get('basicpage.title'))
@section('description', Lang::get('basicpage.description'))

@section('menu-item-name', 'home')
@section('content')	

@if(Auth::check())
	@include('pages.homepage.entertainer-home')
@else
	<p>NOT loggedin</p>
@endif

@stop

@section('script')

@stop
