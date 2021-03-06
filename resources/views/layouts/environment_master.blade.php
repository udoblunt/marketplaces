<!-- Stored in resources/views/layouts/public.blade.php -->

<!DOCTYPE html>
<html>
    <head>
        <title>Marketplaces - @yield('title')</title>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?libraries=places"></script>
        <link rel="stylesheet" type="text/css" href="{{ url('css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ url('css/styles.css') }}">
        <link href='https://fonts.googleapis.com/css?family=Oswald:300,400,700' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <div class="nav">
            <div class="container">
                <a class="pull-left" href="{{ url('/') }}">MARKETPLACES</a>
                @section('marketplaces')
                    <a style="font-weight: 700" class="pull-left" href="{{ url('/m/explore') }}"> Explore </a>
                    @foreach ($markets as $market)
                        <a class="pull-left" href="{{ url('/m', [$market->name]) }}">{{ $market->name }}</a>
                    @endforeach
                @show

                <ul class="pull-right">
                    @section('sidebar')
			@if (!$loggedIn)
		                <li class=""><a href="{{ url('auth/login') }}">Log in</a></li>
		                <li class=""><a href="{{ url('auth/register') }}">Register</a></li>
			@else
                <li class=""><a href="{{ url('ctrl/i/add') }}">New Item</a></li>
                <li class=""><a href="{{ url('ctrl/i/add') }}">My Items</a></li>
                <li class=""><a href="{{ url('ctrl/m/add') }}">New Market</a></li>
                <li class=""><a href="{{ url('ctrl/m/add') }}">My Markets</a></li>
				<li class=""><a href="{{ url('auth/logout') }}">Log out</a></li>
			@endif
                    @show                
                </ul>
            </div>
        </div>
        

        <div class="container">
            @yield('content')
        </div>

        <div class="footer">

        </div>
    </body>
</html>
