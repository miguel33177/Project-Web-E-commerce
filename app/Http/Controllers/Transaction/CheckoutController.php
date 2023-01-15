<?php

namespace App\Http\Controllers\Transaction;

use App\Models\Cart;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\Residence;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Redirects user to checkout if he has no items in his cart then he's redirected to his cart.
     */
    public function checkout()
    {
        $productsCart = DB::table('products')
            ->join('carts', 'carts.productId', '=', 'products.id')
            ->select('carts.*', 'products.*')
            ->where('carts.userId', '=', auth()->user()->id)
            ->get();

        $countCart = Cart::select('quantity')->where('userId', '=', auth()->user()->id)->sum('quantity');
        $countWishlist = Wishlist::select('*')->where('userId', '=', auth()->user()->id)->count();
       

        $residencesUser = Residence::select('*')->where('userId', auth()->user()->id)->get();
        $shipping = 5;
        $priceTotal = Cart::select('price')->where('userId', '=', auth()->user()->id)->sum('price') + $shipping;

        if ($priceTotal == $shipping) {
            return redirect()->route('myCart', compact('countWishlist', 'countCart', 'productsCart', 'priceTotal', 'shipping'))->with('failed', 'Your cart is empty!');
        }
        return view('checkout', compact('countCart', 'countWishlist', 'productsCart', 'residencesUser', 'shipping', 'priceTotal'));
    }

    /**
     * Allows user the option to use a different billing address in his checkout which will then be added to his residence list.
     */
    public function addResidenceinCheckout(Request $request)
    {
        $request->validate([
            'city' => ['required', 'string'],
            'address' => ['required', 'string'],
            'postalCode' => ['required', 'string', 'max:9']
        ]);
        $residence = new Residence();
        $residence->userId = auth()->user()->id;
        $residence->address = $request['address'];
        $residence->city = $request['city'];
        $residence->postalCode = $request['postalCode'];
        $residence->country = $request['country'];
        $residence->save();

        return redirect()->route('checkout', auth()->user()->name)->with('success', 'Residence added.');
    }
}
