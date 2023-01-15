@extends('layouts.app')
@section('title')
Online shopping | My wishlist
@endsection
@section('content')
    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <h3 class="breadcrumb-header">My Wishlist</h3>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- SECTION -->
    <div class="section" id="sectionWishlist">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- shop -->
               
                @foreach ($myWishlist as $wishlists)
                    <div class="col-md-3 col-xs-6">
                        <div class="product">
                            <div class="product-img">
                                <img src="{{ asset($wishlists->photo) }}" class="img img-responsive" alt="Photo Product"/>
                                <div class="product-label">
                                    <span class="new">NEW</span>
                                </div>
                            </div>
                            <div class="product-body">
                                <p class="product-category">{{ $wishlists->category }}</p>
                                <h3 class="product-name"><a
                                        href="{{ route('product', [$wishlists->nameProduct, $wishlists->productId]) }}">{{ $wishlists->nameProduct }}</a>
                                </h3>
                                <h4 class="product-price">{{ $wishlists->price }} €</h4>


                                <form action="{{ route('deleteOfWishlist', [Auth::user()->name, $wishlists->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="product-btns">
                                        <button class="quick-view"><i><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                    height="16" fill="currentColor" class="bi bi-x-lg"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
                                                </svg></i><span class="tooltipp">remove of wishlist</span></button>
                                    </div>
                                </form>


                            </div>


                            <div class="add-to-cart">
                                <button class="add-to-cart-btn"><i><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                            height="16" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
                                            <path
                                                d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                                        </svg></i> add to cart</button>
                            </div>
                        </div>
                    </div>
                @endforeach
                {!! $myWishlist->links('pagination::bootstrap-4') !!}

                <!-- /shop -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->
@endsection
