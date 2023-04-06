@extends('user.layout.master')

@section('title')
    <title>Order History</title>
@endsection

@section('contents')
    <!-- Cart Start -->
    <div class="container-fluid" style="min-height: 50vh;">
        <div class="row px-xl-5">
            <div class="col-lg-10 offset-1 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>No.</th>
                            <th>Ordered Time</th>
                            <th>Order Code</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    @if (count($orders) != 0)
                        <tbody class="align-middle">
                            @php
                                $i = ($orders->currentpage() - 1) * $orders->perpage();
                            @endphp
                            @foreach ($orders as $item)
                                <tr>
                                    <td class="align-middle">{{ ++$i }}.</td>
                                    <td class="align-middle">{{ $item->created_at->format('Y - F - d h:i A') }}</td>
                                    <td class="align-middle">{{ $item->orderCode }}</td>
                                    <td class="align-middle">{{ $item->total_price }} MMK</td>
                                    <td class="align-middle @if ($item->status === 'Pending') text-warning
                                    @elseif($item->status === 'Cancelled') text-danger @else text-success @endif">
                                        @if ($item->status === 'Pending')
                                            <i class="far fa-clock mr-2"></i>
                                        @elseif($item->status === 'Cancelled')
                                            <i class="far fa-window-close mr-2"></i>
                                        @else
                                            <i class="fas fa-check mr-2"></i>
                                        @endif {{ $item->status }}
                                    </td>
                                    <td>
                                        <a href="{{route('order#details',$item->orderCode)}}" class="" title="Order Details"><i
                                                class="fas fa-eye text-dark"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @endif
                </table>
                @if (count($orders) == 0)
                    <h3 class="pt-4 pb-5 text-center shadow-sm">You haven't ordered anything yet.</h3>
                @endif
                <div class="mt-3">{{ $orders->appends(request()->query())->onEachSide(1)->links() }}</div>
            </div>
        </div>
    </div>
@endsection

@section('scriptSrc')
    <script>
        $(document).ready(function() {

        });
    </script>
@endsection
