@extends('admin.layout.master')

@section('title')
    <title>User Message</title>
@endsection

@section('navTitle')
    <span class="form-header">
        <h3 class="h3">Message</h3>
    </span>
@endsection

@section('mainContent')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-8 offset-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <button onclick="history.back()" class="btn btn-sm btn-outline-success">
                                        <i class="zmdi zmdi-long-arrow-left"></i> Back
                                    </button>

                                </div>
                                <div class="col-6 text-center">
                                    <h3 class="d-inline font-weight-normal">Message Detail</h3>
                                </div>
                            </div>
                            <hr>
                            <div class="row mx-2 mt-4">
                                <div class="col-4 py-3 border rounded-left">Name</div>
                                <div class="col-8 py-3 border rounded-right">{{$data->name}}</div>
                                <div class="col-4 py-3 border rounded-left">Phone Number</div>
                                <div class="col-8 py-3 border rounded-right">{{$data->phone}}</div>
                                <div class="col-4 py-3 border rounded-left">Email Address</div>
                                <div class="col-8 py-3 border rounded-right">{{$data->email}}</div>
                                <div class="col-4 py-3 border rounded-left">Subject</div>
                                <div class="col-8 py-3 border rounded-right">{{$data->subject}}</div>
                                <div class="col-4 py-3 border rounded-left">Message</div>
                                <div class="col-8 py-3 border rounded-right">{{$data->message}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
