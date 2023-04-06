@extends('admin.layout.master')

@section('title')
    <title>Password Management</title>
@endsection

@section('navTitle')
    <span class="form-header">
        <h3 class="h3">Password</h3>
    </span>
@endsection

@section('mainContent')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-6 offset-3">
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
                            <form class="mt-3" action="{{route('admin#passwordChange')}}" method="POST">
                                @csrf
                                    <div class="form-group">
                                        <label for="current_password" class="control-label mb-1">Current Password</label>
                                        <input id="current_password" name="current_password" type="password" class="form-control"/>
                                        @error('current_password')
                                        <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password" class="control-label mb-1">New Password</label>
                                        <input id="password" name="password" type="password" class="form-control"/>
                                        @error('password')
                                        <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password_confirmation" class="control-label mb-1">Confirm Password</label>
                                        <input id="password_confirmation" name="password_confirmation" type="password" class="form-control"/>
                                    </div>

                                    <button type="submit" class="btn btn-lg bg-success btn-outline-success text-white btn-block">
                                        Change
                                    </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
