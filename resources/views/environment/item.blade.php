<!-- Stored in resources/views/environment/market.blade.php -->

@extends('layouts.environment_master')
	
@section('title', $title)

@section('content')
	<h1>{{ $marketName }}</h1>
	<div class="marketsContainer">
		<div class="market">
			<h5>{{ $item->views }}</h5>
			<h3>{{ $item->name }}</h3>
			<p>{{ $item->price }} euro</p>
			<p>{{ $item->description }}</p>
			<p><small>Created by <a href="#">{{ $user->firstname }}</a></small></p>
		</div>
	</div>
@endsection
