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
                            <button onclick="history.back()" class="btn btn-sm btn-outline-success">
                                <i class="zmdi zmdi-long-arrow-left"></i> Back
                            </button>
                        </div>
                        <div class="table-data__tool-right">
                            <button class="btn btn-success">
                                CSV download
                            </button>
                        </div>
                    </div>
                    @if (count($orders) != 0)
                    <div class="bg-white p-4 col-5 rounded">
                        <h3><i class="fa fa-sticky-note" aria-hidden="true"></i> Order Info</h3>
                        <div class="row mt-4">
                            <div class="col-1">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <i class="fa fa-barcode" aria-hidden="true"></i>
                                <i class="fa fa-clock-o" aria-hidden="true"></i>
                                <i class="fa fa-usd" aria-hidden="true"></i>
                            </div>
                            <div class="col">
                                <p>Name</p>
                                <p>OrderCode</p>
                                <p>OrderDate</p>
                                <p>Total</p>
                            </div>
                            <div class="col">
                                <p>{{$orderTotal->name}}</p>
                                <p>{{$orderTotal->orderCode}}</p>
                                <p>{{$orderTotal->created_at->format('Y-M-d')}}</p>
                                <p>{{$subTotal + 3000}} MMK</p>
                            </div>
                        </div>
                    </div>
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th class="text-center">Product Name</th>
                                        <th class="text-center">Single Price</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-center">Total Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $item)
                                    <tr>
                                        <td class="col-4 text-center py-3">
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
                                        <td class="col-3 text-center py-3">{{ $item->price }} MMK</td>
                                        <td class="col-1 text-center py-3">{{ $item->qty }}</td>
                                        <td class="col-3 text-center py-3">{{ $item->total }} MMK</td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                    @endforeach
                                    <tr>
                                        <td class=" text-right" colspan="3">
                                           <p>Sub Total</p>
                                           <p>Delivery Fees</p>
                                        </td>
                                        <td class="text-center" colspan="3">
                                            <p>{{$subTotal}} MMK</p>
                                            <p>3000 MMK</p>
                                         </td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                    <tr>
                                        <td class=" text-right" colspan="3">
                                            <p>Total</p>
                                         </td>
                                         <td class="text-center" colspan="3">
                                            <p>{{$subTotal + 3000}} MMK</p>
                                          </td>
                                    </tr>
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
