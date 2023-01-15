@extends('layouts.app')

@section('content')
    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <h3 class="breadcrumb-header">Admin Interface - Remove Products</h3>
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
    <table class="table table-bordered" id="tableBanUser">
        <caption></caption>
        <thead>
            <tr>
                <th>ID</th>
                <th>Sell By</th>
                <th>Name Product</th>
                <th>Category</th>
                <th>Price</th>
                <th>Remove Product</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($allProducts as $products)
                <tr>
                    <td>{{ $products->id }}</td>
                    <td><a href="{{ route('myProfile', $products->nickname) }}">{{ $products->nickname }}</a></td>
                    <td><a
                            href="{{ route('product', [$products->nameProduct, $products->id]) }}">{{ $products->nameProduct }}</a>
                    </td>
                    <td>{{ $products->category }}</td>
                    <td>€ {{ $products->price }}</td>
                    <td style="width: 10%">
                        <form action="{{ route('deleteProductsAdmin', $products->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="buttonDelete">Delete Product</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
