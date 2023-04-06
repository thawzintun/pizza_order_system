@extends('admin.layout.master')

@section('title')
    <title>Category List</title>
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
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <form action="" class="d-flex mb-3" method="get">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i></span>
                                    </div>
                                    <input type="search" class="form-control" name="key" value="{{request('key')}}" placeholder="Search Category...">
                                </div>
                                <button class="btn btn-success ml-2">Search</button>
                            </form>
                            <div class="d-flex">
                                <h5 class="text-secondary">Search Key : <span>{{request('key')}}</span></h5>
                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{route('category#createPage')}}">
                                <button class="btn btn-success">
                                    <i class="zmdi zmdi-plus"></i> Add Category
                                </button>
                            </a>
                            <button class="btn btn-success">
                                CSV download
                            </button>
                        </div>
                    </div>
                    @if (session('successMessage'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <span>{{ session('successMessage') }}</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (session('deleteMessage'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <span>{{ session('deleteMessage') }}</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session('updateMessage'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <span>{{ session('updateMessage') }}</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
                @if (count($categoryList) != 0)
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Category Name</th>
                                    <th>Created Date</th>
                                    <th>Last Modified</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @php
                                $i = ($categoryList->currentpage()-1)* $categoryList->perpage();
                            @endphp
                                @foreach ($categoryList as $item)
                                <tr class="tr-shadow">
                                    <td class="col-1">{{++$i}}</td>
                                    <td class="col-3">
                                        <span class="block-email">{{$item->name}}</span>
                                    </td>
                                    <td class="col-3">{{$item->created_at->format("Y-m-d h:i A")}}</td>
                                    <td class="col-3">{{$item->updated_at->format("Y-m-d h:i A")}}</td>
                                    <td>
                                        <div class="table-data-feature">
                                            <a href="{{route('category#editPage',$item->category_id)}}" class="item" data-toggle="tooltip" data-placement="top"
                                                title="Edit">
                                                <i class="zmdi zmdi-edit"></i>
                                            </a>
                                            <a href="{{route('admin#categoryDelete',$item->category_id)}}" class="item" data-toggle="tooltip" data-placement="top"
                                                title="Delete">
                                                <i class="zmdi zmdi-delete"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="spacer"></tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- END DATA TABLE -->
                    @else
                    <h3 class="text-muted text-center mt-5">There is no data!</h3>
                @endif
                {{ $categoryList->appends(request()->query())->onEachSide(1)->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
