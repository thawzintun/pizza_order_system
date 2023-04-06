@extends('admin.layout.master')

@section('title')
    <title>Account</title>
@endsection

@section('navTitle')
    <span class="form-header">
        <h3 class="h3">Account</h3>
    </span>
@endsection

@section('mainContent')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-12">
                    @if (session('profileUpdate'))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <span>{{ session('profileUpdate') }}</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <button onclick="history.back()" class="btn btn-sm btn-outline-success">
                                        <i class="zmdi zmdi-long-arrow-left"></i> Back
                                    </button>

                                </div>
                                <div class="col-6 text-center">
                                    <h3 class="d-inline font-weight-normal">Profile</h3>
                                </div>
                            </div>
                            <hr>
                            <div class="row mx-2 mt-4">
                                <div class="col-3">
                                    @if (Auth::user()->profile_photo_path == null)
                                        <img class="rounded mx-auto d-block img-thumbnail"
                                            src='https://ui-avatars.com/api/?name={{ Auth::user()->name }}&size=512&color=7F9CF5&background=63c76a&color=ffffff&format=svg'
                                            alt="" />
                                    @else
                                        <img class="rounded mx-auto d-block img-thumbnail" src="{{asset("storage/".Auth::user()->profile_photo_path)}}" alt=""/>
                                    @endif
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('admin#profile') }}" class="mt-4 btn btn-dark text-white">
                                            <i class="fa fa-pencil-square mr-2"></i>
                                            Edit Pofile
                                        </a>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <h4 class="py-3 text-muted"><i
                                            class="zmdi zmdi-account-box mr-3"></i>{{ Auth::user()->name }}</h4>
                                    <h4 class="py-3 text-muted"><i
                                            class="zmdi zmdi-phone mr-3"></i>{{ Auth::user()->phone }}</h4>
                                    <h4 class="py-3 text-muted"><i
                                            class="zmdi zmdi-email mr-3"></i>{{ Auth::user()->email }}</h4>
                                </div>
                                <div class="col-4">
                                    <h4 class="py-3 text-muted"><i class="zmdi zmdi-pin mr-3"></i>{{Auth::user()->address}}</h4>
                                    <h4 class="py-3 text-muted"><i class="zmdi zmdi-male-female mr-3"></i>{{Auth::user()->gender}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
