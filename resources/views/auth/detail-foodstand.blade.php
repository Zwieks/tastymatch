<!-- {{$debugpath}} -->
@extends('layouts.master')

{{-- Page Title --}}
@section('title', 'Foodstand')

{{-- Name of body class --}}
@section('type','Foodstand')

{{-- Metadata content --}}
@section('description', 'Foodstand')

{{-- Include Content --}}
@section('content')
    @include('pages.foodstandpage.detail')
@stop

{{-- Include Scripts --}}
@section('page-scripts')
    @include('scripts.googlemaps-single-init')
    @include('scripts.detailpage')
    @include('scripts.datepicker.daterangepicker-init')
    @include('scripts.customscrollbar.customscrollbar-init')
    @include('scripts.autocomplete.autocomplete-agenda-init')
    @include('scripts.modal.modal-init')
@stop

{{-- Include Modal --}}
@section('modal')
	@include('modals.basic', ['content' => "modals.agenda.create"])
@stop