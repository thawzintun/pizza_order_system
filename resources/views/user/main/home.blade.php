@extends('user.layout.master')

@section('title')
    <title>Home</title>
@endsection

@section('contents')
    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Categories Start -->
                <h5 class="position-relative text-uppercase mb-3">
                    <span class="pr-3">Filter by category</span>
                </h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="form-check d-flex justify-content-between">
                            <a href='{{ route('user#home') }}' class="form-check-label text-dark text-decoration-none">All
                                Categories</a>
                            <span
                                class="badge text-black border align-self-center font-weight-normal">{{ $categories->count() }}</span>
                        </div>
                        @foreach ($categories as $category)
                            <div class="form-check d-flex mt-2">
                                <a href="{{ route('user#filter', $category->category_id) }}"
                                    class="form-check-label text-dark text-decoration-none">{{ $category->name }}</a>
                            </div>
                        @endforeach
                    </form>
                </div>
                <!-- Categories End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                            </div>
                            <div class="ml-2">
                                <div class="input-group">
                                    <label for="" class="input-group-text rounded-left">Filter By</label>
                                    <select name="sorting" class="form-control rounded-right" id="sortingOption">
                                        <option selected disabled value="">Products</option>
                                        <option value="desc">New</option>
                                        <option value="asc">Old</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <span class="col-12">
                        <div class="row" id="list">
                            @if (count($pizza) != 0)
                                @foreach ($pizza as $item)
                                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                        <div class="product-item bg-light mb-4">
                                            <div class="product-img position-relative overflow-hidden">
                                                <img class="img-fluid w-100" src="{{ asset('storage/' . $item->image) }}"
                                                    alt="" style="height:250px;">
                                                <input id="options" type="text" value="{{ $item->product_id }}" hidden>
                                                <div class="product-action">
                                                    <a class="singleAdd btn btn-outline-dark btn-square"><i
                                                            class="fa fa-shopping-cart"></i></a>
                                                    <a class="btn btn-outline-dark btn-square"
                                                        href="{{ route('home#details', $item->product_id) }}"><i
                                                            class="fas fa-info"></i></a>
                                                </div>
                                            </div>
                                            <div class="text-center py-4">
                                                <a class="h6 text-decoration-none text-truncate"
                                                    href="{{ route('home#details', $item->product_id) }}">{{ $item->name }}</a>
                                                <div class="d-flex align-items-center justify-content-center mt-2">
                                                    <h5>{{ $item->price }} MMK</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-8 offset-2 shadow-sm text-center">
                                    <h2><i class="fas fa-pizza-slice"></i> There're no Products Here <i
                                            class="fas fa-pizza-slice"></i></h2>
                                </div>
                            @endif
                        </div>
                    </span>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
@endsection

@section('scriptSrc')
    <script>
        $(document).ready(function() {
            $('#sortingOption').change(function() {
                $eventOption = $('#sortingOption').val();

                if ($eventOption == 'desc') {
                    $.ajax({
                        type: 'get',
                        url: 'ajax/list',
                        data: {
                            'status': 'desc'
                        },
                        dataType: 'json',
                        success: function(response) {
                            $total = '';
                            for (let i = 0; i < response.length; i++) {

                                productID = response[i].product_id;
                                var productDetailUrl =
                                    "{{ route('home#details', ':parameter') }}".replace(
                                        ':parameter', productID);

                                $total +=
                                    `<div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4">
                                        <div class="product-img position-relative overflow-hidden">
                                            <input id="options" type="text" value="${productID}" hidden>
                                            <img class="img-fluid w-100" src="{{ asset('storage/${response[i].image}') }}" alt=""
                                                style="height:250px;">
                                            <div class="product-action">
                                                <a class="singleAdd btn btn-outline-dark btn-square"><i
                                                        class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href="${productDetailUrl}"><i
                                                        class="fas fa-info"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate" href="">${response[i].name}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>${response[i].price} MMK</h5>
                                            </div>

                                        </div>
                                    </div>
                                </div>`
                            }
                            $('#list').html($total);
                            $('.singleAdd').click(function() {
                                cartProductID = $(this).parent().parent().find('#options').val();
                                cart = $('#cartCount').html();
                                $.ajax({
                                    type: 'get',
                                    url: `{{ route('cart#singleAdd') }}`,
                                    data: {
                                        productID: cartProductID,
                                    },
                                    dataType: 'json',
                                    success: function(response) {
                                        $('#cartCount').html(response);
                                    }
                                })
                            })
                        }
                    });
                } else if ($eventOption == 'asc') {
                    $.ajax({
                        type: 'get',
                        url: 'ajax/list',
                        data: {
                            'status': 'asc',
                        },
                        dataType: 'json',
                        success: function(response) {
                            $pizzaTotal = '';
                            for (let i = 0; i < response.length; i++) {

                                productID = response[i].product_id;
                                var productDetailUrl =
                                    "{{ route('home#details', ':parameter') }}".replace(
                                        ':parameter', productID);

                                $pizzaTotal +=
                                    `<div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4">
                                        <div class="product-img position-relative overflow-hidden">
                                            <input id="options" type="text" value="${productID}" hidden>
                                            <img class="img-fluid w-100" src="{{ asset('storage/${response[i].image}') }}" alt=""
                                                style="height:250px;">
                                            <div class="product-action">
                                                <a class="singleAdd btn btn-outline-dark btn-square"><i
                                                        class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href="${productDetailUrl}"><i
                                                        class="fas fa-info"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate" href="">${response[i].name}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>${response[i].price} MMK</h5>
                                            </div>

                                        </div>
                                    </div>
                                </div>`;
                            }
                            $('#list').html($pizzaTotal);
                            $('.singleAdd').click(function() {
                                cartProductID = $(this).parent().parent().find('#options').val();
                                $.ajax({
                                    type: 'get',
                                    url: `{{ route('cart#singleAdd') }}`,
                                    data: {
                                        productID: cartProductID,
                                    },
                                    dataType: 'json',
                                    success: function(response) {
                                        $('#cartCount').html(response);
                                    }
                                })
                            })
                        }
                    })
                };
            });

            $('.singleAdd').click(function() {
                cartProductID = $(this).parent().parent().find('#options').val();
                $.ajax({
                    type: 'get',
                    url: `{{ route('cart#singleAdd') }}`,
                    data: {
                        productID: cartProductID,
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('#cartCount').html(response);
                    }
                })
            })
        });
    </script>
@endsection
