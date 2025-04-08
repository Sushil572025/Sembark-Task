@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <h2>Login to Your Account</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div class="form-group">
            <button type="submit">Login</button>
        </div>
    </form>
    <p style="text-align: center;">Don't have an account? Contact the SuperAdmin for an invitation.</p>
@endsection
