@extends('layouts.user')

@section('content')
    @php
        use App\Models\Product;
        $products = Product::all();
    @endphp

    <div class="row" m-0>
        @foreach ($products as $product)
            <div class="col-12 col-mb-6 col-lg-4 col-xl-3 mb-4">
                <div class="card" style="height: 100%">
                    <div class="text-center">
                        <a href="{{ asset('images/' . $product->product_image) }}" data-fancybox="images_{{ $product->id }}">
                            <img class="card-img-top" src="{{ asset('images/' . $product->product_image) }}" alt=""
                                style="object-fit: cover; width: auto !important; height: 200px !important; max-width:100%;">
                        </a>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->product_name }}</h5>
                        <p class="card-text">
                            {{ $product->product_description }}
                            <br />
                            ราคา {{ number_format($product->product_price, 2) }} บาท
                        </p>
                        <form action="{{route('cart.store')}}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <div style="text-align: right">
                                <button type ="submit" class="btn btn-info text-white">เลือก</button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
