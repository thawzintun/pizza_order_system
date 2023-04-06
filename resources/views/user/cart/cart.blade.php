@extends('user.layout.master')

@section('title')
    <title>Cart</title>
@endsection

@section('contents')
    <!-- Cart Start -->
    <div class="container-fluid" style="min-height: 50vh;">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="align-middle" id="dataTable">
                        @if (count($cart) != 0)
                            @foreach ($cart as $item)
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
                                    <td id="price" class="align-middle">{{ $item->price }} MMK</td>
                                    <td class="align-middle">
                                        <input id="product" type="text"
                                            class="form-control form-control-sm bg-secondary border-0 text-center"
                                            value="{{ $item->product_id }}" hidden disabled>
                                        <div class="input-group quantity mx-auto" style="width: 100px;">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-primary btn-minus">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <input id="newQty" type="text"
                                                class="form-control form-control-sm bg-secondary border-0 text-center"
                                                value="{{ $item->qty }}" disabled>
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-primary btn-plus">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td id="total" class="align-middle">{{ $item->price * $item->qty }} MMK</td>
                                    <td class="align-middle">
                                        <a href='{{ route('cart#delete', $item->cart_id) }}' class="btn btn-sm btn-danger">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                @if (count($cart) == 0)
                    <h3 class="pt-4 pb-5 text-center shadow-sm">There is nothing in cart</h3>
                @endif
            </div>

            <div class="col-lg-4">
                @if (count($cart) != 0)
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                            Summary</span></h5>
                    <div class="bg-light p-30 mb-5">
                        <div class="border-bottom pb-2">
                            <div class="d-flex justify-content-between mb-3">
                                <h6>Subtotal</h6>
                                <h6 id="priceTotal">{{ $priceTotal }} MMK</h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="font-weight-medium">Shipping</h6>
                                <h6 class="font-weight-medium">3000 MMK</h6>
                            </div>
                        </div>
                        <div class="pt-2">
                            <div class="d-flex justify-content-between mt-2">
                                <h5>Total</h5>
                                <h5 id="netPrice">{{ $priceTotal + 3000 }} MMK</h5>
                            </div>
                            <button id="btnOrder" type="button"
                                class="btn btn-block btn-primary font-weight-bold my-3 py-3 rounded" data-bs-toggle="modal"
                                data-bs-target="#orderCheckout">Proceed To
                                Checkout</button>

                            <!-- Modal -->
                            <div class="modal fade" id="orderCheckout" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content rounded">
                                        <div class="modal-header">
                                            <h4 class="modal-title fs-5" id="exampleModalLabel">Order Success</h4>
                                        </div>
                                        <div class="modal-body">
                                            Dear Customer, your order has been placed successfully.
                                        </div>
                                        <div class="modal-footer d-flex justify-content-center">
                                            <button id="success" type="button" class="btn btn-warning rounded"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection

@section('scriptSrc')
    <script>
        $(document).ready(function() {
            $('.btn-plus').click(function() {
                $Qty = Number($(this).parents('tr').find('#newQty').val());
                $product = Number($(this).parents('tr').find('#product').val());
                $price = Number($(this).parents('tr').find('#price').text().replace('MMK', ''));
                $total = $price * $Qty;
                $(this).parents('tr').find('#total').html($total + " MMK");

                $totalPrice = 0;
                $('#dataTable tr').each(function(index, row) {
                    $totalPrice += Number($(row).find('#total').text().replace('MMK', ''));
                })
                $(document).find('#priceTotal').text($totalPrice + " MMK");

                $netPrice = $totalPrice + 3000;
                $(document).find('#netPrice').text($netPrice + " MMK");
                $.ajax({
                    type: 'get',
                    url: `{{ route('cartUpdate#ajax') }}`,
                    data: {
                        updateQty: $Qty,
                        user_id: {{ Auth::user()->id }},
                        product_id: $product,
                    },
                    dataType: 'json',
                });
            });

            $('.btn-minus').click(function() {
                $Qty = Number($(this).parents('tr').find('#newQty').val());
                $product = Number($(this).parents('tr').find('#product').val());
                $price = Number($(this).parents('tr').find('#price').text().replace('MMK', ''));
                $total = $price * $Qty;
                $(this).parents('tr').find('#total').html($total + " MMK");

                $totalPrice = 0;
                $('#dataTable tr').each(function(index, row) {
                    $totalPrice += Number($(row).find('#total').text().replace('MMK', ''));
                })
                $(document).find('#priceTotal').text($totalPrice + " MMK");

                $netPrice = $totalPrice + 3000;
                $(document).find('#netPrice').text($netPrice + " MMK");
                $.ajax({
                    type: 'get',
                    url: `{{ route('cartUpdate#ajax') }}`,
                    data: {
                        updateQty: $Qty,
                        user_id: {{ Auth::user()->id }},
                        product_id: $product,
                    },
                    dataType: 'json',
                });
            });

            $('#btnOrder').click(function() {
                $orderList = [];
                $random = Math.floor(Math.random() * 10001);
                $random2 = Math.floor(Math.random() * 10001);
                $('#dataTable tr').each(function(index, row) {
                    $product = Number($(this).find('#product').val());
                    $Qty = Number($(this).find('#newQty').val());
                    $totalPrice = Number($(this).find('#total').text().replace('MMK', ''));
                    $orderList.push({
                        'user_id': {{ Auth::user()->id }},
                        'product_id': $product,
                        'qty': $Qty,
                        'total': $totalPrice,
                        'orderCode': 'POS' + $random2 + {{ Auth::user()->id }} + $random,
                    });
                })
                console.log($orderList);

                $.ajax({
                    type: 'get',
                    url: `{{ route('orderList#create') }}`,
                    data: Object.assign({}, $orderList),
                    dataType: 'json',
                });
            });

            $('#success').click(function(){
                window.location.href ="{{route('user#home')}}";
            })
        });
    </script>
@endsection
