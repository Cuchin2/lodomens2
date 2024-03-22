<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Cart;
class CartController extends Controller
{
    public function index()
    {
        $cartitems = Cart::instance('cart')->content();
        return view('web.cart.shoppingcart',compact('cartitems'));
    }
    public function addToCart(Request $request)
    {
        $product = Product::find($request->id);
        $price = $product->sell_price ? $product->sale_price : $product->regular_price;
        Cart::instance('cart')->add(
            $product->id,
            $product->name,
            $request->quantity,
            $price,
        )->associate('App\Models\Product');
        return redirect()->back()->with('message','Se agrego un item satisfactoriamente');
    }
}
