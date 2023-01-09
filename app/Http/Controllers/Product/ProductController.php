<?php

namespace App\Http\Controllers\Product;

use App\Models\Category;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Comment;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{   
    /**
     * Function that returns the addProduct view, where the user can create a product for the shop
     */
    public function addProduct()
    {
        $countWishlist = Wishlist::select('*')->where('userId', '=', auth()->user()->id)->count();
        $countCart = Cart::select('quantity')->where('userId', '=', auth()->user()->id)->sum('quantity');

        return view('addProduct', compact('countWishlist', 'countCart'));
    }
    /**
     * Function to save a product in the database and input checks
     */
    
    public function storeProduct(Request $request)
    {
        if ($request['quantityStock'] > 2147483647) {
            return redirect()->route('addProduct', auth()->user()->name)->with('Failed', 'Limit of stock exceeded!');
        }

        $request->validate([
            'nameProduct' => 'required|string',
            'category' => 'required',
            'description' => 'required|string',
            'price' => 'required|numeric|min:1',
            'state' =>  'required',
            'quantityStock' => 'required|numeric|min:1',
            'photo' => 'required|image|mimes:jpeg,png',

        ]);

        $requestData = $request->all();
        $fileName = time() . $request->file('photo')->getClientOriginalName();
        $path = $request->file('photo')->storeAs('images', $fileName, 'public');
        $requestData["categoryId"] = Category::select('*')->where('category', $request["category"])->first()->id;
        $requestData["photo"] = '/storage/' . $path;
        $requestData["userId"] = auth()->user()->id;
        Product::create($requestData);
        return redirect()->route('addProduct', auth()->user()->name)->with('success', 'Product added.');
    }

    /**
     * Function to validate the inputs and save the comments for each product in the database
     * @param Request $request
     * @param mixed $productID
     * @return mixed
     */
    public function doComments(Request $request, $productID)
    {
        $request->validate([
            'rating' => ['required', 'min:0', 'max:10'],
            'comment' => ['required', 'string']
        ]);
        $comments = new Comment();
        $comments->idProduct = $productID;
        $comments->userId = auth()->user()->id;
        $comments->rating = $request['rating'];
        $comments->comment = $request['comment'];
        $comments->save();

        $productName = Product::select('*')->where('id', $productID)->first()->nameProduct;
        return redirect()->route('product', [$productName, $productID])->with('success', 'Comment added.');
    }

    /**
     * Function to delete your own products, that is the products published by you
     * @param mixed $nameUser
     * @param mixed $idProduct
     * @return mixed
     */
    public function deletemyProducts($nameUser, $idProduct)
    {

        Comment::select('*')->where('idProduct', '=', $idProduct)->forcedelete();
        Wishlist::select('*')->where('productId', '=', $idProduct)->forcedelete();
        Product::select('*')->where('id', '=', $idProduct)->delete();

        return redirect()->route('myProducts', $nameUser)->with('success', 'Product deleted successfully');
    }
    /**
     * Function to edit your own products, that is, the products published by you
     * @param Request $request
     * @param mixed $nameUser
     * @param mixed $idProduct
     * @return mixed
     */
    public function updateMyProducts(Request $request, $nameUser, $idProduct)
    {
        $product = Product::find(Product::select('id')->where('id', $idProduct)->first()->id); //bastava meter o idProduct

        $request->validate([
            'nameProduct' => 'required|string',
            'category' => 'required',
            'description' => 'required|string',
            'price' => 'required|numeric|min:1',
            'state' =>  'required',

        ]);
        $product->nameProduct = $request['nameProduct'];
        $product->categoryId = Category::select('*')->where('category', $request['category'])->first()->id;
        $product->description = $request['description'];
        $product->price = $request['price'];
        $product->state = $request['state'];
        $product->save();

        return redirect()->route('myProducts', $nameUser)->with('success', 'Product updated successfully');
    }
    /**
     * Function to displays product page, comments of product, in addition it increases the number of views of the product.
     * @param mixed $nameProduct
     * @param mixed $idProduct
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function product($nameProduct, $idProduct)
    {
        $products = DB::table('products')
            ->join('categories', 'categories.id', 'products.categoryId')
            ->select('products.*', 'categories.category')
            ->where('products.id', '=', $idProduct)
            ->get();

        $comments = DB::table('comments')
            ->join('products', 'products.id', 'comments.idProduct')
            ->join('users', 'users.id', 'comments.userId')
            ->select('comments.*', 'users.nickname')
            ->where('comments.idProduct', '=', $idProduct)
            ->paginate(4);

        $productViews = Product::find($idProduct);
        $productViews->views = $productViews->views + 1;
        $productViews->save();
        $countComments = Comment::select('*')->where('idProduct', '=', $idProduct)->count();
        if (auth()->check()) {
            $wish = false;
            if (Wishlist::select('*')->where('productId', $idProduct)->where('userId', auth()->user()->id)->count() > 0) {
                $wish = true;
            }
            $userId = Product::select('*')->where('id', $idProduct)->first()->userId;
           
            $userNick = User::select('nickname')->where('id', $userId)->first()->nickname;
            $countWishlist = Wishlist::select('*')->where('userId', '=', auth()->user()->id)->count();
            $countCart = Cart::select('quantity')->where('userId', '=', auth()->user()->id)->sum('quantity');
            return view('product', compact('products', 'comments', 'countComments', 'wish', 'userNick', 'countWishlist', 'countCart', 'nameProduct'));
        }
        
        $userId = Product::select('*')->where('id', $idProduct)->first()->userId;
        $userNick = User::select('nickname')->where('id', $userId)->first()->nickname;
        return view('product', compact('products', 'comments', 'countComments', 'userNick', 'nameProduct'));
    }
    /**
     * Redirect to view editProducts and compact variables that need
     * @param mixed $nameUser
     * @param mixed $idProduct
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function editProduct($nameUser, $idProduct)
    {

        $product = Product::select('*')->where('id', '=', $idProduct)->get();
        $countWishlist = Wishlist::select('*')->where('userId', '=', auth()->user()->id)->count();
        $countCart = Cart::select('quantity')->where('userId', '=', auth()->user()->id)->sum('quantity');
        $categories = Category::all();
        return view('editProduct', compact('idProduct', 'product', 'countWishlist', 'countCart', 'categories'));
    }
    /**
     * Function to display view myProducts. Displays all products advertised by the user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function myProducts()
    {

        $products = DB::table('products')
            ->join('categories', 'categories.id', 'products.categoryId')
            ->select('products.*', 'categories.category')
            ->where('products.userId', '=', auth()->user()->id)
            ->where('products.deleted_at', null)
            ->paginate(3);
        $countWishlist = Wishlist::select('*')->where('userId', '=', auth()->user()->id)->count();
        $countCart = Cart::select('quantity')->where('userId', '=', auth()->user()->id)->sum('quantity');

        return view('myProducts', compact('products', 'countWishlist', 'countCart',));
    }
}
