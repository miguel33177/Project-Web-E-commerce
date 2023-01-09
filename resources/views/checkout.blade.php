@extends('layouts.app')
@section('title')
Online shopping | Checkout
@endsection
@section('content')
    <div id="breadcrumb" class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="breadcrumb-header">Checkout</h3>
                </div>
            </div>
        </div>
    </div>

    <div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success" id="alert">
                <p>{{ $message }}</p>
            </div>
        @elseif ($message = Session::get('error'))
        <div class="alert alert-danger" id="alert">
            <p>{{ $message }}</p>
        </div>
        @endif

        <div class="section">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">

                    <div class="col-md-7">
                        <!-- Shiping Details -->
                        <div class="shiping-details">
                            <div class="section-title">
                                <h3 class="title">Shiping address</h3>
                            </div>

                            <div >
                                <h4>My addresses</h4>
                            </div>
                            <div class="section-title">
                                <select class="selectAddress" id="inputSelectCountry" name="residenceCheckout" id="residenceCheckout">
                                    @foreach ($residencesUser as $residence)
                                        <option value="{{ $residence->id }}"> {{ $residence->address }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="input-checkbox">
                                <input type="checkbox" id="shiping-address">
                                <label for="shiping-address">
                                    <span></span>
                                    Ship to a different address?
                                </label>
                                <div class="caption">
                                    <form method="POST" action="{{ route('addResidenceinCheckout', Auth::user()->name) }}">
                                        @csrf
                                        <div class="form-group">

                                            <label for="name" class="col-md-4 col-form-label text-md-end"
                                                c>{{ __('Address') }}</label>

                                            <div class="col-md-6">
                                                <input id="address" type="text" class="input" name="address"></input>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-md-4 col-form-label text-md-end"
                                                id="LabelInput">{{ __('City') }}</label>

                                            <div class="col-md-6">
                                                <input id="city" type="text" class="input" name="city"></input>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="email" class="col-md-4 col-form-label text-md-end"
                                                id="LabelInput">{{ __('Postal Code') }}</label>

                                            <div class="col-md-6">
                                                <input id="postalCode" type="text" class="input"
                                                    name="postalCode"></input>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="col-md-4 col-form-label text-md-end"
                                                id="LabelInput">{{ __('Country') }}</label>
                                            <div class="col-md-6">
                                                <select class="inputSelectCountry" class="inputSelectCountry" name="country"
                                                    id="country">
                                                    <option value="UK">United Kingdom</option>
                                                    <option value="PT">Portugal</option>
                                                    <option value="US">United States</option>
                                                    <option value="FR">French</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-0">
                                            <div class="col-md-8 offset-md-4">
                                                <button type="submit" class="buttonRegister">
                                                    {{ __('Insert Address') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /Shiping Details -->
                    </div>

                    <!-- Order Details -->
                    <div class="col-md-5 order-details">
                        <div class="section-title text-center">
                            <h3 class="title" id="yourOrder">Your Order</h3>
                        </div>
                        <div class="order-summary">
                            <div class="order-col">
                                <div><strong>PRODUCT</strong></div>
                                <div><strong>TOTAL</strong></div>
                            </div>
                            <div class="order-products">
                                @foreach ($productsCart as $products)
                                    <div class="order-products">
                                        <div class="order-col">
                                            <div>{{ $products->quantity }}x {{ $products->nameProduct }}</div>
                                            <div>€ {{ $products->price }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="order-col">
                                <div>Shipping</div>
                                <div><strong>€ {{ $shipping }}</strong></div>
                            </div>
                            <div class="order-col">
                                <div><strong>TOTAL</strong></div>
                                <div><strong class="order-total">€ {{ $priceTotal }}</strong></div>
                            </div>
                        </div>
                        <div class="payment-method">

                           
                            <div class="input-checkbox">
                                <input type="checkbox" name="payment" id="payment-3">
                                <label for="payment-3">
                                    <span></span>
                                    Payment System
                                </label>
                                <div class="caption">
                                    <form class="form-horizontal" method="post" id="payment-form" role="form" action="{!!route('addmoney.stripe')!!}" >
                                        @csrf

                                        <div class="section-title">
                                            <select class="selectAddress" id="inputSelectCountry" name="residenceCheckout" id="residenceCheckout">
                                                @foreach ($residencesUser as $residence)
                                                    <option value="{{ $residence->id }}" {{ ( $residence->id) ? 'selected' : '' }}> {{ $residence->address }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class='control-label' style="margin-left: -15px">Card Number</label>
                                            <input autocomplete='off' class='inputPay' size='20' type='text' name="card_no" style="margin-left:2px;" >
                                        </div>
                                        <div class="row g-3 align-items-center">
                                            <div class="col-auto">
                                                <label class='control-label'>CVV</label>
                                                <input autocomplete='off' class='inputPay' placeholder='  ex. 311' size='4' type='text' name="cvvNumber" >
                                            </div>
                                            <div class="col-auto">
                                                <label class='control-label'>Expiration</label>
                                                <input class='inputPay' placeholder='  MM' size='4' type='text' name="ccExpiryMonth" >
                                            </div>
                                            <div class="col-auto">
                                                <label class='control-label'>Year</label>
                                                <input class='inputPay' placeholder='  YYYY' size='4' type='text' name="ccExpiryYear" >   
                                            </div>
                                        </div>
                                            <button class="primary-btn order-submit" id="payButton" type="submit">Pay</button> 
                                        <div class="mb-3">
                                            <div class='alert-danger alert' style="display:none;">
                                                    Please correct the errors and try again.
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Order Details -->
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>


    </div>
@endsection
