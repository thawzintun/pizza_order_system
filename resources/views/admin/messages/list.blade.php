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
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                        </div>
                        <div class="table-data__tool-right">
                            <button class="btn btn-success">
                                CSV download
                            </button>
                        </div>
                    </div>
                    @if (count($messages) != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Created Time</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Subject</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = ($messages->currentpage() - 1) * $messages->perpage();
                                    @endphp
                                    @foreach ($messages as $item)
                                        <tr class="tr-shadow">
                                            <td class="">{{ ++$i }}.</td>
                                            <td class="">{{ $item->created_at->format('Y-m-d h:i A') }}</td>
                                            <td class="">
                                                <span class="block-email">{{ $item->name }}</span>
                                            </td>
                                            <td class="">{{ $item->phone }}</td>
                                            <td class="">{{ $item->email }}</td>
                                            <td class="">{{ $item->subject }}</td>
                                            <td>
                                                <div class="table-data-feature">
                                                    <a href="{{ route('admin#messageDetails', $item->contact_id) }}"
                                                        class="item bg-transparent" data-toggle="tooltip" data-placement="top"
                                                        title="More">
                                                        <i class="fa fa-info-circle"></i>
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
                        <h3 class="text-muted text-center mt-5">There is no Message.</h3>
                    @endif
                    {{ $messages->appends(request()->query())->onEachSide(1)->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
