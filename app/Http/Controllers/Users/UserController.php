<?php

namespace App\Http\Controllers\Users;

use App\Models\Cart;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Models\Residence;
use App\Models\User;
use App\Models\Order;
use App\Models\Ordered;
use App\Models\Wishlist;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    /**
     * Function to return the view where we have the inputs to change the password
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function resetPassword()
    {
        $countWishlist = Wishlist::select('*')->where('userId', '=', auth()->user()->id)->count();
        $countCart = Cart::select('quantity')->where('userId', '=', auth()->user()->id)->sum('quantity');
        $categories = Category::all();
        return view('auth.passwords.newPassword', compact('countWishlist', 'countCart', 'categories'));
    }

    /**
     * Function to check the inputs, and update the password in the database
     * @param Request $request
     * @return mixed
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'oldpassword' => ['required', 'string', 'min:8'],
            'password' => ['required', 'string', 'min:8'],
            'confirmpassword' => ['required', 'same:password']
        ]);

        $user = auth()->user();

        if (Hash::check($request->oldpassword, $user->password)) {
            $request['password'] = Hash::make($request['password']);
            $user->update($request->all());

            return redirect()->route('resetPassword')->with('success', 'Password changed.');
        } else {
            return redirect()->route('resetPassword')->with('failed', 'Error changing password.');
        }
    }
    
}
