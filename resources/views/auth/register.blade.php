<!-- {{$debugpath}} -->
@extends('layouts.master')
@section('title', 'Hallo')
@section('type','registration')
@section('description', 'test')

@section('menu-item-name', 'home')

@section('content')
    <div class="page-middle">
        @include('pages.basicpage.page-meta')
        <h1 itemprop="name" class="seo-title">@yield('title')</h1>
        @include('forms.registration')
    </div>

    @include('right.registration')
@stop

@section('script')

@stop  