@extends('user.layout.master')

@section('title')
    <title>Order Details</title>
@endsection

@section('contents')
    <!-- Cart Start -->
    <div class="container-fluid" style="min-height: 50vh;">
        <div class="row px-xl-5">
            <div class="col-lg-8 offset-2 table-responsive mb-5">
                <div class="mb-3">
                    <button onclick="history.back()" class="btn btn-outline-warning">
                        <i class="zmdi zmdi-long-arrow-left"></i> Back
                    </button>

                </div>
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Product Name</th>
                            <th>Single Price</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    @if (count($orders) != 0)
                        <tbody class="align-middle">
                            @foreach ($orders as $item)
                                <tr>
                                    <td class="align-middle">
                                        <div class="d-flex align-items-center offset-3">
                                            <div class="">
                                                <img src="{{ asset('storage/' . $item->image) }}" width="50"
                                                    height="50">
                                            </div>
                                            <div class="ml-3">
                                                {{ $item->name }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">{{ $item->price }} MMK</td>
                                    <td class="align-middle">{{ $item->qty }}</td>
                                    <td class="align-middle">{{ $item->total }} MMK</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                                <td class="align-middle font-weight-bold">
                                    <span>Sub Total</span> <br>
                                    <span>Deilvery Fees</span>
                                </td>
                                <td>
                                    <span>{{$subTotal}} MMK</span> <br>
                                    <span>3000 MMK</span>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <span>Total</span>
                                </td>
                                <td>
                                    <span>{{$subTotal + 3000}} MMK</span>
                                </td>
                            </tr>
                        </tbody>
                    @endif
                </table>
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
