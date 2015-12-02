<!-- resources/views/auth/register.blade.php -->

@extends('layouts.environment_master')

@section('title', 'Sign up')

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
    <style type="text/css">
         #map-canvas {
            height: 300px;
            width: 500px;
            margin: 0px;
            padding: 0px
        }

        label {
            width: 262px;
            display: inline-block;
        }

        input#search {
            width: 495px;

        }
    </style>

    <div>
        <div>
            <h3>Sign Up</h3>
        </div>
        <form method="POST" action="{{ url('auth/register') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div>
                <label>Firstname</label>
                <input type="text" name="first_name" value="{{ old('first_name') }}">
            </div>

            <div>
                <label>Lastname</label>
                <input type="text" name="last_name" value="{{ old('last_name') }}">
            </div>

            <div>
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}">
            </div>

            <div>
                <label>Password</label>
                <input type="password" name="password">
            </div>

            <div>
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation">
            </div>

            <div>
                <label>Country</label>
                <input type="text" name="country" value="{{ old('country') }}">
            </div>

            <div>
                <label>State</label>
                <input type="text" name="state" value="{{ old('state') }}">
            </div>

            <div>
                <label>Postal code</label>
                <input type="text" name="postal_code" value="{{ old('postal_code') }}">
            </div>

            <div>
                <label>Phone</label>
                <input type="text" name="phone" value="{{ old('phone') }}">
            </div>

            <div>
                <label>Scope <small>This is the search area's diameter.</label>
                <input type="text" name="scope" value="{{ old('scope') }}">
            </div>

            {!!Form::text('search',null,["id"=>"search", "placeholder"=>"Search your location here", "class"=>"location"])!!}
            <div id="map-canvas"></div>
            {!!Form::hidden('longitude','4.4024643',["id"=>"lng"])!!}
            {!!Form::hidden('latitude','51.2194475',["id"=>"lat"])!!}
            <small>The scope is 2000 meters or 2 km by default</small>

            <div>
                <label>No account yet?</label>
                <a href="{{ url('auth/login') }}">Log in</a>
                <button type="submit">Register</button>
            </div>
        </form>
    </div>

    <script type="text/javascript">
        var map = new google.maps.Map(document.getElementById('map-canvas'),{
            center:{
                lat: 51.2194475,
                lng: 4.4024643

            },
            zoom:15
        });
        var marker = new google.maps.Marker({
            position:{
                lat: 51.2194475,
                lng: 4.4024643

            },
            map:map,
            draggable:true,
        });
        var defaultBounds = new google.maps.LatLngBounds(
          new google.maps.LatLng(-33.8902, 151.1759),
          new google.maps.LatLng(-33.8474, 151.2631));

        var input = document.getElementById('search');

        var searchBox = new google.maps.places.SearchBox(input, {
          bounds: defaultBounds
        });

         google.maps.event.addListener(searchBox, 'places_changed', function() {
            var places = searchBox.getPlaces();
            var bounds = new google.maps.LatLngBounds();
            var place, i;

            for (var i = 0; place = places[i]; i++) {
                bounds.extend(place.geometry.location);
                marker.setPosition(place.geometry.location);
            }

            map.fitBounds(bounds);
            map.setZoom(15);
            console.log(marker);
         });

         google.maps.event.addListener(marker,'position_changed',function(){
            var lat = marker.getPosition().lat();
            var lng = marker.getPosition().lng();

            $('#lat').val(lat);
            $('#lng').val(lng);
         });
    </script>
@endsection
