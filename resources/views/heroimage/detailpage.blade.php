@php($path = URL::asset('storage/app/public/'.$page_content->getHeaderimage['path']))

@extends('heroimage.basic', ['path' => $path, 'alt'=> 'test'])