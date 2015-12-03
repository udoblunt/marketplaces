<!-- Stored in resources/views/item/add.blade.php -->

@extends('layouts.environment_master')
	
@section('title', $title)

@if ($step == 1)
    @section('content')
            <h1>Add a new item: Step 1</h1>

            <form id="addItem" method="post" action="{{ url('ctrl/i/add') }}"> <!-- addItem Form -->

                {!! csrf_field() !!}
                <div> <!-- name div -->
                    <label for="name">Name</label>
                    <input form="addItem" type="text" name="name" placeholder="Name of your item, e.g. Gazelle 6-speed" required="" value="{{ old('name') }}">
                </div> <!-- /name div -->

                <div> <!-- description div -->
                    <label for="description">Description</label>
                    <textarea form="addItem" name="description" cols="20" rows="10" placeholder="Add a description for your item, e.g. great 6-speed well maintained" required="">{{ old('description') }}</textarea>
                </div> <!-- /description div -->

                <div> <!-- price div -->
                    <label for="price">Price</label>
                    <input form="addItem" type="text" name="price" placeholder="45,76" value="{{ old('price') }}">
                </div> <!-- /price div -->

                <div>
                    <label for="by_mail">Sendable by mail</label>
                    <input form="addItem" type="checkbox" name="by_mail">
                </div>
                
                <div> <!-- markets div -->
                    @foreach ($markets as $market)
                        <label for="market{{ $market->id }}">{{ $market->name }}</label>
                        <input form="addItem" type="checkbox" name="markets[{{ $market->id }}]">
                    @endforeach
                </div> <!-- /markets div -->

                <div id="inputContainer"> <!-- item photos div -->
                    
                </div> <!-- /item photos Div -->
                
                <div>
                    <a onclick="addInput()">Add Photo</a>
                </div>
                
                <div>
                    <button form="addItem" name="next" type="submit">Next</button>
                </div>

                <script type="text/javascript">
                    $count = 1;
                    function addInput() {
                        $('#inputContainer').append( $( '<input form="addItem" type="file" name="itemPhotos[' + $count + ']">' ) );
                        $count++;
                    }
                </script>
            </form> <!-- /addItem Form -->
    @endsection
@elseif ($step == 2)
    @section('content')
            <h1>Add a new item: Step 2</h1>

            <form id="addItem" method="post" action="{{ url('ctrl/i/add') }}"> <!-- addItem Form -->

                {!! csrf_field() !!}
                
                @foreach ($selectedMarkets as $market)
                    @foreach ($market->defaultAttributes as $attribute)
                    <input form="addItem" type="text" name="{{ $attribute->name }}" placeholder="" value="{{ old() }}">
                    @endforeach
                @endforeach
                
                <div>
                    <button form="addItem" name="save" type="submit">Save</button>
                </div>
                
            </form> <!-- /addItem Form -->
    @endsection
@endif