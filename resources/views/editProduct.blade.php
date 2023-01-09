@extends('layouts.app')
@section('title')
Online shopping | Edit Product
@endsection
@section('content')
<div id="breadcrumb" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <h3 class="breadcrumb-header">Edit Product</h3>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
@if ($message = Session::get('success'))
<div class="alert alert-success" id="alert">
    <p>{{ $message }}</p>
</div>
@endif

@foreach ($product as $products)
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <div class="col-md-7">
                <!-- Billing Details -->
                <div class="billing-details">
                    <form method="POST" action="{{ route('updateMyProducts', [Auth::user()->name, $idProduct]) }}" >
                    @csrf
                    @method('PATCH')
                        <div class="form-group">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name Product') }}</label>

                            <div class="col-md-6">
                                <input id="nameProduct" type="text" class="input" value="{{ $products->nameProduct }}"name="nameProduct"></input>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Category') }}</label>

                            <div class="col-md-6">
                                <select class="inputSelectCountry" class="inputSelectCountry" value="{{ $products->category }}"name="category" id="category">
                                    <option value="Tecnology">Tecnology</option>
                                    <option value="Sport">Sport</option>
                                    <option value="Fashion">Fashion</option>
                                    <option value="Home">Home, Garden</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="input"  value="{{ $products->description }}" name="description"></input>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Price') }}</label>

                            <div class="col-md-6">
                                <input id="price" placeholder="Amount €" type="number" min="1"  value="{{ $products->price }}"class="input" name="price"></input>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('State') }}</label>

                            <div class="col-md-6">
                                <select class="inputSelectCountry" class="inputSelectCountry"  value="{{ $products->state }}"name="state" id="state">
                                    <option value="new">New</option>
                                    <option value="used">Used</option>
                                </select>
                            </div>
                        </div>

                        </div>

        
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="buttonRegister">
                                    {{ __('Edit Product') }}
                                </button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endforeach
@endsection