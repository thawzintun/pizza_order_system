@extends('admin.layout.master')

@section('title')
    <title>Product List</title>
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
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <form action="" class="d-flex mb-3" method="get">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i></span>
                                    </div>
                                    <input type="search" class="form-control" name="key" value="{{request('key')}}" placeholder="Search Product...">
                                </div>
                                <button class="btn btn-success ml-2">Search</button>
                            </form>
                            <div class="d-flex">
                                <h5 class="text-secondary">Search Key : <span>{{request('key')}}</span></h4>
                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{route('product#createPage')}}">
                                <button class="btn btn-success">
                                    <i class="zmdi zmdi-plus"></i> Add Product
                                </button>
                            </a>
                            <button class="btn btn-success">
                                CSV download
                            </button>
                        </div>
                    </div>
                    @if (session('productAddSuccess'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <span>{{ session('productAddSuccess') }}</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (session('productDeleteSuccess'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <span>{{ session('productDeleteSuccess') }}</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session('productUpdateSuccess'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <span>{{ session('productUpdateSuccess') }}</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
                @if (count($productList) != 0)
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th class=" text-center">Image</th>
                                    <th class=" text-center">Product Name</th>
                                    <th class=" text-center">Cateogry</th>
                                    <th class=" text-center">Price</th>
                                    <th class=" text-center">View</th>
                                    <th class=" text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productList as $item)
                                <tr class="tr-shadow">
                                    <td class="col-2">
                                        <img class="rounded mx-auto d-block img-thumbnail" style="width: 150px;height:100px;" src="{{asset('storage/'.$item->image)}}" alt=""/>
                                    </td>
                                    <td class="col-3 text-center">
                                        <span class="block-email">{{$item->name}}</span>
                                    </td>
                                    <td class="col-2 text-center">
                                        <span class="">{{$item->c_name}}</span>
                                    </td>
                                    <td class="col-2 text-center">
                                        <span class="">{{$item->price}} MMK</span>
                                    </td>
                                    <td class="col-1 text-center">
                                        <span class=""><i class="zmdi zmdi-eye"></i> {{$item->view_count}}</span>
                                    </td>
                                    <td class="text-center">
                                        <div class="table-data-feature">
                                            <a href="{{route('admin#productDetail',$item->product_id)}}" class="item" data-toggle="tooltip" data-placement="top"
                                                title="More">
                                                <i class="zmdi zmdi-eye"></i>
                                            </a>
                                            <a href="{{route('product#editPage',$item->product_id)}}" class="item" data-toggle="tooltip" data-placement="top"
                                                title="Edit">
                                                <i class="zmdi zmdi-edit"></i>
                                            </a>
                                            <a href="{{route('admin#productDelete',$item->product_id)}}" class="item" data-toggle="tooltip" data-placement="top"
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
                {{ $productList->appends(request()->query())->onEachSide(1)->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
