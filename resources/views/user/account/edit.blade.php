@extends('user.layout.master')

@section('title')
    <title>Account</title>
@endsection

@section('contents')
    <div class="container-fluid">
        <div class="row">
            <div class="col-6 offset-3 border badge-light p-4 rounded">
                @if (session('profileUpdate'))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <span>{{ session('profileUpdate') }}</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="row">
                    <div class="col-3">
                        <button onclick="history.back()" class="btn btn-sm btn-outline-warning">
                            <i class="zmdi zmdi-long-arrow-left"></i> Back
                        </button>

                    </div>
                    <div class="col-6 text-center">
                        <h3 class="d-inline font-weight-normal">Edit Profile</h3>
                    </div>
                    <div class="col-12">
                        <hr>
                    </div>
                    <div class="col-12">
                        @livewire('user-account')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
