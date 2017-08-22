@if(isset($page_content['getHeaderimage']['uploadtype']) && $page_content['getHeaderimage']['uploadtype'] == 'preview')
	@php($path = URL::asset('storage/app/public/uploads/temp/'.$userid.'/'.$page_content['getHeaderimage']['name']))
@else
	@php($path = URL::asset('storage/app/public/'.$page_content->getHeaderimage['path']))
@endif

@extends('heroimage.basic', ['path' => $path, 'alt'=> 'test'])