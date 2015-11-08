<!-- Stored in resources/views/public/home.blade.php -->

@extends('layouts.public_master')

@section('title', $title)

@section('sidebar')
    @parent
    
@endsection

@section('content')
	<div style="background: red;">
	@foreach ($markets as $market)
		{{ $market->name }}
	@endforeach
	</div>
@endsection
