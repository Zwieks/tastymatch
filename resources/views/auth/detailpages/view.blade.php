<!-- {{$debugpath}} -->
@extends('layouts.master')
{{-- Item specific detals --}}
@include('auth.detailpages.'.$item_type.'.details')

{{-- Include Content --}}
@section('content')
    @include('pages.detailpage.view',['detail' => "pages.detailpage.".$item_type.".viewdetail"]))
@stop

{{-- Include heroimage --}}
@section('heroimage')
    @include('heroimage.detailpage')
@stop

{{-- Include Scripts --}}
@section('page-scripts')
    @include('scripts.googlemaps-single-init')
    @include('scripts.detailpage')
    @include('scripts.datepicker.daterangepicker-init')
    @include('scripts.customscrollbar.customscrollbar-init')
    @include('scripts.modal.modal-show-media-init')
@stop

{{-- Include Modal --}}
@section('modal')
	@include('modals.basic', ['content' => "modals.agenda.daterangepicker", 'mediatype' => 'daterange','modaltype' => ''])
	@include('modals.basic', ['content' => "modals.media", 'mediatype' => 'media','modaltype' => ''])
@stop