<!-- Stored in resources/views/environment/market.blade.php -->

@extends('layouts.environment_master')
	
@section('title', $title)

@section('content')
	<div class="marketsContainer">
		<h1>{{ $detailMarket->name }}</h1>
		<a class="subscribe" href="{{ url('/ctrl/m/subscription', [$detailMarket->name])}}">{{ ($userSubscription != null) ? "Unsubscribe" : "Subscribe" }}</a>
		@foreach ($items as $item)
			<div class="item">
				<h5>{{ $item->views }}</h5>
				<h3><a href="{{ url('/m', [$detailMarket->name, $item->name]) }}">{{ $item->name }}</a></h3>
				<p>{{ $item->price }} euro</p>
				<p>{{ $item->description }}</p>
				<p><small>Created by <a href="#">{{ $users[$item->id]->firstname }}</a></small></p>
			</div>
		@endforeach
	</div>
@endsection
