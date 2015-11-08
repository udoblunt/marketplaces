<!-- Stored in resources/views/public/home.blade.php -->

@extends('layouts.public_master')
	
@section('title', $title)

@section('marketplaces')
    @parent

	    @foreach ($markets as $market)
			<a class="pull-left" href="{{ url('/', [$market->name]) }}">{{ $market->name }}</a>
		@endforeach
@endsection

@section('sidebar')
    @parent
    
@endsection

@section('content')
	<div class="marketsContainer">
		@foreach ($markets as $market)
			<div class="market">
				<h1><a class="pull-left" href="{{ url('/', [$market->name]) }}">{{ $market->name }}</a></h1>
				<p>{{ $market->description }}</p>
				<p><a class="pull-left" href="#">top item 1</a></p>
				<p><a class="pull-left" href="#">top item 2</a></p>
				<p><a class="pull-left" href="#">top item 3</a></p>
			</div>
		@endforeach
	</div>
@endsection
