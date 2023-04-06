@extends('layouts.master')

@section('title')
    <title>Login</title>
@endsection

@section('myContent')
    <div class="login-form">
        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input class="au-input au-input--full" autofocus id="email" type="email" value="{{ old('email') }}"
                    name="email" placeholder="Email">
            </div>
            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <input class="au-input au-input--full" id="password" type="password" name="password"
                    placeholder="Password">
            </div>

            <div class="form-group mb-4">
                <input type="checkbox" name="remember" id="remember_me">
                <span for="remember_me">Remember me</span>
            </div>

            <div class="form-group ml-3">
                <ul>
                    @foreach ($errors->all() as $message)
                        <small>
                            <li class="text-danger">{{ $message }}</li>
                        </small>
                    @endforeach
                </ul>
            </div>

            <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Log in</button>

        </form>
        <div class="register-link">
            <p>
                Don't you have account?
                <a href="{{ route('register') }}">Sign Up Here</a>
            </p>
        </div>
    </div>
@endsection
