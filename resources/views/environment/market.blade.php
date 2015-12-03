<!-- Stored in resources/views/environment/market.blade.php -->

@extends('layouts.environment_master')
	
@section('title', $title)

@section('content')
	<div class="itemsContainer">
		<h1>{{ $detailMarket->name }}</h1>
		@foreach ($items as $item)
			<div class="item">
				<div class="head">
					<h3><a href="{{ url('/m', [$detailMarket->name, $item->name]) }}">{{ $item->name }}</a></h3>
					<h5><small>Created by <a href="#">{{ $users[$item->id]->first_name }}</a></small></h5>
					<h5>aantal keer bekeken: {{ $item->views }}</h5>
					<h5>{{ $item->price }} euro</h5>
				</div>
				<div class="description">
					<p>{{ $item->description }}</p>
				</div>
			</div>
		@endforeach
	</div>
	<div class="generalInfoContainer">
		<h4>{{ $detailMarket->name }}</h4>
		<h5>Description</h5>
		<p>{{ $detailMarket->description }}</p>
		<h5>Subscribers: {{ count($detailMarket->subscribers) }}</h5>
		<a href="{{ url('/ctrl/m/subscription', [$detailMarket->name])}}">{{ ($userSubscription != null) ? "Unsubscribe" : "Subscribe" }}</a>
		<div class="upvoteContainer">
			<div class="upvote">
				<a class="up" href="{{ url('/ctrl/m/vote', [$detailMarket->name, 'up'])}}">Up</a>
				<h5>{{ $detailMarket->upvote }}</h5>
				<a class="down" href="{{ url('/ctrl/m/vote', [$detailMarket->name, 'down'])}}">Down</a>
			</div>
		</div>
	</div>
@endsection
