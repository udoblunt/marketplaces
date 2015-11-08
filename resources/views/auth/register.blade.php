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
    <div>
        <div>
            <h3>Sign Up</h3>
        </div>
        <form method="POST" action="{{ url('auth/register') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div>
                <label>Firstname</label>
                <input type="text" name="firstname" value="{{ old('firstname') }}">
            </div>

            <div>
                <label>Lastname</label>
                <input type="text" name="lastname" value="{{ old('lastname') }}">
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
                <label>No account yet?</label>
                <a href="{{ url('auth/login') }}">Log in</a>
                <button type="submit">Register</button>
            </div>
        </form>
    </div>
@endsection
