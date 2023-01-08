@extends('layouts.app')
@section('title')
Online shopping | My orders
@endsection
@section('content')
    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <h3 class="breadcrumb-header">My orders</h3>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>

    @foreach ($order as $orders)
        <div class="myOrders">
            <p> Order number: <b> {{ $orders->id }}</b> </p>
            <p> Date of purchase: <b>{{ $orders->created_at }}</b> </p>
            <p> Total price: <b> € {{ $orders->priceTotal }}</b> </p>
            @if ($orders->paid == 1 )
            <p> Payment: <b> Paid </b> </p>
            @else
            <p> Payment: <b>Unpaid</b> </p>
            @endif
        </div>
        <div class="myOrdersSubClass">
            <a href="{{ route('viewDetailsOrder', $orders->id) }}"> <button class="buttonDetailsOrder"> {{ __('view details') }}</button></a>
        </div>
    @endforeach

@endsection
