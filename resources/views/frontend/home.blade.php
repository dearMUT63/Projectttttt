<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Verdana, sans-serif;
        }

        .mySlides {
            display: none;
        }

        img {
            vertical-align: middle;
        }

        /* Slideshow container */
        .slideshow-container {
            max-width: 1500px;
            position: relative;
            margin: auto;
            top: -24px;
        }

        /* Caption text */
        .text {
            color: #f2f2f2;
            font-size: 15px;
            padding: 8px 12px;
            position: absolute;
            bottom: 8px;
            width: 100%;
            text-align: center;
        }

        /* Number text (1/3 etc) */
        .numbertext {
            color: #f2f2f2;
            font-size: 12px;
            padding: 8px 12px;
            position: absolute;
            top: 0;
        }

        /* The dots/bullets/indicators */
        .dot {
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 1.6s ease;
        }

        .active {
            background-color: #717171;
        }

        /* Fading animation */
        .fade {
            animation-name: fade;
            animation-duration: 2.6s;
        }

        @keyframes fade {
            from {
                opacity: .4
            }

            to {
                opacity: 1
            }
        }

        /* On smaller screens, decrease text size */
        @media only screen and (max-width: 300px) {
            .text {
                font-size: 11px
            }
        }
    </style>
</head>

</html>
@extends('layouts.user')
@section('content')

    @php
        use App\Models\Product;
        $products = Product::all();
    @endphp
    <main class="my-1">
        <div class="container">
            <div class="row">
                <div class="slideshow-container">

                    <div class="mySlides fade">
                        <div class="numbertext">1 / 3</div>
                        <img src="{{ asset('images/proMenu.png') }}" style="width:100%" >
                    </div>

                    <div class="mySlides fade">
                        <div class="numbertext">2 / 3</div>
                        <img src="{{ asset('images/proMenu2.png') }}" style="width:100%">
                    </div>

                    <div class="mySlides fade">
                        <div class="numbertext">3 / 3</div>
                        <img src="{{ asset('images/proMenu3.png') }}" style="width:100%">
                    </div>

                </div>
                <br>

                <div style="text-align:center">
                    <span class="dot"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                </div>


                <script>
                    let slideIndex = 0;
                    showSlides();

                    function showSlides() {
                        let i;
                        let slides = document.getElementsByClassName("mySlides");
                        let dots = document.getElementsByClassName("dot");
                        for (i = 0; i < slides.length; i++) {
                            slides[i].style.display = "none";
                        }
                        slideIndex++;
                        if (slideIndex > slides.length) {
                            slideIndex = 1
                        }
                        for (i = 0; i < dots.length; i++) {
                            dots[i].className = dots[i].className.replace(" active", "");
                        }
                        slides[slideIndex - 1].style.display = "block";
                        dots[slideIndex - 1].className += " active";
                        setTimeout(showSlides, 3000);
                    }
                </script>


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
                                    <p class="card-text">{{ $product->product_description }}</p>
                                    <h6 class="mb-3">{{ number_format($product->product_price, 2) }}</h6>
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
