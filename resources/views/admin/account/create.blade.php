@extends('admin.layout.master')

@section('title')
    <title>Add Admin</title>
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
            <div class="col-lg-8 offset-2">
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
                                    <h3 class="d-inline font-weight-normal">Add Admin</h3>
                                </div>
                            </div>
                        </div>
                        <hr>
                        @livewire('admin-create')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection
