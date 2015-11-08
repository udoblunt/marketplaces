<!-- Stored in resources/views/public/home.blade.php -->

@extends('layouts.dashboard_master')
	
@section('title', $title)

@section('marketplaces')
    @parent

	    @foreach ($markets as $market)
			<a class="pull-left" href="#">{{ $market->name }}</a>
		@endforeach
@endsection

@section('sidebar')
    @parent
    
@endsection

@section('content')
	<div class="marketsContainer">
		<div class="market">
			<h1>titel</h1>
			<p>Description</p>
		</div>
		<div class="market">
			<h1>titel</h1>
			<p>Description</p>
		</div>
		<div class="market">
			<h1>titel</h1>
			<p>Description</p>
		</div>
		<div class="market">
			<h1>titel</h1>
			<p>Description</p>
		</div>
		<div class="market">
			<h1>titel</h1>
			<p>Description</p>
		</div>
		<div class="market">
			<h1>titel</h1>
			<p>Description</p>
		</div>
		<div class="market">
			<h1>titel</h1>
			<p>Description</p>
		</div>
		<div class="market">
			<h1>titel</h1>
			<p>Description</p>
		</div>
	</div>
@endsection