<!-- {{$debugpath}} -->
@extends('layouts.master')

{{-- Page Title --}}
@section('title', 'Blog')

{{-- Name of body class --}}
@section('type','blog ')

{{-- Metadata content --}}
@section('description', 'blog')

{{-- Metadata heroimage --}}
@section('heroimagetitle', Lang::get('hero.page-blog-title'))
@section('heroimagetext', Lang::get('hero.page-blog-text'))
@section('heroimage')
    @include('heroimage.blog')
@stop


{{-- Include Content --}}
@section('content')
    @include('pages.blogpage.view')
@stop

{{-- Include Right Sidebar --}}
@section('right')
    @include('sidebars.right.blog')
@stop

{{-- Include Scripts --}}
@section('script')

@stop