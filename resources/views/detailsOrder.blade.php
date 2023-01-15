@extends('layouts.app')
@section('title')
Online shopping | Order details
@endsection
@section('content')
    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <h3 class="breadcrumb-header">Order</h3>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
<div>
    <table class="table" id="table">
        <caption></caption>
        <thead>
            <tr>
                <th scope="col">Qty</th>
                <th scope="col">Name Product</th>
                <th scope="col">Price</th>
                <th scope="col">PDF</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ $product->nameProduct }}</td>
                    <td>€ {{ $product->priceTotal - $shipping }}</td>
                    <td> <form method="POST" action="{{route('downloadPdf', $product->id)}}">
                        @csrf
                        <button type="submit" class="buttonDelete">Baixar PDF</button>
                    </form></td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <table class="table" id="table">
        <caption></caption>
       <th>
        <tbody>
            <tr>
                <td><b>Sub-Total</b></td>
                <td>€ {{ $product->priceTotal - $shipping }}</td>
            </tr>
            <tr>
                <td><b>Shipping</b></td>
                <td>€ 5</td>
            </tr>
            <tr>
                <td><b>Total Price</b></td>
                <td>€ {{ $product->priceTotal }}</td>
            </tr>
        </tbody>
    </th>
    </table>

  <div class="shipToOrder"style="background-color: rgb(237, 240, 242)"> 
    <caption></caption>
    <h4>Ship to</h4>
    @foreach($orders as $order)
    <p>{{$order->address}}</p>
    <p>{{$order->city}} {{$order->country}}</p>
    <p>{{$order->postalCode}}</p>
    @endforeach
  </div>
</div>
@endsection
