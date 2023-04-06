@extends('admin.layout.master')

@section('title')
    <title>Create Category</title>
@endsection

@section('navTitle')
    <span class="form-header">
        <h3 class="h3">Category</h3>
    </span>
@endsection

@section('mainContent')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-6 offset-3">
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
                                    <h3 class="d-inline font-weight-normal">Create Category</h3>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <form action="{{route('admin#categoryCreate')}}" method="post" novalidate="novalidate">
                            @csrf
                            <div class="form-group">
                                <label for="categoryName" class="control-label mb-1">Name</label>
                                <input id="categoryName" name="categoryName" value="{{old('categoryName')}}" type="text" class="au-input au-input--full form-control" autofocus placeholder="Seafood...">
                                @error('categoryName')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>

                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg bg-success btn-outline-success text-white btn-block">
                                    <span id="payment-button-amount">Create</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection
