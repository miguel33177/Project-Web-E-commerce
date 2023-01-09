<?php

namespace App\Http\Controllers\Wishlist;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Product;
use App\Models\Cart;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\User;
use App\Models\Comment;

class WishlistController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    /**
     * Function to add products to your wishlist, in addition to checking if the product is already on the wishlist
     * @param mixed $nameUser
     * @param mixed $idProduct
     * @return mixed
     */
    public function addToWishlist($nameUser, $idProduct)
    {
        $wishlist = new Wishlist();
        $wishlist->userId = auth()->user()->id;
        $wishlist->productId = $idProduct;
        // if (Wishlist::where('userId', '=', auth()->user()->id, 'and', 'productId', '=', $wishlist->productId)->count() == 0) {
        if (Wishlist::where('userId', auth()->user()->id)->where('productId', $wishlist->productId)->count() == 0) {
            $wishlist->save();
        } else {
            $productName = Product::select('*')->where('id', $idProduct)->first()->nameProduct;

            return redirect()->route('product', [$productName, $idProduct])->with('failed', 'Product is already on your wishlist');
        }

        $productName = Product::select('*')->where('id', $idProduct)->first()->nameProduct;
        $countWishlist = Wishlist::select('*')->where('userId', '=', auth()->user()->id)->count();
        $countCart = Cart::select('quantity')->where('userId', '=', auth()->user()->id)->sum('quantity');
        $categories = Category::all();
        return redirect()->route('product', [$productName, $idProduct])->with(compact('countWishlist', 'countCart', 'categories'));
    }

    /**
     * Allows user to see the items in his wishlist.
     */
    public function myWishlist()
    {
        $myWishlist = DB::table('products')
            ->join('wishlists', 'wishlists.productId', '=', 'products.id')
            ->join('categories', 'categories.id', 'products.categoryId')
            ->select('wishlists.*', 'products.*','categories.category')
            ->where('wishlists.userId', '=', auth()->user()->id)
            ->paginate(4);
        $countWishlist = Wishlist::select('*')->where('userId', '=', auth()->user()->id)->count();
        $countCart = Cart::select('quantity')->where('userId', '=', auth()->user()->id)->sum('quantity');
        $categories = Category::all();
        return view('myWishlist', compact('myWishlist', 'countWishlist', 'countCart', 'categories'));
    }

    /**
     * Allows user to delete a product from his wishlist when on the wishlist page.
     */
    public function deleteOfWishlist($nameUser, $idProduct)
    {
        Wishlist::select('*')->where('productId', $idProduct)->where('userId', auth()->user()->id)->forceDelete();
        return redirect()->route('myWishlist');
    }

    /**
     * Allows user to delete product from his wishlist when on the product page.
     */
    public function deleteOfWishlistinProduct($nameUser, $idProduct)
    {
        Wishlist::select('*')->where('productId', $idProduct)->where('userId', auth()->user()->id)->forceDelete();

        $products = DB::table('products')
        ->join('categories', 'categories.id', 'products.categoryId')
        ->select('products.*', 'categories.category')
        ->where('products.id', '=', $idProduct)
        ->get();
        $comments = Comment::select('*')->where('idProduct', '=', $idProduct)->paginate(3);
        $countComments = Comment::select('*')->where('idProduct', '=', $idProduct)->count();
        $wish = false;
        if (Wishlist::select('*')->where('productId', $idProduct)->where('userId', auth()->user()->id)->count() > 0) {
            $wish = true;
        }

        $userId = Product::select('*')->where('id', $idProduct)->first()->userId;

        $userNick = User::select('nickname')->where('id', $userId)->first()->nickname;
        $countWishlist = Wishlist::select('*')->where('userId', '=', auth()->user()->id)->count();
        $countCart = Cart::select('quantity')->where('userId', '=', auth()->user()->id)->sum('quantity');
        $categories = Category::all();
        $nameProduct = Product::select('*')->where('id', $idProduct)->first()->nameProduct;

        return view('product', compact('products', 'comments', 'countComments', 'wish', 'userNick', 'countWishlist', 'countCart', 'categories', 'nameProduct'));
    }
}
