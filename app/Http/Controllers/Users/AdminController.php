<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Cart;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
   public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

   /**
    * Admin interface with some links to additional features.
    */
   public function adminView()
   {
      $countWishlist = Wishlist::select('*')->where('userId', '=', auth()->user()->id)->count();
      $countCart = Cart::select('quantity')->where('userId', '=', auth()->user()->id)->sum('quantity');
      
      return view('admin.adminView', compact('countWishlist', 'countCart'));
   }


   /**
    * VIEW of all users in the database, except admin users.
    * Allows admin to ban users.
    * If user is banned, his listed products will be removed from the store (soft deleted).
    * User may appeal for his ban to be lifted.
    */
    public function adminBanUser()
   {
      $countWishlist = Wishlist::select('*')->where('userId', '=', auth()->user()->id)->count();
      $countCart = Cart::select('quantity')->where('userId', '=', auth()->user()->id)->sum('quantity');
      $allUsers = User::select('*')->where('isAdmin', false)->get();
      return view('admin.adminBanUsers', compact('countWishlist', 'countCart', 'allUsers'));
   }

   /**
    * VIEW allows admin to view all products in the database.
    * Allows admin to delete (soft delete) products from the website if he deems them of inappropriate conduct.
    */
   public function adminRemoveProductsView()
   {
      $countWishlist = Wishlist::select('*')->where('userId', '=', auth()->user()->id)->count();
      $countCart = Cart::select('quantity')->where('userId', '=', auth()->user()->id)->sum('quantity');
      $allProducts = DB::table('products')
      ->join('users', 'products.userId', '=', 'users.id')
      ->join('categories', 'categories.id', '=', 'products.categoryId')
      ->select('users.nickname', 'products.*', 'categories.category')
      ->where('products.deleted_at', null)
      ->get();
      return view('admin.adminRemoveProducts', compact('countWishlist', 'countCart','allProducts'));
   }

   /**
    * Allows admin to delete a product from the database if he deems it of innapropriate conduct.
    */
   public function deleteProductsAdmin($idProduct)
   {
      Comment::select('*')->where('idProduct', '=', $idProduct)->forcedelete();
      Wishlist::select('*')->where('productId', '=', $idProduct)->forcedelete();
      

      $data["email"] = "test@gmail.com";
      $data["title"] = "Your product has been removed";
      $data["productName"] = Product::select('*')->where('id', '=', $idProduct)->first()->nameProduct;

      Mail::send('email.emailAdminRemoveProduct', $data, function ($message) use ($data) {
         $message->to($data["email"], $data["email"])
            ->subject($data["title"]);
      });
      Product::select('*')->where('id', '=', $idProduct)->delete();
      return redirect()->route('adminRemoveProductsView')->with('success', 'Product deleted successfully');
   }

   /**
    * Allows admin to ban non-admin users from the database.
    */
   public function deleteUsersAdmin($userId)
   {
      Comment::select('*')->where('userId', '=', $userId)->forcedelete();
      Wishlist::select('*')->where('userId', '=', $userId)->forcedelete();
      Product::select('*')->where('userId', '=', $userId)->delete();
      User::select('*')->where('id', $userId)->delete();


      $data["email"] = "test@gmail.com";
      $data["title"] = "Your Account has been suspended";
     

      Mail::send('email.emailAdminBanUser', $data, function ($message) use ($data) {
         $message->to($data["email"], $data["email"])
            ->subject($data["title"]);
      });

      return redirect()->route('adminBanUser')->with('success', 'User deleted successfully');
   }
}
