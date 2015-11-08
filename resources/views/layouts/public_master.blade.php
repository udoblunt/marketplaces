<!-- Stored in resources/views/layouts/public.blade.php -->

<!DOCTYPE html>
<html>
    <head>
        <title>Marketplaces - @yield('title')</title>
        <link rel="stylesheet" type="text/css" href="{{ url('css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ url('css/styles.css') }}">
        <link href='https://fonts.googleapis.com/css?family=Oswald:300,400,700' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <div class="nav">
            <div class="container">
                <a class="pull-left" href="{{ url('home') }}">Marketplaces |</a>
                @section('marketplaces')

                @show

                <ul class="pull-right">
                    @section('sidebar')
                        <li class=""><a href="{{ url('auth/login') }}">Log in</a></li>
                        <li class=""><a href="{{ url('auth/register') }}">Register</a></li>
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
