@extends('layouts.guest')

@section('content')
<div class="admin-login">
    <div class="admin-login__card">
        <div class="admin-login__brand">
            <img src="{{ asset('images/EMBLEM.PNG') }}" alt="Suicide Squad 11.5">
            <h1>Suicide Squad 11.5</h1>
            <p>Sign in to admin panel</p>
        </div>

        @if ($errors->any())
            <div class="admin-alert admin-alert--danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login') }}" method="post">
            @csrf

            <div class="admin-login__field">
                <label for="email">Email address</label>
                <input type="email" id="email" name="email"
                    class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}"
                    placeholder="admin@suicide.com"
                    required autofocus>
                @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-login__field">
                <label for="password">Password</label>
                <input type="password" id="password" name="password"
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder="Enter your password"
                    required>
                @error('password')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-login__options">
                <label class="admin-login__remember">
                    <input type="checkbox" id="remember" name="remember">
                    Remember me
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">Forgot password?</a>
                @endif
            </div>

            <button type="submit" class="btn btn-primary btn-block">
                <i class="bx bx-log-in"></i> Sign In
            </button>
        </form>

        <div class="admin-login__footer">
            <a href="{{ route('homepage') }}"><i class="bx bx-arrow-back"></i> Back to website</a>
        </div>
    </div>
</div>
@endsection
