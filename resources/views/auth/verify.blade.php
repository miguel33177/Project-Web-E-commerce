@extends('layouts.app')

@section('content')
@if (session('resent'))
    <div  class="alert alert-success" role="alert" style="width: 40%; margin-left:100px;margin-top:10px;">
        {{ __('A fresh verification link has been sent to your email address.') }}
    </div>
    @endif
<div class="textVerify" class="card-header">{{ __('Verify Your Email Address') }}</div>

<div class="card-body">
    <div class="textVerify">
        <p> {{ __('Before proceeding, please check your email for a verification link.') }}
            {{ __('If you did not receive the email') }}
        </p>
    </div>
    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
        @csrf
       <div class="buttonVerify"><button type="submit" class="buttonLogin" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button></div>
    </form>
</div>
@endsection