<!-- Stored in resources/views/public/home.blade.php -->

@extends('layouts.public_master')

@section('title', $title)

@section('sidebar')
    @parent
    
@endsection

@section('content')
	@foreach ($items as $item)
		{{ $item->price }}
	@endforeach
@endsection
