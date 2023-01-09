<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Residence;
use App\Models\User;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Models\Wishlist;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Function to display the user's information in the view my Profile and also all the products listed by that user
     * @param mixed $nickUser
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function myProfile($nickUser)
    {
        $user = User::select('*')->where('nickname', $nickUser)->first();
        $userProducts = Product::select('*')->where('userId', $user->id)->paginate(4);
        $photoExists = false;
        $countReviews = Review::select('*')->where('sellerId', $user->id)->count();
        $ratingAverage = Review::select('*')->where('sellerId', $user->id)->avg('review');
        $reviewAverage = number_format($ratingAverage, 0, '.', '');

        if (User::select('photo')->where('nickname', $nickUser)->first()->photo != NULL) {
            $photoExists = true;                                                                //see view to understand
        }
        if (auth()->check()) {
            $countWishlist = Wishlist::select('*')->where('userId', '=', auth()->user()->id)->count();
            $countCart = Cart::select('quantity')->where('userId', '=', auth()->user()->id)->sum('quantity');
            return view('myProfile', compact('user', 'userProducts', 'photoExists', 'countWishlist', 'countCart', 'countReviews','reviewAverage'));
        }
        return view('myProfile', compact('user', 'userProducts', 'photoExists', 'countReviews', 'reviewAverage'));
    }
    /**
     * Function to add profile picture to the user
     * @param Request $request
     * @param mixed $userNick
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function addPhotoProfile(Request $request, $userNick)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png',
        ]);
        $user = User::find(User::select('id')->where('nickname', $userNick)->first()->id);

        $fileName = time() . $request->file('photo')->getClientOriginalName();
        $path = $request->file('photo')->storeAs('images', $fileName, 'public');
        $user->photo = '/storage/' . $path;
        $user->save();
        $countWishlist = Wishlist::select('*')->where('userId', '=', auth()->user()->id)->count();
        $countCart = Cart::select('quantity')->where('userId', '=', auth()->user()->id)->sum('quantity');
        return view('myAccount', compact('countWishlist', 'countCart'));
    }
}
