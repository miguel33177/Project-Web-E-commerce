<?php

namespace App\Http\Controllers\Transaction;

use App\Models\Cart;
use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Models\Ordered;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Validator;
use Stripe;
use Illuminate\Support\Facades\DB;

class StripePaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    public function paymentStripe()
    {
        return view('stripe');
    }

    /**
     * Verifies Payment details, if payment was successful a register of the order will be created in the database.
     * If successful the user cart will be cleansed.
     */
    public function postPaymentStripe(Request $request)
    {

        $shipping = 5;
        $priceTotal = Cart::select('price')->where('userId', '=', auth()->user()->id)->sum('price') + $shipping;

        $validator = Validator::make($request->all(), [
            'card_no' => 'required',
            'ccExpiryMonth' => 'required',
            'ccExpiryYear' => 'required',
            'cvvNumber' => 'required',
        ]);

        $input = $request->except('_token');

        if ($validator->passes()) {
            $stripe = Stripe::setApiKey(env('STRIPE_SECRET'));

            try {
                $token = $stripe->tokens()->create([
                    'card' => [
                        'number' => $request->get('card_no'),
                        'exp_month' => $request->get('ccExpiryMonth'),
                        'exp_year' => $request->get('ccExpiryYear'),
                        'cvc' => $request->get('cvvNumber'),
                    ],
                ]);

                if (!isset($token['id'])) {
                    return redirect()->route('stripe.add.money');
                }

                $charge = $stripe->charges()->create([
                    'card' => $token['id'],
                    'currency' => 'EUR',
                    'amount' => $priceTotal,
                    'description' => 'wallet',
                ]);

                if ($charge['status'] == 'succeeded') {

                    $order = new Order();
                    $order->userId = auth()->user()->id;
                    $order->residenceId = $request['residenceCheckout'];
                    $order->paid = true;
                    $order->priceTotal = $priceTotal;
                    $order->save();

                    $idLastOrder = Order::find(Order::all()->sortByDesc('created_at')->take(1)->first()->id);  //buscar o ultimo orderId
                    $cart = Cart::select('*')->where('userId', auth()->user()->id)->get();

                    for ($i = 0; $i < Cart::select('*')->where('userId', auth()->user()->id)->count(); $i++) {
                        $orderProducts = new Ordered();
                        $orderProducts->orderId = $idLastOrder->id;
                        $orderProducts->productId = $cart[$i]->productId;
                        $orderProducts->quantity = $cart[$i]->quantity;
                        $orderProducts->save();

                        $product = Product::find(Product::select('id')->where('id', $cart[$i]->productId)->first()->id);
                        $product->quantityStock = $product->quantityStock - $cart[$i]->quantity;
                        $product->save();
                    }
                    $orderId = $idLastOrder->id;
                    Cart::select('*')->where('userId', auth()->user()->id)->forcedelete();
                    return redirect()->route('sendMailWithPDF', $orderId);
                  
                } else {
                    return redirect()->route('checkout')->with('error', 'Money not add in wallet!');
                }
            } catch (Exception $e) {
                return redirect()->route('checkout')->with('error', $e->getMessage());
            } catch (\Cartalyst\Stripe\Exception\CardErrorException $e) {
                return redirect()->route('checkout')->with('error', $e->getMessage());
            } catch (\Cartalyst\Stripe\Exception\MissingParameterException $e) {
                return redirect()->route('checkout')->with('error', $e->getMessage());
            }
        }
    }
}
