<!-- Stored in resources/views/item/add.blade.php -->

@extends('layouts.environment_master')
	
@section('title', $title)

@if ($step == 1)
    @section('content')
            <h1>Add a new item: Step 1</h1>

            <form id="addItem" method="post" action="{{ url('ctrl/i/add') }}"> <!-- addItem Form -->

                {!! csrf_field() !!}
                
                <div> <!-- markets div -->
                    @foreach ($markets as $market)
                        <label for="market{{ $market->id }}">{{ $market->name }}</label>
                        <input form="addItem" type="checkbox" name="markets[{{ $market->id }}]">
                    @endforeach
                </div> <!-- /markets div -->

                <div>
                    <button form="addItem" name="next" value="1" type="submit">Next</button>
                </div>

                
            </form> <!-- /addItem Form -->
    @endsection
@elseif ($step == 2)
    @section('content')
            <h1>Add a new item: Step 2</h1>

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
                
                <div>
                    <a onclick="addInput()">Add Photo</a>
                </div>
                
                <div id="inputContainer"> <!-- item photos div -->
                    <input form="addItem" type="file" name="itemPhotos[]" multiple="true">
                </div> <!-- /item photos Div -->
                
                <div> <!-- defaultAttributes of selectedMarkets -->
                    <h2>Default Attributes of your selected markets</h2>
                    @foreach ($selectedMarkets as $market)

                        <div>
                            <h3>{{ $market->name }}</h3>
                        @foreach ($market->defaultAttributes as $attribute)

                            <div> <!-- defaultAttribute of one selectedMarket -->
                                <label for="{{ $attribute->name }}">{{ $attribute->name }}</label>
                                <input form="addItem" type="text" name="itemAttributes[{{ $attribute->name }}]" placeholder="">
                            </div> <!-- /defaultAttribute of selectedMarket -->

                        @endforeach
                        </div>

                    @endforeach
                </div> <!-- /defaultAttributes of selectedMarkets -->
                
                <div>
                    <button form="addItem" name="save" value="1" type="submit">Save</button>
                </div>
                
                <script type="text/javascript">
                    $count = 1;
                    function addInput() {
                        $('#inputContainer').append( $( '<input form="addItem" type="file" multiple="true" name="itemPhotos[' + $count + ']">' ) );
                        $count++;
                    }
                </script>
                
            </form> <!-- /addItem Form -->
    @endsection
@endif