<!-- Stored in resources/views/item/add.blade.php -->

@extends('layouts.environment_master')
	
@section('title', $title)

@section('content')
	<h1>Add a new item</h1>
	
        <form id="addItem" method="post" action="{{ url('ctrl/i/add') }}"> <!-- addItem Form -->
            
            {!! csrf_field() !!}
            <div> <!-- name div -->
                <label for="name">Name</label>
                <input form="addItem" type="text" name="name" placeholder="Name of your item, e.g. Gazelle 6-speed" required="" value="{{ old('name') }}">
            </div> <!-- /name div -->
            
            <div> <!-- description div -->
                <label for="description">Description</label>
                <textarea form="addItem" name="description" cols="20" rows="10" placeholder="Add a description for your market, e.g. all sorts of bikes (including tricycle)" required="">{{ old('description') }}</textarea>
            </div> <!-- /description div -->
            
            <div> <!-- price div -->
                <label for="price">Price</label>
                <input form="addItem" type="text" name="price" placeholder="45,76" value="{{ old('price') }}">
            </div> <!-- /price div -->
            
            <div>
                <label for="by_mail">Sendable by mail</label>
                <input form="addItem" type="checkbox" name="by_mail">
            </div>
            
            <div> <!-- itemAttributes div -->
                <?php $i = 0 ?>
                @foreach ($defaultAttributes as $defaultAttribute)
                    <input form="addItem" type="text" name="itemAttributes[{{ $i }}]" placeholder=". . .">
                    $i++;
                @endforeach
            </div> <!-- /itemAttributes div -->
            
            <div>
                <a onclick="addInput()">Add Attribute</a>
            </div>
            <div>
                <button form="addItem" type="submit">Save</button>
            </div>
            
            <script type="text/javascript">
                $count = 2;
                function addInput() {
                    $('#inputContainer').append( $( '<input form="addItem" name="defaultAttributeNames[' + $count + ']" placeholder="Name of your attribute">' ) );
                    $count++;
                }
            </script>
        </form> <!-- /addItem Form -->
        
@endsection
