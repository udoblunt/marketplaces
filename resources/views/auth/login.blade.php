<!-- resources/views/auth/login.blade.php -->

@extends('layouts.environment_master')

@section('title', 'Login')

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
    <div>
        <div>
            <h3>Login</h3>
        </div>
        <form method="POST" action="/auth/login">
            {!! csrf_field() !!}

            <div>
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}">
            </div>

            <div>
                <label>Password</label>
                <input type="password" name="password" id="password">
            </div>

            <div>
                <label>Remember Me</label>
                <input type="checkbox" name="remember">
                <button type="submit">Login</button>
            </div>

            <div>
                <label>No account yet?</label>
                <a href="{{ url('auth/register') }}">Sign up</a>
            </div>
        </form>
    </div>
@endsection

