@extends('user.layout.master')

@section('title')
    <title>Home</title>
@endsection

@section('contents')
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-sm-8 offset-sm-2 col-md-8 offset-md-2 offset-md-2 col-lg-6 offset-lg-3">
                @if (session('changeSuccess'))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <span>{{ session('changeSuccess') }}</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Change Password</h3>
                        </div>
                        <hr>
                        <form class="mt-3" action="{{ route('user#passwordChange') }}" method="POST">
                            @csrf
                            <div class="form-group py-1">
                                <label for="current_password" class="control-label mb-1">Current Password</label>
                                <input id="current_password" name="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" placeholder="Your Current Password"/>
                                @error('current_password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group py-1">
                                <label for="password" class="control-label mb-1">New Password</label>
                                <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter New Password" />
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group py-1">
                                <label for="password_confirmation" class="control-label mb-1">Confirm Password</label>
                                <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Re-enter Your New Password"
                                    class="form-control" />
                            </div>

                            <button type="submit" class="btn btn-lg bg-warning btn-outline-warning text-white btn-block">
                                Change
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
