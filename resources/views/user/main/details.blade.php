@extends('user.layout.master')

@section('title')
    <title>Details</title>
@endsection

@section('contents')
    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div>
                    <img class="w-100" style="height: 500px;" src="{{ asset('storage/' . $details->image) }}" alt="Image">
                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3>{{ $details->name }}</h3>
                    <div class="d-flex mb-3">
                        <small><i class="fas fa-eye"></i> {{ $details->view_count }}</small>
                    </div>
                    <h3 class="font-weight-semi-bold mb-4">{{ $details->price }} MMK</h3>
                    <p class="mb-4">{{ $details->description }}</p>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-minus rounded-left">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input id="orderCount" type="text" class="form-control bg-secondary border-0 text-center"
                                value="1" disabled>
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-plus rounded-right">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button type="button" id="addCartBtn" class="btn btn-primary px-3 rounded"><i
                                class="fa fa-shopping-cart mr-1"></i> Add To
                            Cart</button>
                    </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also
                Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach ($otherProducts as $otherPizza)
                        <div class="product-item bg-light">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" style="height: 300px;"
                                    src="{{ asset('storage/' . $otherPizza->image) }}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                            class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square"
                                        href="{{ route('home#details', $otherPizza->product_id) }}"><i
                                            class="fas fa-info"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">{{ $otherPizza->name }}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>{{ $otherPizza->price }} MMK</h5>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small>(99)</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->
@endsection

@section('scriptSrc')
    <script>
        $(document).ready(function() {

            var scrolledToBottom = false;

            $(window).scroll(function() {
                if (!scrolledToBottom && $(window).scrollTop() + $(window).height() == $(document)
                    .height()) {
                    // user has scrolled to the bottom of the page for the first time
                    scrolledToBottom = true;
                    $.ajax({
                        type: 'get',
                        url: `{{ route('ajax#ViewCount') }}`,
                        data: {
                            product_id: {{ $details->product_id }},
                        },
                        dataType: 'json',
                        success: function(response) {

                        }
                    });
                }
            });

            $('#addCartBtn').click(function() {
                $.ajax({
                    type: 'get',
                    url: `{{ route('cart#ajax') }}`,
                    data: {
                        quantity: $('#orderCount').val(),
                        product_id: {{ $details->product_id }},
                        user_id: {{ Auth::user()->id }},
                    },
                    dataType: 'json',
                    success: function(response) {
                        window.location.reload();
                    }
                });
            });

        });
    </script>
@endsection
