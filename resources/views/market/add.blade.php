<!-- Stored in resources/views/market/add.blade.php -->

@extends('layouts.environment_master')
	
@section('title', $title)

@section('content')
	<h1>Add a new market</h1>
	
        <form id="addMarket" method="post" action="{{ url('ctrl/m/add') }}"> <!-- addMarket Form -->
            
            {!! csrf_field() !!}
            <div> <!-- name Div -->
                <label for="name">Name</label>
                <input form="addMarket" type="text" name="name" placeholder="Name of your market, e.g. Bikes" required="" value="{{ old('name') }}">
            </div> <!-- /name Div -->
            
            <div> <!-- description Div -->
                <label for="description">Description</label>
                <textarea form="addMarket" name="description" cols="20" rows="10" placeholder="Add a description for your market, e.g. all sorts of bikes (including tricycle)" required="">{{ old('description') }}</textarea>
            </div> <!-- /description Div -->
            
            <div id="inputContainer"> <!-- defaultAttributes Div -->
                <input form="addMarket" type="text" name="defaultAttributeNames[1]" placeholder="Name of your attribute">
            </div> <!-- /defaultAttributes Div -->
            
            <div>
                <a onclick="addInput()">Add Attribute</a>
            </div>
            <div>
                <button form="addMarket" type="submit">Save</button>
            </div>
            
            <script type="text/javascript">
                $count = 2;
                function addInput() {
                    $('#inputContainer').append( $( '<input form="addMarket" name="defaultAttributeNames[' + $count + ']" placeholder="Name of your attribute">' ) );
                    $count++;
                }
            </script>
        </form> <!-- /addMarket Form -->
        
@endsection
