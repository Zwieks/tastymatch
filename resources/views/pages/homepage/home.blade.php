@extends('layouts.master')
@section('content')	
	@if (DB::connection()->getDatabaseName())

	   {{"Yes! successfully connected to the DB:"}}
	   {{DB::connection()->getDatabaseName()}}
	@endif

	@foreach ($users as $user)
	    <p>This is user {{ $user->name }}</p>
	@endforeach
@stop