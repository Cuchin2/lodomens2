<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Cart;
class CartController extends Controller
{
    public function index()
    {   if(auth()->user()){
        Cart::instance('cart')->destroy();
        Cart::instance('cart')->restore(auth()->user()->id);
    }
        return view('web.cart.shoppingcart');
    }

    public function removeItemCart($rowId)
    {
        Cart::instance('cart')->remove($rowId);
        return redirect()->route('cart.index');
    }
}
