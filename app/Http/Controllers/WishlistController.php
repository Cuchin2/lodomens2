<?php

namespace App\Http\Controllers;

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
    public function purchase()
    {
        return view('web.dashboard.purchase');
    }
    public function account(Request $request)
    {
        return view('web.dashboard.account',[
            'request' => $request,
            'user' => $request->user(),
        ]);
    }
}
