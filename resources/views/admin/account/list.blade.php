@extends('admin.layout.master')

@section('title')
    <title>Admin List</title>
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
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <form action="" class="d-flex mb-3" method="get">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i></span>
                                    </div>
                                    <input type="search" class="form-control" name="key" value="{{ request('key') }}"
                                        placeholder="Search Account...">
                                </div>
                                <button class="btn btn-success ml-2">Search</button>
                            </form>
                            <div class="d-flex">
                                <h5 class="text-secondary">Search Key : <span>{{ request('key') }}</span></h5>
                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('admin#create') }}">
                                <button class="btn btn-success">
                                    <i class="zmdi zmdi-plus"></i> Add Admin
                                </button>
                            </a>
                            <button class="btn btn-success">
                                CSV download
                            </button>
                        </div>
                    </div>
                    @if (session('adminCreate'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <span>{{ session('adminCreate') }}</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if (session('adminUpdate'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <span>{{ session('adminUpdate') }}</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (session('adminDeleteSuccess'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <span>{{ session('adminDeleteSuccess') }}</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th class=" text-center">Profile</th>
                                    <th class=" text-center">Name</th>
                                    <th class=" text-center">Email</th>
                                    <th class=" text-center">Phone</th>
                                    <th class=" text-center">Address</th>
                                    <th class=" text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr class="tr-shadow">
                                        <td class="col-2">
                                            @if ($item->profile_photo_path == null)
                                                <img class="mx-auto d-block img-thumbnail" style="width: 100px; height:100px;"
                                                    src='https://ui-avatars.com/api/?name={{ $item->name }}&size=512&color=7F9CF5&background=63c76a&color=ffffff&format=svg'
                                                    alt="" />
                                            @else
                                                <img class="mx-auto d-block img-thumbnail" style="width: 100px; height:100px;"
                                                    src="{{ asset('storage/' . $item->profile_photo_path) }}"
                                                    alt="" />
                                            @endif
                                        </td>
                                        <td class="col-2 text-center">
                                            <span class="block-email">{{ $item->name }}</span>
                                        </td>
                                        <td class="col-2 text-center">
                                            <span class="">{{ $item->email }}</span>
                                        </td>
                                        <td class="col-2 text-center">
                                            <span class="">{{ $item->phone }}</span>
                                        </td>
                                        <td class="col-1 text-center">
                                            <span class="">{{ $item->address }}</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="table-data-feature">
                                                <a href="{{route('admin#listDetail',$item->id)}}" class="item" data-toggle="tooltip" data-placement="top"
                                                    title="More">
                                                    <i class="zmdi zmdi-eye"></i>
                                                </a>
                                                <a href="{{route('admin#edit',$item->id)}}" class="item" data-toggle="tooltip" data-placement="top"
                                                    title="Edit">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </a>
                                                @if ($item->id != 1 && $item->id != Auth::user()->id)
                                                    <a href="" class="item" data-toggle="tooltip"
                                                        data-placement="top" title="Delete">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- END DATA TABLE -->
                    {{ $data->appends(request()->query())->onEachSide(1)->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
