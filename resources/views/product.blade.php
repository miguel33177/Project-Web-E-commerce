@extends('layouts.app')
@section('title')
    Online shopping | {{ $nameProduct }}
@endsection
@section('content')
    @if ($message = Session::get('Success'))
        <div class="alert alert-success" id="alert">
            <p>{{ $message }}</p>
        </div>
    @elseif ($message = Session::get('Failed'))
        <div class="alert alert-danger" id="alert">
            <p>{{ $message }}</p>
        </div>
    @elseif ($message = Session::get('MaxProducts'))
        <div class="alert alert-warning" id="alert">
            <p>{{ $message }}</p>
        </div>
    @elseif ($message = Session::get('MaxProductsCart'))
        <div class="alert alert-warning" id="alert">
            <p>{{ $message }}</p>
        </div>
    @elseif ($errors->any())
        <div class="alert alert-danger" style="width: 20%; margin-left: 15%;margin-top:1%">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @foreach ($products as $product)
        <!-- SECTION -->
        <div class="section">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- Product main img -->
                    <div class="col-md-5 col-md-push-1">
                        <div class="imgProduct">
                            <div>
                                <img src="{{ asset($product->photo) }}" width='400' height='400'
                                    class="img img-responsive" alt="Photo Product"/>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="product-details">
                            <h2 class="product-name">{{ $product->nameProduct }}</h2>
                            <div>
                                <a class="review-link">{{ $countComments }} Review(s) </a>
                            </div>
                            <div>
                                <h3 class="product-price">{{ $product->price }} € </h3>
                                <span class="product-available">In Stock</span>
                            </div>
                            <p>{{ $product->description }}</p>
                            <span class="product-state">State: {{ $product->state }}</span>

                            <div class="add-to-cart">
                                <form method="POST" action="{{ route('addToCart', $product->id) }}">
                                    @csrf

                                    <div class="qty-label">Qty<div class="input-number">
                                            <input id="qty" type="number" min="1" class="inputQty"
                                                name="qty">
                                        </div>
                                    </div>
                                    <button class="add-to-cart-btn"> <i><svg xmlns="http://www.w3.org/2000/svg"
                                                width="16" height="16" fill="currentColor" class="bi bi-bag"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                                            </svg></i>add to cart</button>
                                </form>
                            </div>
                            @if (Auth::check())
                                @if ($wish == false)
                                    <ul class="product-btns">
                                        <form method="POST"
                                            action="{{ route('addToWishlist', [Auth::user()->id, $product->id]) }}">
                                            @csrf
                                            <button type="submit" class="buttonRegister">
                                                {{ __('Add to Wishlist') }}
                                            </button>
                                        </form>
                                    </ul>
                                @elseif ($wish == true)
                                    <ul class="product-btns">
                                        <form
                                            action="{{ route('deleteOfWishlistinProduct', [Auth::user()->name, $product->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="buttonRegister">
                                                {{ __('Remove from Wishlist') }}
                                            </button>
                                        </form>
                                    </ul>
                                @else
                                @endif
                            @endif

                            <ul class="product-links">
                                <li>Category:</li>
                                <li><a href=" {{ route('category', $product->category) }}">{{ $product->category }}</a>
                                </li>
                            </ul>
                            <ul class="product-links">
                                <li>Sold by:</li>
                                <li><a href="{{ route('myProfile', $userNick) }}">{{ $userNick }}</a></li>
                            </ul>

                        </div>
                    </div>
                    <!-- /Product details -->

                    <!-- Product tab -->
                    <div class="col-md-12">
                        <div id="product-tab">
                            <!-- product tab nav -->
                            <ul class="tab-nav">
                                <li class="active"><a data-toggle="tab" href="#tab1">Description</a></li>
                                <li><a data-toggle="tab" href="#tab2">Details</a></li>
                                <li><a data-toggle="tab" href="#tab3">Reviews</a></li>
                            </ul>
                            <!-- /product tab nav -->

                            <!-- product tab content -->
                            <div class="tab-content">
                                <!-- tab1  -->
                                <div id="tab1" class="tab-pane fade in active">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p>{{ $product->description }}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- /tab1  -->

                                <!-- tab2  -->
                                <div id="tab2" class="tab-pane fade in">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p>{{ $product->description }} {{ $product->description }}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- /tab2  -->

                                <!-- tab3  -->
                                <div id="tab3" class="tab-pane fade in">
                                    <div class="row">
                                        <!-- Reviews -->

                                        <div class="col-md-8">
                                            @foreach ($comments as $comment)
                                                <div id="reviews">
                                                    <ul class="reviews">
                                                        <li>
                                                            <div class="review-heading">
                                                                <h5 class="name">{{ $comment->nickname }}</h5>
                                                                <p class="date">{{ $comment->created_at }}</p>
                                                                <div class="review-rating">Rating:
                                                                    {{ $comment->rating }}/10
                                                                </div>
                                                            </div>
                                                            <div class="review-body">
                                                                <p>{{ $comment->comment }}</p>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endforeach
                                            {!! $comments->links('pagination::bootstrap-4') !!}


                                        </div>
                                        <!-- /Reviews -->

                                        <!-- Review Form -->
                                        <div class="col-md-3">
                                            <div id="review-form">
                                                <form method="POST" action="{{ route('doComments', $product->id) }}">
                                                    @csrf
                                                    <textarea id="comment" name="comment" class="input" placeholder="Your Review"></textarea>
                                                    <div class="input-rating">
                                                        <span>Your Rating: </span>
                                                        <div class="stars">
                                                            <input id="rating" name="rating" min="0"
                                                                max="10" type="number"> /10
                                                        </div>
                                                    </div>
                                                    <button class="primary-btn">Submit</button>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- /Review Form -->
                                    </div>
                                </div>
                                <!-- /tab3  -->
                            </div>
                            <!-- /product tab content  -->
                        </div>
                    </div>
                    <!-- /product tab -->
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /SECTION -->
    @endforeach
@endsection
