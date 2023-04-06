@extends('admin.layout.master')

@section('title')
    <title>Order List</title>
@endsection

@section('navTitle')
    <span class="form-header">
        <h3 class="h3">Order</h3>
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
                            <div class="table-data__tool-left">
                                <form action="" class="d-flex mb-3" method="get">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i
                                                    class="fa fa-search"></i></span>
                                        </div>
                                        <input type="search" class="form-control" name="key"
                                            value="{{ request('key') }}" placeholder="Search Order...">
                                    </div>
                                    <button class="btn btn-success ml-2">Search</button>
                                </form>
                                <div class="d-flex">
                                    <h5 class="text-secondary">Order Code : <span>{{ request('key') }}</span></h5>
                                </div>
                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <div class="d-flex align-items-center">
                                <span class="mr-2">Filter by Status :</span>
                                <select id="filterStatus" class="rounded btn btn-sm btn-outline-success">
                                    <option value="">All</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Cancelled">Cancelled</option>
                                    <option value="Delivered">Delivered</option>
                                </select>
                                <div class="ml-3">
                                    <button class="btn btn-success">
                                        CSV download
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                    @if (count($orders) != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th class=" text-center">Ordered Date</th>
                                        <th class=" text-center">Order Code</th>
                                        <th class=" text-center">Total Price</th>
                                        <th class=" text-center">Ordered By</th>
                                        <th class=" text-center">Status</th>
                                        <th class=" text-center"></th>
                                    </tr>
                                </thead>
                                <tbody id="ajaxFilterOrder">
                                    @foreach ($orders as $item)
                                        <tr class="tr-shadow">
                                            <td class="col-3 text-center">
                                                <span
                                                    class="block-email">{{ $item->created_at->format('Y-F-d') }}</span>
                                            </td>
                                            <td class="col-1 text-center">
                                                <a class="block-email text-primary" href="{{ route('admin#orderDetails', $item->orderCode) }}">
                                                    {{ $item->orderCode }}
                                                </a>
                                            </td>
                                            <td class="col-2 text-center">
                                                <span class="">{{ $item->total_price }} MMK</span>
                                            </td>
                                            <td class="col-2 text-center">
                                                <span class="">{{ $item->name }}</span>
                                            </td>
                                            <td
                                                class="col-2 text-center @if ($item->status === 'Pending') text-warning
                                        @elseif($item->status === 'Cancelled') text-danger @else text-success @endif">
                                                @if ($item->status === 'Pending')
                                                    <i class="far fa-clock mr-2"></i>
                                                @elseif($item->status === 'Cancelled')
                                                    <i class="far fa-window-close mr-2"></i>
                                                @else
                                                    <i class="fas fa-check mr-2"></i>
                                                @endif <span class="">{{ $item->status }}</span>
                                            </td>
                                            <td class="text-center">
                                                <div class="table-data-feature">
                                                    @if ($item->status == 'Pending')
                                                        <a class="btn rounded mx-1"
                                                            href="{{ route('order#delivered', $item->order_id) }}">
                                                            <i class="fa fa-check text-success"></i>
                                                        </a>
                                                        <a class="btn rounded mx-1"
                                                            href="{{ route('order#cancelled', $item->order_id) }}">
                                                            <i class="fa fa-times text-danger"></i>
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
                    @else
                        <h3 class="text-muted text-center mt-5">There is no data!</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scriptSrc')
    <script>
        $(document).ready(function() {
            $('#filterStatus').change(function() {
                filterStatus = $('#filterStatus').val();
                $.ajax({
                    type: 'get',
                    url: `{{ route('order#ajax') }}`,
                    data: {
                        filterStatus: filterStatus,
                    },
                    datatype: 'json',
                    success: function(response) {
                        filterOrder = '';
                        classText = '';
                        Icon = '';
                        redirect = '';
                        for (let i = 0; i < response.length; i++) {
                            if (response[i].status === 'Pending') {
                                classText = 'text-warning';
                            } else if (response[i].status === 'Cancelled') {
                                classText = 'text-danger';
                            } else {
                                classText = 'text-success';
                            }

                            if (response[i].status === 'Pending') {
                                Icon = '<i class="far fa-clock mr-2"></i>';
                            } else if (response[i].status === 'Cancelled') {
                                Icon = '<i class="far fa-window-close mr-2"></i>';
                            } else {
                                Icon = '<i class="fas fa-check mr-2"></i>';
                            }

                            orderCode = response[i].orderCode;
                            orderId = response[i].order_id;

                            var deliveredUrl = "{{ route('order#delivered', ':parameter') }}"
                                .replace(':parameter', orderId);
                            var cancelledUrl = "{{ route('order#cancelled', ':parameter') }}"
                                .replace(':parameter', orderId);
                            var detailUrl = "{{ route('admin#orderDetails', ':parameter') }}"
                                .replace(':parameter', orderCode);

                            if (response[i].status === 'Pending') {
                                redirect = `<a class="btn rounded mx-1 deliveredUrl" href="${deliveredUrl}">
                                                <i class="fa fa-check text-success"></i>
                                            </a>
                                            <a class="btn rounded mx-1 cancelledUrl" href="${cancelledUrl}">
                                                <i class="fa fa-times text-danger"></i>
                                            </a>`;
                            }

                            const months = ["January", "February", "March", "April", "May",
                                "June", "July", "August", "September", "October",
                                "November", "December"
                            ];
                            const d = new Date(response[i].created_at);
                            month = months[d.getMonth()];

                            newFormat = `${d.getFullYear()}-${month}-${d.getDate()}`;

                            filterOrder += `
                                <tr class="tr-shadow">
                                        <td class="col-3 text-center">
                                            <span class="block-email">${newFormat}</span>
                                        </td>
                                        <td class="col-1 text-center">
                                            <a class="block-email text-primary detailUrl" href="${detailUrl}">
                                                ${response[i].orderCode}
                                            </a>
                                        </td>
                                        <td class="col-2 text-center">
                                            <span class=""> ${response[i].total_price}  MMK</span>
                                        </td>
                                        <td class="col-2 text-center">
                                            <span class=""> ${response[i].name} </span>
                                        </td>
                                        <td class="col-2 text-center ${classText}">
                                            ${Icon} <span class="">${response[i].status}</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="table-data-feature">
                                                ${redirect}
                                            </div>
                                        </td>
                                    </tr>
                                <tr class="spacer"></tr>
                            `;
                        }
                        $('#ajaxFilterOrder').html(filterOrder);
                    },
                });
            });
        });
    </script>
@endsection
