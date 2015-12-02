<!-- Stored in resources/views/market/add.blade.php -->

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
	<h1>Add a new market</h1>
	
        <form id="addMarket" method="post" action="{{ url('/m/add') }}"> <!-- addMarket Form -->
            
            {!! csrf_field() !!}
            
            <div> <!-- name Div -->
                <label for="name">Name</label>
                <input form="addMarket" type="text" name="name" placeholder="Name of your market, e.g. Bikes" required="">
            </div> <!-- /name Div -->
            
            <div> <!-- description Div -->
                <label for="description">Description</label>
                <textarea form="addMarket" name="description" cols="5" rows="10" placeholder="Add a description for your market, e.g. all sorts of bikes (including tricycle)" required=""></textarea>
            </div> <!-- /description Div -->
            
            <div> <!-- defaultAttributes Div -->
                <input form="addMarket" name="defaultAttributeName1" placeholder="Name of your attribute, e.g. Framesize">
                <input form="addMarket" name="defaultAttributeName2" placeholder="Name of your attribute, e.g. Color">
                <input form="addMarket" name="defaultAttributeName3" placeholder="Name of your attribute, e.g. Type">
            </div> <!-- /defaultAttributes Div -->
            
        </form> <!-- /addMarket Form -->
        
@endsection
