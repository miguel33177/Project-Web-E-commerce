<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Residence;

class ResidenceController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    /**
     * Function to add residence 
     * @param Request $request
     * @return mixed
     */
    public function addResidence(Request $request)
    {

        $request->validate([
            'city' => ['required', 'string'],
            'address' => ['required', 'string'],
            'postalCode' => ['required', 'string', 'max:9'],
            'country' => ['required']
        ]);
        $residence = new Residence();
        $residence->userId = auth()->user()->id;
        $residence->address = $request['address'];
        $residence->city = $request['city'];
        $residence->postalCode = $request['postalCode'];
        $residence->country = $request['country'];
        $residence->save();
        return redirect()->route('addResidence', auth()->user()->name)->with('success', 'Residence added.');
    }
    /**
     * 
     * Function to delete residence
     * @param mixed $nameUser
     * @param mixed $idResidence
     * @return mixed
     */
    public function deleteResidence($nameUser, $idResidence)
    {

        Residence::select('*')->where('id', '=', $idResidence)->delete();

        return redirect()->route('addResidence', $nameUser)->with('success', 'Residence deleted successfully');
    }
    /**
     * Function to display all residences created by the user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function myResidences()
    {
        $id = auth()->user()->id;
        $residence = Residence::select('*')->where('userId', '=', $id)->paginate(2);
        $countWishlist = Wishlist::select('*')->where('userId', '=', auth()->user()->id)->count();
        $countCart = Cart::select('quantity')->where('userId', '=', auth()->user()->id)->sum('quantity');
        return view('addResidence', compact('residence', 'countWishlist', 'countCart'));
    }

}
