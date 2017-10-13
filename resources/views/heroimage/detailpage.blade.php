@if(!isset($page_content['getHeaderimage']))
	@php($path = URL::asset('img/backgrounds/mainbg.png'))
@elseif(isset($page_content['getHeaderimage']['uploadtype']) && $page_content['getHeaderimage']['uploadtype'] == 'preview')
	@php($path = URL::asset('storage/app/public/'.$page_content['getHeaderimage']['path']))
@else
	@php($path = URL::asset('storage/app/public/'.$page_content->getHeaderimage['path']))
@endif

@extends('heroimage.basic', ['path' => $path, 'alt'=> 'test'])