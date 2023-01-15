<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\Cart;
use App\Models\Category;

class PageController extends Controller
{
    /**
     * Displays view from HomePage, if user is authenticated the page will display extra information.
     * eg. Provides access to his wishlist and cart as well as a counter on the number of items in the respective area.
     */
    public function index()
    {
        $products = Product::latest()->take(4)->get();                             //section New Products - home page
        $productsMostViewed = Product::orderBy('views', 'desc')->take(4)->get();  //section products most viewed - home page
        $product1Collection = Category::find(1);
        $product2Collection = Category::find(2);
        $product3Collection = Category::find(3);
        if (empty(auth()->user()->id)) {
            return view('homePage', compact('products', 'productsMostViewed', 'product1Collection', 'product2Collection', 'product3Collection'));
        } else {
            $countWishlist = Wishlist::select('*')->where('userId', '=', auth()->user()->id)->count();
            $countCart = Cart::select('quantity')->where('userId', '=', auth()->user()->id)->sum('quantity');
            $categories = Category::all();
            return view('homePage', compact('products', 'countWishlist', 'countCart', 'categories', 'productsMostViewed','product1Collection','product2Collection','product3Collection'));
        }
    }

    /**
     * Allows user to open is MyAccount space where he can check some of his personal information 
     * and maybe change some of his data.
     */
    public function myAccount()
    {
        $countCart = Cart::select('quantity')->where('userId', '=', auth()->user()->id)->sum('quantity');
        $countWishlist = Wishlist::select('*')->where('userId', '=', auth()->user()->id)->count();
        $categories = Category::all();
        return view('myAccount', compact('countWishlist', 'countCart', 'categories'));
    }

    /**
     * Shows some information about the company, if user is authenticated then we will render the header with 
     * extra information and some link.
     */
    public function aboutUs()
    {
        if (auth()->check()) {
            $countCart = Cart::select('quantity')->where('userId', '=', auth()->user()->id)->sum('quantity');
            $countWishlist = Wishlist::select('*')->where('userId', '=', auth()->user()->id)->count();
            return view('aboutUs', compact('countWishlist', 'countCart'));
        }
        return view('aboutUs');
    }

    /**
     * Loads products in the page for given category.
     * @param mixed $nameCategory
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function category($nameCategory)
    {

        $categoryId = Category::select('*')->where('category', $nameCategory)->first()->id;
        $products = Product::select('*')->where('categoryId', $categoryId)->paginate(4);
        if (auth()->check()) {
            $countCart = Cart::select('quantity')->where('userId', '=', auth()->user()->id)->sum('quantity');
            $countWishlist = Wishlist::select('*')->where('userId', '=', auth()->user()->id)->count();

            return view('category', compact('products', 'countWishlist', 'countCart', 'nameCategory', 'nameCategory'));
        }
        return view('category', compact('products', 'nameCategory', 'nameCategory'));
    }

    /**
     * Renders some information after you've completed a purchase on the website.
     */
    public function payment()
    {

        $countCart = Cart::select('quantity')->where('userId', '=', auth()->user()->id)->sum('quantity');
        $countWishlist = Wishlist::select('*')->where('userId', '=', auth()->user()->id)->count();
        return view('payment', compact('countCart', 'countWishlist'));
    }

    /**
     * Allows you to search for products on the website search bar.
     */
    public function search(Request $request)
    {
        $query = $request->input('query');
        $results = Product::where('nameProduct', 'like', "%$query%")->get();

        if (auth()->check()) {
            $countCart = Cart::select('quantity')->where('userId', '=', auth()->user()->id)->sum('quantity');
            $countWishlist = Wishlist::select('*')->where('userId', '=', auth()->user()->id)->count();
            return view('search.results', compact('results', 'countWishlist', 'countCart'));
        }
        return view('search.results', compact('results'));
    }
}
