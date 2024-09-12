<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Cart;
class CartController extends Controller
{
    public function index()
    {
        return view('web.cart.shoppingcart');
    }
}
