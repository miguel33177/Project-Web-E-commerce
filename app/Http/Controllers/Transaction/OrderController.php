<?php

namespace App\Http\Controllers\Transaction;

use App\Models\Cart;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Allows user to access a list of his past orders, and the option to check the details of a specific order.
     */
    public function myOrders()
    {
        $countWishlist = Wishlist::select('*')->where('userId', '=', auth()->user()->id)->count();
        $countCart = Cart::select('quantity')->where('userId', '=', auth()->user()->id)->sum('quantity');

        $order = DB::table('orders')
            ->join('residences', 'orders.residenceId', '=', 'residences.id')
            ->select('orders.*', 'residences.address')
            ->where('orders.userId', '=', auth()->user()->id)
            ->get();
        $categories = Category::all();
        return view('myOrders', compact('countWishlist', 'countCart', 'order', 'categories'));
    }

    /**
     * Allows user to view detailed information about one of his past orders.
     */
    public function viewDetailsOrder($orderId)
    {
        $countWishlist = Wishlist::select('*')->where('userId', '=', auth()->user()->id)->count();
        $countCart = Cart::select('quantity')->where('userId', '=', auth()->user()->id)->sum('quantity');

        $products = DB::table('ordereds')
            ->join('orders', 'ordereds.orderId', '=', 'orders.id')
            ->join('products', 'products.id', '=', 'ordereds.productId')
            ->select('ordereds.quantity', 'products.nameProduct', 'products.price', 'orders.priceTotal', 'orders.pdf', 'orders.id')
            ->where('ordereds.orderId', '=', $orderId)
            ->get();

        $orders = DB::table('orders')
            ->join('residences', 'orders.residenceId', '=', 'residences.id')
            ->select('orders.*', 'residences.*')
            ->where('orders.id', '=', $orderId)
            ->get();
        $shipping = 5;


        return view('detailsOrder', compact('products', 'countWishlist', 'countCart', 'shipping', 'orders'));
    }

    /**
     * Allows user to download the receipt of his order.
     */
    public function downloadPdf($orderId)
    {
       $pdf= Order::select('*')->where('id', $orderId)->first()->pdf;
        return response()->download($pdf);
    }
}
