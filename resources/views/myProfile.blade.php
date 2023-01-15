@extends('layouts.app')
@section('title')
    Online shopping | My profile
@endsection

@php
    $espaco = str_repeat("&nbsp;", 5);
@endphp
@section('content')
    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <h3 class="breadcrumb-header">My Profile</h3>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>

    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <div class="col-md-4">
                    <!-- Billing Details -->
                    <div class="billing-details">
                        <div class="section-title">
                            <h3 class="title">{{ $user->name }} {{ $user->lastName }} </h3>
                            <div style="padding-top:10px;">
                                <h4><i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                                            <path
                                                d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z" />
                                        </svg></i><a class="review-link" href="{{ route('reviewsSeller', $user->id) }}"> {{ $countReviews }} Review(s) {!! $espaco !!} <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                                            <path
                                                d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z" />
                                        </svg> {{$reviewAverage}} / 10</a></h4>
                                    
                            </div>
                        </div>
                        <div class="form-group">
                            @if ($photoExists == true)
                                <div> <img src="{{ asset($user->photo) }}" class="img img-responsive" alt="Photo Profile"></div>
                            @elseif ($photoExists == false)
                                <img src="{{ URL::asset('assets/img/userLogoDefault.png') }}" class="img img-responsive"
                                    alt="Photo Profile">
                            @else
                            @endif
                        </div>
                    </div>
                </div>
                <div class="dataProfile" style="margin-top: 30px;">


                    <div class="col-md-8 offset-md-3">
                        <div>
                            <h4><i><svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor"
                                        class="bi bi-person" viewBox="0 0 14 14">
                                        <path
                                            d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z" />
                                    </svg></i> {{ $user->nickname }}</h4>
                        </div>
                    </div>
                    <div class="col-md-8 offset-md-3">
                        <div>
                            <h4><i><svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor"
                                        class="bi bi-geo-alt" viewBox="0 0 16 16">
                                        <path
                                            d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z" />
                                        <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                    </svg></i> {{ $user->nationality }}</h4>
                        </div>
                    </div>
                    @if (auth()->check())
                        @if ($user->id != Auth::user()->id)
                            <div class="col-md-8 offset-md-">
                                <div><a href="/chatify/{{ $user->id }}" target="_blank">
                                        <h4><i><svg xmlns="http://www.w3.org/2000/svg" width="23" height="23"
                                                    fill="currentColor" class="bi bi-chat" viewBox="0 0 16 16">
                                                    <path
                                                        d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z" />
                                                </svg></i> Contact seller</h4>
                                    </a></div>
                                <div><a href="{{ route('reviewsSeller', $user->id) }}">
                                        <h4><i><svg xmlns="http://www.w3.org/2000/svg" width="23" height="23"
                                                    fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                                                    <path
                                                        d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z" />
                                                </svg></i> Rate Seller</h4>
                                    </a> </div>
                                
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="section" id="ProductsListed">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title" id="section-title1-newProducts">
                        <h3 class="title">Products listed</h3>
                    </div>
                </div>
                <!-- shop -->
                @foreach ($userProducts as $userProduct)
                    <div class="col-md-3 col-xs-6">
                        <div class="product">
                            <div class="product-img">
                                <img src="{{ asset($userProduct->photo) }}" class="img img-responsive" alt="Photo Product"/>
                                <div class="product-label">
                                    <span class="new">NEW</span>
                                </div>
                            </div>
                            <div class="product-body">
                                <p class="product-category">{{ $userProduct->category }}</p>
                                <h3 class="product-name"><a
                                        href="{{ route('product', [$userProduct->nameProduct, $userProduct->id]) }}">{{ $userProduct->nameProduct }}</a>
                                </h3>
                                <h4 class="product-price">{{ $userProduct->price }} €</h4>


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
                {!! $userProducts->links('pagination::bootstrap-4') !!}

                <!-- /shop -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
@endsection
