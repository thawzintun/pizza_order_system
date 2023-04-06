@extends('admin.layout.master')

@section('title')
    <title>Admin</title>
@endsection

@section('navTitle')
    <span class="form-header">
        <h3 class="h3">Admin</h3>
    </span>
@endsection

@section('mainContent')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <div class="row">
                                    <div class="col-3">
                                        <button onclick="history.back()" class="btn btn-sm btn-outline-success">
                                            <i class="zmdi zmdi-long-arrow-left"></i> Back
                                        </button>

                                    </div>
                                    <div class="col-6 text-center">
                                        <h3 class="d-inline font-weight-normal">Edit Admin</h3>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row mx-2 mt-4">
                                @livewire('admin-edit', ['id' => $a_id])
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
