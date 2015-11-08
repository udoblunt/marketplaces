<!-- Stored in resources/views/environment/home.blade.php -->

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
	<div class="marketsContainer">
		@foreach ($markets as $market)
			<div class="market">
				<h5>{{ $market->upvote }}</h5>
				<h1><a class="pull-left" href="{{ url('/m', [$market->name]) }}">{{ $market->name }}</a></h1>
				<p>{{ $market->description }}</p>
				@foreach ($items[$market->id] as $item)
					<p><a href="{{ url('/m', [$market->name, $item->name]) }}">{{ $item->name }}</a></p>
					<p>{{ $item->price }} euro</p>
					<p><small>Created by <a href="#">{{ $users[$item->id]->firstname }}</a></small></p>
				@endforeach
			</div>
		@endforeach
	</div>
@endsection
