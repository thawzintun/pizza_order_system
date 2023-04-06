@extends('layouts.master')

@section('title')
    <title>Register</title>
@endsection

@section('myContent')
    <div class="login-form">
        <form action="{{ route('register') }}" method="post">
            @csrf
            <div class="form-group">
                <label class="form-label" for="name">Name</label>
                <input class="au-input au-input--full" id="name" autofocus type="text" name="name"
                    value="{{ old('name') }}" placeholder="Full Name">
            </div>
            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input class="au-input au-input--full" id="email" type="email" name="email"
                    value="{{ old('email') }}" placeholder="Email">
            </div>
            <div class="form-group">
                <label class="form-label" for="phone">Phone Number</label>
                <input class="au-input au-input--full" id="phone" type="text" name="phone"
                    value="{{ old('phone') }}" placeholder="09 xxx xxx xxx">
            </div>
            <div class="form-group">
                <label class="form-label" for="address">Address</label>
                <input class="au-input au-input--full" id="address" type="text" name="address"
                    value="{{ old('address') }}" placeholder="Your Address">
            </div>
            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <input class="au-input au-input--full" id="password" type="password" name="password"
                    placeholder="Password">
            </div>
            <div class="form-group">
                <label class="form-label" for="password_confirmation">Confirm Password</label>
                <input class="au-input au-input--full" id="password_confirmation" type="password"
                    name="password_confirmation" placeholder="Re-type your Password">
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

            <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Register</button>

        </form>
        <div class="register-link">
            <p>
                Already have account?
                <a href="{{ route('login') }}">Sign In</a>
            </p>
        </div>
    </div>
@endsection
