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
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{


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
            return view('myProfile', compact('user', 'userProducts', 'photoExists', 'countWishlist', 'countCart', 'countReviews', 'reviewAverage'));
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
    /**
     * Allows user to view seller reviews and access to links that allow you to check the profile of the person who commented.
     * @param mixed $sellerId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function reviewsSeller($sellerId)
    {
        if (auth()->check()) {
            $countCart = Cart::select('quantity')->where('userId', '=', auth()->user()->id)->sum('quantity');
            $countWishlist = Wishlist::select('*')->where('userId', '=', auth()->user()->id)->count();
            $reviews = DB::table('reviews')
                ->join('users', 'users.id', 'reviews.userId')
                ->select('users.nickname', 'reviews.*')
                ->where('reviews.sellerId', $sellerId)
                ->paginate(4);
            $countReviews = Review::select('*')->where('userId', auth()->user()->id)->where('sellerId', $sellerId)->count();
            return view('reviewsSeller', compact('countCart', 'countWishlist', 'sellerId', 'reviews', 'countReviews'));
        }
        $reviews = DB::table('reviews')
            ->join('users', 'users.id', 'reviews.userId')
            ->select('users.nickname', 'reviews.*')
            ->where('reviews.sellerId', $sellerId)
            ->paginate(4);
        $countReviews = Review::select('*')->where('sellerId', $sellerId)->count();
        return view('reviewsSeller', compact('sellerId', 'countReviews', 'reviews'));
    }

    /**
     * Allows user to review a seller.
     * @param Request $request
     * @param mixed $sellerId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function addReviewsSeller(Request $request, $sellerId)
    {
        $request->validate([
            'review' => ['required', 'min:0', 'max:10'],
            'comment' => ['required', 'string']
        ]);

        $review = new Review();
        $review->userId = auth()->user()->id;
        $review->sellerId = $sellerId;
        $review->review = $request['review'];
        $review->comment = $request['comment'];
        $review->save();

        $countCart = Cart::select('quantity')->where('userId', '=', auth()->user()->id)->sum('quantity');
        $countWishlist = Wishlist::select('*')->where('userId', '=', auth()->user()->id)->count();
        $reviews = DB::table('users')
            ->join('reviews', 'reviews.userId', 'users.id')
            ->select('users.nickname', 'reviews.*')
            ->where('reviews.sellerId', $sellerId)
            ->paginate(4);
        $countReviews = Review::select('*')->where('userId', auth()->user()->id)->where('sellerId', $sellerId)->count();
        return view('reviewsSeller', compact('countCart', 'countWishlist', 'sellerId', 'reviews', 'countReviews'));
    }
}
