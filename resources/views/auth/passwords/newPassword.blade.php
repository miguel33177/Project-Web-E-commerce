@extends('layouts.app')

@section('content')
<div id="breadcrumb" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <h3 class="breadcrumb-header">Reset Password</h3>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                    
                    @elseif ($message = Session::get('failed'))
                    <div class="alert alert-danger">
                        <p>{{ $message }}</p>
                    </div>
                    @else
                    @endif
                    <form method="POST" action="{{ route('updatePassword') }}">
                        @csrf
                        @method('PUT')


                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end" id="LabelInput">{{ __('Current Password') }}</label>

                            <div class="col-md-6">
                                <input id="oldpassword" type="password" class="input" class="form-control @error('password') is-invalid @enderror" name="oldpassword">

                                @error('oldpassword')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="newpassword" class="col-md-4 col-form-label text-md-end" id="LabelInput">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="input" class="form-control @error('password') is-invalid @enderror" name="password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="confirmpassword" class="col-md-4 col-form-label text-md-end" id="LabelInput" >{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="confirmpassword" type="password" class="input" class="form-control @error('password') is-invalid @enderror" name="confirmpassword">

                                @error('confirmpassword')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="buttonRegister">
                                    {{ __('Update Password') }}
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