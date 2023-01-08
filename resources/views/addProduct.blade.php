@extends('layouts.app')
@section('title')
Online shopping | Add product
@endsection

@section('content')
<div id="breadcrumb" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <h3 class="breadcrumb-header">Add Product</h3>
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
@elseif ($message = Session::get('Failed'))
<div class="alert alert-warning" id="alert">
    <p>{{ $message }}</p>
</div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@endif
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <div class="col-md-7">
                <!-- Billing Details -->
                <div class="billing-details">
                    <form method="POST" action="{{ route('storeProduct', Auth::user()->name) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name Product') }}</label>

                            <div class="col-md-6">
                                <input id="nameProduct" type="text" class="input" name="nameProduct"></input>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Category') }}</label>

                            <div class="col-md-6">
                                <select class="inputSelectCountry" class="inputSelectCountry" name="category" id="category">
                                    @foreach ($categories as $category)
                                    <option value={{$category->category}}>{{$category->category}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <textarea id="description" type="text" class="input" name="description" style="height: 100px"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Price') }}</label>

                            <div class="col-md-6">
                                <input id="price" placeholder="Amount €" type="number" min="1" class="input" name="price"></input>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('State') }}</label>

                            <div class="col-md-6">
                                <select class="inputSelectCountry" class="inputSelectCountry" name="state" id="state">
                                    <option value="NEW">New</option>
                                    <option value="USED">Used</option>

                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="quantityStock" class="col-md-4 col-form-label text-md-end">{{ __('quantityStock') }}</label>

                            <div class="col-md-6">
                                <input id="quantityStock" type="number" min="1" class="input" name="quantityStock"></input>
                            </div>
                        </div>

                       


                        <div class="form-group">
                            <label for="photo" class="col-md-4 col-form-label text-md-end">{{ __('Choose Photo') }}</label>

                            <div class="col-md-6">
                                <label class="custom-file-upload">
                                    <input type="file" id="photo" name="photo" />
                                    <i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16">
                                            <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                            <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z" />
                                        </svg></i>
                                </label>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="buttonRegister">
                                    {{ __('Add Product') }}
                                </button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection