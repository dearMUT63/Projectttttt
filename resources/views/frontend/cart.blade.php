@extends('layouts.user')

@section('content')
    @php
        $total = 0;
        $count = 0;
    @endphp
    <div class="container h-100 py-5">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col">
                <div class="card shopping-cart" style="border-radius: 15px;">
                    <div class="card-body text-black">
                        <div class="row">
                            <div class="col-lg-6 px-5 py-4">
                                <h3 class="mb-5 pt-2 text-center fw-bold text-uppercase">Shopping Cart</h3>
                                @foreach ($carts as $cart)
                                    <div class="d-flex align-items-center mb-5">
                                        <div class="flex-shrink-0">
                                            <img src="{{ asset('images/' . $cart->product->product_image) }}"
                                                class="img-fluid" style="width: 150px;" alt="">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <button onclick="remove({{ $cart->product->id }})"
                                                class="float-end text-black"><i class="fas fa-times"></i></button>
                                            <h3>{{ $cart->product->product_name }}</h3>
                                            <h6>{{ $cart->product->product_description }}</h6>
                                            <div class="d-flex align-items-center">
                                                <p class="fw-bold mb-0 me-5 pe-3">Price :
                                                    {{ $cart->product->product_price * $cart->quantity }}</p>
                                                <div class="def-number-input number-input safari_only">
                                                    <button class="btn btn-link px-2"
                                                        onclick="decrement({{ $cart->product->id }})">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                    <label for="">{{ $cart->quantity }}</label>
                                                    <button class="btn btn-link px-2"
                                                        onclick="increment({{ $cart->product->id }})">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        @php
                                            $total += $cart->product->product_price * $cart->quantity;
                                            $count += $cart->quantity;
                                        @endphp
                                    </div>
                                @endforeach
                            </div>
                            <div class="col-lg-6 px-5 py-4">
                                <h3 class="mb-5 pt-2 text-center fw-bold text-uppercase">Payment</h3>

                                <div class="form-outline mb-5">
                                    <hr>
                                    <div class="d-flex justify-content-between mb-4">
                                        <h5 class="text-uppercase">items</h5>
                                        <h5>{{ $count }}</h5>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-between mb-4">
                                        <h5 class="text-uppercase">Total price</h5>
                                        <h5>{{ $total }} THB</h5>
                                    </div>
                                    <hr>
                                </div>
                                <form action="{{ route('cart.checkout') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{!! Auth::user()->id !!}">
                                    <div style="text-align: right;">
                                        <div style="text-align: left; ">
                                            <label for="address">Address</label>
                                            <textarea name="address" id="address" class="form-control" rows="3" required></textarea>
                                        </div>
                                        <div style="text-align: left;">
                                            <label for="tel">Tel</label>
                                            <input name="tel" id="tel" class="form-control" type="text"
                                                required>
                                        </div>
                                        <div class="mt-3">
                                            <button id="checkout" class="btn btn-primary btn-block btn-lg float-end">Check
                                                Out</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function increment(product_id) {
            $.ajax({
                url: '{{ url('api/cart/increment') }}',
                method: 'GET',
                data: {
                    product_id: product_id,
                    user_id: {!! Auth::user()->id !!}
                },
                success: function(response) {
                    if (response.status == "success") {
                        $(`#quantity${product_id}`).html(response.quantity);
                    } else {
                        alert("fail");
                    }
                }
            });
            location.reload();
        }

        function decrement(product_id) {
            $.ajax({
                url: '{{ url('api/cart/decrement') }}',
                method: 'GET',
                data: {
                    product_id: product_id,
                    user_id: {!! Auth::user()->id !!}
                },
                success: function(response) {
                    if (response.status == "success") {
                        $(`#quantity${product_id}`).html(response.quantity);
                    } else {
                        alert("fail");
                    }
                }
            });
            location.reload();
        }

        function remove(product_id) {
            $.ajax({
                url: '{{ url('api/cart/remove') }}',
                method: 'GET',
                data: {
                    product_id: product_id,
                    user_id: {!! Auth::user()->id !!}
                },
                success: function(response) {
                    if (response.status == "success") {} else {
                        alert("fail");
                    }
                }
            });
            location.reload();
        }
    </script>
@endsection
