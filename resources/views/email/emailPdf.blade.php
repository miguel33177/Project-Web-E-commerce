<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
</head>
<body>
    <h1><b style="color: red;">BMN ONLINE SHOP</b></h1>
    @foreach ($products as $product )
    <h2>Details for your order #{{$product->id}}</h2>
    @endforeach
    <table class="table table-bordered" id="table">
        <caption></caption>
        <thead>
            <tr>
                <th scope="col">Qty</th>
                <th scope="col">Name Product</th>
                <th scope="col">Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ $product->nameProduct }}</td>
                    <td>€ {{ $product->price * $product->quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table class="table table-bordered" id="table">
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

    <div>Ship to:
        @foreach($orders as $order)
        <p>{{$order->address}}</p>
        <p>{{$order->city}} {{$order->country}}</p>
        <p>{{$order->postalCode}}</p>
        @endforeach
    </div>

    <h5>Thank you for your purchase. We appreciate your business and look forward to serving you again in the future.</h5>

</body>
</html>