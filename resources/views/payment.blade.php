@extends('layouts.app')
@section('title')
Online shopping | Payment Successfull
@endsection
@section('content')

<div class="bodyPayment">
<h1>Payment Successfully Completed <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
    <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
  </svg></h1>
<p>Thank you for making the payment! Your order will be processed soon.</p>
<p>Details of your order sent by email</p>

<p> or visit <a href="{{ route('myOrders',Auth::user()->nickname) }}">My orders</a> to view the history of your orders.</p>
<p><a href="/"><button class="buttonPaymentBack">Back to home page</button></a></p>
</div>
@endsection