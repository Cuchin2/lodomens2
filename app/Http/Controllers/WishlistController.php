<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
class WishlistController extends Controller
{
    public function index()
    {   if(auth()->user()){
        Cart::instance('wishlist')->destroy();
        Cart::instance('wishlist')->restore(auth()->user()->id);
    }
        return view('web.cart.wishlist');
    }
}