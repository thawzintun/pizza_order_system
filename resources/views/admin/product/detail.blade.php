@extends('admin.layout.master')

@section('title')
    <title>Product Detail</title>
@endsection

@section('navTitle')
    <span class="form-header">
        <h3 class="h3">Product</h3>
    </span>
@endsection

@section('mainContent')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-11 mx-auto mt-3">
                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="card-title">
                                <div class="row">
                                    <div class="col-3">
                                        <button onclick="history.back()" class="btn btn-sm btn-outline-success">
                                            <i class="zmdi zmdi-long-arrow-left"></i> Back
                                        </button>

                                    </div>
                                    <div class="col-6 text-center">
                                        <h3 class="d-inline font-weight-normal">Product Details</h3>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <div class="row mx-2">
                                <div class="col-4">
                                    <img class="rounded img-thumbnail"
                                        src="{{ asset('storage/' . $data->image) }}" alt="" />
                                </div>
                                <div class="col-8 mt-3">
                                    <h3 class=" font-weight-normal"><i class="zmdi zmdi-pizza mr-2"></i>{{$data->name}}</h3>
                                    <div class="mt-3">
                                        <span class="btn-sm bg-dark text-white font-weight-normal"><i class="zmdi zmdi-money-box mr-2"></i>{{$data->price}} MMK</span>
                                        <span class="btn-sm bg-dark text-white font-weight-normal"><i class="zmdi zmdi-layers mr-2"></i>{{$data->c_name}}</span>
                                        <span class="btn-sm bg-dark text-white font-weight-normal"><i class="zmdi zmdi-eye mr-2"></i>{{$data->waiting_time}} mins</span>
                                        <span class="btn-sm bg-dark text-white font-weight-normal"><i class="zmdi zmdi-time mr-2"></i>{{$data->view_count}}</span>
                                    </div>
                                    <span class="font-weight-bold"><i class="zmdi zmdi-view-headline mr-2 mt-4"></i>Description</span>
                                    <p class="mt-1">{{$data->description}}</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
