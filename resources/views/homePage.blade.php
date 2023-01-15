@extends('layouts.app')
@section('title')
Online shopping | Home page
@endsection

@section('content')

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- shop -->
            <div class="col-md-4 col-xs-6">
                <div class="shop">
                    <div class="shop-img">
                        <img src="{{ URL::asset('assets/img/shop01.png')}}" alt="Photo Product">
                    </div>
                    <div class="shop-body">
                        <h3>{{$product1Collection->category}}<br>Collection</h3>
                        <a href=" {{ route('category',$product1Collection->category) }}" class="cta-btn">Shop now <i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
                            <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
                          </svg></i></a>
                    </div>
                </div>
            </div>
            <!-- /shop -->

            <!-- shop -->
            <div class="col-md-4 col-xs-6">
                <div class="shop">
                    <div class="shop-img">
                        <img src="{{ URL::asset('assets/img/shop02.png')}}" alt="Photo Product">
                    </div>
                    <div class="shop-body">
                        <h3>{{$product2Collection->category}}<br>Collection</h3>
                        <a href=" {{ route('category',$product2Collection->category) }}" class="cta-btn">Shop now <i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
                            <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
                          </svg></i></a>
                    </div>
                </div>
            </div>
            <!-- /shop -->

            <!-- shop -->
            <div class="col-md-4 col-xs-6">
                <div class="shop">
                    <div class="shop-img">
                        <img src="{{ URL::asset('assets/img/shop03.png')}}" alt="Photo Product">
                    </div>
                    <div class="shop-body">
                        <h3>{{$product3Collection->category}}<br>Collection</h3>
                        <a href=" {{ route('category',$product3Collection->category) }}" class="cta-btn">Shop now  <i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
                            <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
                          </svg></i></a>
                    </div>
                </div>
            </div>
            <!-- /shop -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->
<div class="section" id="sectionNewProducts">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <div class="section-title" id="section-title1-newProducts">
                    <h3 class="title">New Products</h3>
                </div>
            </div>
            <!-- shop -->
            @foreach ($products as $product)
            <div class="col-md-3 col-xs-6">
                <div class="product">
                    <div class="product-img">
                        <img src="{{ asset($product->photo) }}" class="img img-responsive" width='110' height='110' alt="Photo Product"/>
                        <div class="product-label">
                            <span class="new">{{$product->state}}</span>
                        </div>
                    </div>
                    <div class="product-body">
                        <p class="product-category">{{$product->category}}</p>
                        <h3 class="product-name"><a href="{{ route('product', [$product->nameProduct,$product->id]) }}">{{$product->nameProduct}}</a></h3>
                        <h4 class="product-price">{{$product->price}} €</h4>

                        
                    </div>
                    <div class="add-to-cart">
                        <a href="{{ route('product', [$product->nameProduct,$product->id]) }}">  <button class="add-to-cart-btn"><i><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                          </svg></i> View Product</button></a>
                    </div>
                </div>
            </div>
            @endforeach
          

            <!-- /shop -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>

<div class="section" id="sectionNewProducts">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <div class="section-title" id="section-title1-newProducts">
                    <h3 class="title">Product most viewed</h3>
                </div>
            </div>
            <!-- shop -->
            @foreach ($productsMostViewed as $productMostViewed)
            <div class="col-md-3 col-xs-6">
                <div class="product">
                    <div class="product-img">
                        <img src="{{ asset($productMostViewed->photo) }}" class="img img-responsive" width='110' height='110' alt="Photo Product"/>
                        <div class="product-label">
                            <span class="new">{{$productMostViewed->state}}</span>
                        </div>
                    </div>
                    <div class="product-body">
                        <p class="product-category">{{$productMostViewed->category}}</p>
                        <h3 class="product-name"><a href="{{ route('product', [$productMostViewed->nameProduct,$productMostViewed->id]) }}">{{$productMostViewed->nameProduct}}</a></h3>
                        <h4 class="product-price">{{$productMostViewed->price}} €</h4>

                        
                    </div>
                    <div class="add-to-cart">
                        <a href="{{ route('product', [$productMostViewed->nameProduct,$productMostViewed->id]) }}">  <button class="add-to-cart-btn"><i><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                          </svg></i> View Product</button></a>
                    </div>
                </div>
            </div>
            @endforeach
          
            <!-- /shop -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->
@endsection