<?php

namespace App\Http\Controllers\Transaction;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Adds product to cart.
     */
    public function addToCart(Request $request, $productID)
    {
        $product = Product::find(Product::select('id')->where('id', $productID)->first()->id);
        $productName = Product::select('*')->where('id', $productID)->first()->nameProduct;

        $request->validate([
            'qty' => 'required|numeric|min:1',
        ]);
        if (Cart::select('quantity')->where('userId', '=', auth()->user()->id)->sum('quantity') < 1000) {
            if (Cart::select('productId')->where('productId', $productID)->where('userId', auth()->user()->id)->count() > 0) {
                $cart = Cart::find(Cart::select('id')->where('productId', $productID)->first()->id); //ir buscar o produto do carrinho
               
                if (($product->quantityStock < $cart->quantity + $request['qty'])) {
                    return redirect()->route('product', [$productName, $productID])->with('Failed', 'Only ' . $product->quantityStock . ' in stock - order soon.');
                } else {
                    if ($cart->quantity + $request['qty'] > 100) {
                        return redirect()->route('product', [$productName, $productID])->with('MaxProducts', 'You can only buy 100 ' . $productName);
                    }
                    $cart->quantity = $cart->quantity + $request['qty'];
                    $cart->price = Product::select('*')->where('id', $productID)->first()->price * $cart->quantity;
                    $cart->save();
                }
            } else {
                if ($request['qty'] > 100) {
                    return redirect()->route('product', [$productName, $productID])->with('MaxProducts', 'You can only buy 100 ' . $productName);
                }
                if (($product->quantityStock < $request['qty'])){
                    return redirect()->route('product', [$productName, $productID])->with('Failed', 'Only ' . $product->quantityStock . ' in stock - order soon.');
                }
                $myCart = new Cart();
                $myCart->productId = $productID;
                $myCart->userId = auth()->user()->id;
                $myCart->quantity = $request['qty'];
                $myCart->price = Product::select('price')->where('id', $productID)->first()->price * $myCart->quantity;
                $myCart->save();
            }
            return redirect()->route('product', [$productName, $productID])->with('Success', 'Added ' . $request['qty'] . ' ' . $productName . ' to your cart');
        }
        return redirect()->route('product', [$productName, $productID])->with('MaxProductsCart', 'You can only have 1000 products in your cart');
    }

    /**
     * Allows user to access the list of products in his cart.
     */
    public function myCart()
    {
        $productsCart = DB::table('products')
            ->join('carts', 'carts.productId', '=', 'products.id')
            ->select('carts.*', 'products.*')
            ->where('carts.userId', '=', auth()->user()->id)
            ->get();

        $countCart = Cart::select('quantity')->where('userId', '=', auth()->user()->id)->sum('quantity');
        $countWishlist = Wishlist::select('*')->where('userId', '=', auth()->user()->id)->count();
        $categories = Category::all();

        $shipping = 5;
        $priceTotal = Cart::select('price')->where('userId', '=', auth()->user()->id)->sum('price');
        return view('myCart', compact('countWishlist', 'countCart', 'productsCart', 'priceTotal', 'shipping', 'categories'));
    }

    /**
     * Deletes product from cart.
     */
    public function deleteOfCartProduct($userId, $productID)
    {
        Cart::select('*')->where('productId', $productID)->where('userId', auth()->user()->id)->forceDelete();

        return redirect()->route('myCart');
    }
}
