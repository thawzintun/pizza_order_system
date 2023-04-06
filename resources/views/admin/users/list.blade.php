@extends('admin.layout.master')

@section('title')
    <title>User</title>
@endsection

@section('navTitle')
    <span class="form-header">
        <h3 class="h3">Users</h3>
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
                                        placeholder="Search Name...">
                                </div>
                                <button class="btn btn-success ml-2">Search</button>
                            </form>
                            <div class="d-flex">
                                <h5 class="text-secondary">Search Name : <span>{{ request('key') }}</span></h4>
                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <button class="btn btn-success">
                                CSV download
                            </button>
                        </div>
                    </div>
                    @if (count($user) != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th class=" text-center"></th>
                                        <th class=" text-center">Name</th>
                                        <th class=" text-center">Phone</th>
                                        <th class=" text-center">Address</th>
                                        <th class=" text-center">Created Date</th>
                                        <th class=" text-center"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user as $item)
                                        <tr class="tr-shadow">
                                            <td class="col-2 text-center">
                                                @if ($item->profile_photo_path == null)
                                                    <img class="rounded mx-auto d-block img-thumbnail" width="100" src='https://ui-avatars.com/api/?name={{ $item->name }}&size=512&color=7F9CF5&background=63c76a&color=ffffff&format=svg' alt="" />
                                                @else
                                                    <img class="rounded mx-auto d-block img-thumbnail" width="100" src="{{ asset('storage/' . $item->profile_photo_path) }}" alt="" />
                                                @endif
                                            </td>
                                            <td class="col-2 text-center">
                                                <span class="block-email">{{ $item->name }}</span>
                                            </td>
                                            <td class="col-2 text-center">
                                                <span class="">{{ $item->phone }}</span>
                                            </td>
                                            <td class="col-2 text-center">
                                                <span class="">{{ $item->address }}</span>
                                            </td>
                                            <td class="col-2 text-center">
                                                <span class="">{{ $item->created_at->format('Y-M-d') }}</span>
                                            </td>
                                            <td class="text-center">
                                                <div class="table-data-feature justify-content-center">
                                                    <a href="{{route('admin#userDetail',$item->id)}}" class="item bg-transparent" data-toggle="tooltip" data-placement="top" title="Details">
                                                        <i class="zmdi zmdi-info"></i>
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
                        <h3 class="text-muted text-center mt-5">There are no users!</h3>
                    @endif
                    {{ $user->appends(request()->query())->onEachSide(1)->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
