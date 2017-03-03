@php($path = URL::asset('storage/'.$page_content->getHeaderimage['path']))

@extends('heroimage.basic', ['path' => $path, 'alt'=> 'test'])
