<!-- {{$debugpath}} -->
@extends('layouts.master')
{{-- Item specific details --}}
@include('auth.detailpages.'.$item_type.'.details')

{{-- Include Content --}}
@section('content')
    @include('pages.detailpage.update',
        ['detail' => "pages.detailpage.".$item_type.".detail",
        'additionaldetail' => "pages.detailpage.".$item_type.".additionaldetail",
        'googlemaps' => "includes.googlemaps.".$item_type.".single-googlemap"])
@stop

{{-- Include Scripts --}}
@section('page-scripts')
    @include('scripts.customscrollbar.customscrollbar-init')
    @include('scripts.tinymce.tinymce-init')
    @include('scripts.dropzone.dropzone-init')
    @include('scripts.googlemaps-single-init')
    @include('scripts.detailpage')
    @include('scripts.datepicker.daterangepicker-init')
    @include('scripts.datepicker.datepicker-single-init')
    @include('scripts.datepicker.datetimepicker-single-init')
    @include('scripts.autocomplete.autocomplete-agenda-init')
    @include('scripts.modal.modal-update-item-init')
@stop

{{-- Include Controls --}}
@section('sticky-content')
    @include('sidebars.sticky.templatecontrols')
@stop

{{-- Include Modal --}}
@section('modal')
	@include('modals.basic', ['content' => "modals.agenda.create", 'mediatype' => 'form','modaltype' => ''])
    @include('modals.basic', ['content' => "modals.agenda.daterangepicker", 'mediatype' => 'daterange','modaltype' => ''])
    @include('modals.basic', ['content' => "modals.agenda.success", 'mediatype' => 'success','modaltype' => 'notification'])
    @include('modals.basic', ['content' => "modals.agenda.error", 'mediatype' => 'error','modaltype' => 'notification'])
@stop