@extends('layouts.app')

@section('title')
Online shopping | My Account
@endsection

@section('content')
<div id="breadcrumb" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <h3 class="breadcrumb-header">My Account</h3>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
@if ($errors->any())
    <div class="alert alert-danger" style="width: 20%; margin-left: 15%;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <div class="col-md-6">
                <!-- Billing Details -->
                <div class="billing-details">
                    <div class="section-title">
                        <h3 class="title">Account Details</h3>
                    </div>

                    <div class="form-group">
                        <label for="nickname" class="col-md-4 col-form-label text-md-end">{{ __('Nickname') }}</label>

                        <div class="col-md-6">
                            <p>{{ Auth::user()->nickname }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>

                        <div class="col-md-6">
                            <p>{{ Auth::user()->name }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>

                        <div class="col-md-6">
                            <p>{{ Auth::user()->lastName }}</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                        <div class="col-md-6">
                            <p>{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('addPhotoProfile', Auth::user()->nickname) }}" enctype="multipart/form-data">

                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="photo" class="col-md-4 col-form-label text-md-end">{{ __('Change profile photo') }}</label>

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
                        <button type="submit" class="buttonSubmitPhoto"> Change photo</button>
                    </form>

                </div>
            </div>

            <div class="buttonsMyaccount" class="form-group">
               <div class="col-md-8 offset-md-3">
                    <a href="/resetPassword"> <button class="buttonRegister"> {{ __('Change Password') }}</button></a>
                </div>
               <div class="col-md-8 offset-md-3">
                    <a href="{{ route('addResidence', Auth::user()->name) }}"> <button class="buttonResidence"> {{ __('Add Residence') }}</button></a>
                </div>

               <div class="col-md-8 offset-md-3">
                    <a href="{{ route('myProducts', Auth::user()->name) }}"> <button class="buttonMyProducts"> {{ __('My Products') }}</button></a>
                </div>

               <div class="col-md-8 offset-md-3">
                    <a href="{{ route('myProfile',Auth::user()->nickname) }}"> <button class="buttonMyPerfil"> {{ __('My Profile') }}</button></a>
                </div>

                <div class="col-md-8 offset-md-3">
                    <a href="{{ route('myOrders',Auth::user()->nickname) }}"> <button class="buttonOrders"> {{ __('My Orders') }}</button></a>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection


<!-- melhor meter residence apenas no checkout ou tentar fazer um if caso ja tenha adicionada uma morada aparecer a que esta na base de dados
e um botao caso queiras adicionar nova morada -->