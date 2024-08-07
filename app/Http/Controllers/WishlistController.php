<?php

namespace App\Http\Controllers;
use App\Models\SaleOrder;
use Illuminate\Http\Request;
use Cart;
class WishlistController extends Controller
{
    public function index()
    {   if(auth()->user())
        {
        Cart::instance('wishlist')->destroy();
        Cart::instance('wishlist')->restore(auth()->user()->id);
        }
        return view('web.cart.wishlist');
    }
    public function profile()
    {
        return view('web.dashboard.profile');
    }
    public function address()
    {
        return view('web.dashboard.address');
    }
    public function purchase(Request $request)
    {
        $order_user= SaleOrder::where('user_id',auth()->user()->id)->where('status','PAID')->latest()->first();
        return view('web.dashboard.purchase',['open'=>($request->open ?? ''),'order_last'=>($order_user->id ?? '')]);
    }
    public function account(Request $request)
    {
        return view('web.dashboard.account',[
            'request' => $request,
            'user' => $request->user(),
        ]);
    }
}
