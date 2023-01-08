@extends('layouts.app')
@section('title')
Online shopping | My cart
@endsection
@section('content')
    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <h3 class="breadcrumb-header">My Cart</h3>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    @if ($message = Session::get('failed'))
    <div class="alert alert-danger" id="alert">
        <p>{{ $message }}</p>
    </div>
    @endif

    <section class="h-100 h-custom">
        <div class="container ">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-8" id="productsCart">
                    @foreach ($productsCart as $products)
                        <div class="row mb-4 d-flex justify-content-between align-items-center" id="productsDIV">
                            <div class="col-md-2 col-lg-2 col-xl-2" id="product">
                                <img class="img-fluid rounded-3" src="{{ $products->photo }}" class="img img-responsive" width='110' height='110' alt="{{$products->nameProduct}}">
                            </div>
                            <div class="col-md-3 col-lg-3 col-xl-3" id="product">
                                <h5 class="text-black mb-0">{{ $products->nameProduct }}</h5>
                            </div>
                            <div class="col-md-3 col-lg-3 col-xl-2 d-flex" id="product">
                                <p id="quantity" type="number" name="quantity">
                                    {{ $products->quantity }}</p>
                                </button>
                            </div>
                            <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1" id="product">
                                <h6 class="mb-0">{{ $products->price * $products->quantity }}€</h6>
                            </div>
                            <form action="{{ route('deleteOfCartProduct', [Auth::user()->name, $products->productId]) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <div id="product">
                                    <button class="primary-btn order-submit">Delete product</button>
                                </div>
                            </form>
                        </div>
                        <hr class="new12">
                    @endforeach

                </div>
                <div class="col-md-4 order-details" id="da">
                    <div class="section-title text-center">
                        <h3 class="title" id="yourOrder">Your Order</h3>
                    </div>
                    <div class="order-summary">
                        <div class="order-col">
                            <div><strong>PRODUCT</strong></div>
                            <div><strong>TOTAL</strong></div>
                        </div>
                        @foreach ($productsCart as $products)
                            <div class="order-products">
                                <div class="order-col">
                                    <div>{{ $products->quantity }}x {{ $products->nameProduct }}</div>
                                    <div>€ {{ $products->price }}</div>
                                </div>
                            </div>
                        @endforeach
                        <div class="order-col">
                            <div>Shipping</div>
                            <div><strong>€ {{ $shipping }}</strong></div>
                        </div>
                        <div class="order-col">
                            <div><strong>TOTAL</strong></div>
                            <div><strong class="order-total">€ {{ $priceTotal + $shipping }}</strong></div>
                        </div>
                    </div>
                    <div class="payment-method">
                        <div class="input-radio">
                            <input type="radio" name="payment" id="payment-1">
                            <label for="payment-1">
                                <span></span>
                                If you have Promotional Code
                            </label>
                            <div class="caption">
                                <input type="text" placeholder="Enter your code" class="inputCart">
                            </div>
                        </div>
                    </div>
                    <a href={{ route('checkout')}} class="primary-btn order-submit">Checkout</a>
                </div>
            </div>
        </div>
    </section>
@endsection
