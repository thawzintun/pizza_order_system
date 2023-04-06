@extends('admin.layout.master')

@section('title')
    <title>Edit Category</title>
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
                                    <h3 class="d-inline font-weight-normal">Edit Category</h3>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <form action="{{route('admin#categoryEdit',$editData->category_id)}}" method="post" novalidate="novalidate">
                            @csrf
                            <input type="hidden" name="categoryID" value="{{ $editData->category_id }}">
                            <div class="form-group">
                                <label for="categoryName" class="control-label mb-1">Name</label>
                                <input id="categoryName" name="categoryName" value="{{old('categoryName',$editData->name)}}" type="text" class="au-input au-input--full form-control" placeholder="Seafood...">
                                @error('categoryName')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>

                            <div class="d-flex">
                                <button type="button" onclick="history.back()" class="btn btn-lg btn-outline-danger btn-block mt-2 mr-3">
                                    <span>Cancel</span>
                                    <i class="fa-solid fa-circle-right"></i>
                                </button>
                                <button type="submit" class="btn btn-lg btn-success btn-block ml-3">
                                    <span>Edit</span>
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
