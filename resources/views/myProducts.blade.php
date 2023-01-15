@extends('layouts.app')
@section('title')
Online shopping | My products
@endsection
@section('content')
<div id="breadcrumb" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <h3 class="breadcrumb-header">My Products</h3>
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

<table class="table" id="tableBanUser">
    <caption></caption>
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Category</th>
            <th scope="col">Price</th>
            <th scope="col">State</th>
            <th scope="col">Location</th>
            <th scope="col">Photo</th>
            <th scope="col">Page Product</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $product->nameProduct }}</td>
            <td>{{ $product->category }}</td>
            <td>{{ $product->price }} € </td>
            <td>{{ $product->state }} </td>
            <td> <img src="{{ asset($product->photo) }}" width='150' height='150' class="img img-responsive" alt="Photo Product"/> </td>
            <td>
                <a href="{{ route('product', [$product->nameProduct,$product->id]) }}">{{ $product->nameProduct}}</a>
            </td>
            <td>
                <a href="{{ route('editProduct', [Auth::user()->name,$product->id]) }}"><button type="submit" class="buttonDelete">Edit</button></a>
            </td>
            <td style="width: 10%">
                <form action="{{ route('deletemyProducts', [Auth::user()->name, $product->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="buttonDelete">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $products->links('pagination::bootstrap-4') !!}
@endsection