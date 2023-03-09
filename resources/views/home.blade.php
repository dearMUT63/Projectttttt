@extends('layouts.user')

@section('content')
    @php
        use App\Models\Product;
        $products = Product::all();
    @endphp
    <main class="my-1">
        <div class="container">
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-12 col-lg-3 col-md-12 col-md-6 mb-4">
                        <div class="text-center">
                            <div class="card" style="height: 100%">
                                <a href="{{ asset('images/' . $product->product_image) }}"
                                    data-fancybox="images_{{ $product->id }}">
                                    <img class="card-img-top" src="{{ asset('images/' . $product->product_image) }}"
                                        alt=""
                                        style="object-fit:cover; width: auto !important; height: 200px !important; max-width:100%;">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title mb-3">{{ $product->product_name }}</h5>
                                    <h6 class="mb-3">{{ number_format($product->product_price, 2) }}</h6>
                                    <p class="card-text">{{ $product->product_description }}</p>
                                    <form action="{{ route('cart.store') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <div style="text-align:center">
                                            <button type="submit" class="btn btn-primary">Add to cart</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
@endsection
