<!-- Stored in resources/views/environment/market.blade.php -->

@extends('layouts.environment_master')
	
@section('title', $title)

@section('marketplaces')
    @parent

	    @foreach ($markets as $market)
			<a class="pull-left" href="{{ url('/m', [$market->name]) }}">{{ $market->name }}</a>
		@endforeach
@endsection

@section('sidebar')
    @parent
    
@endsection

@section('content')
	<h1>{{ $detailMarket->name }}</h1>
	<div class="marketsContainer">
		@foreach ($items as $item)
			<div class="market">
				<h5>{{ $item->views }}</h5>
				<h3><a href="{{ url('/m', [$detailMarket->name, $item->name]) }}">{{ $item->name }}</a></h3>
				<p>{{ $item->price }} euro</p>
				<p>{{ $item->description }}</p>
				<p><small>Created by <a href="#">{{ $users[$item->id]->firstname }}</a></small></p>
			</div>
		@endforeach
	</div>
@endsection
