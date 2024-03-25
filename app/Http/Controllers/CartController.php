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
    public function removeItemCart($rowId)
    {
        Cart::instance('cart')->remove($rowId);
        return redirect()->route('cart.index');
    }
}
