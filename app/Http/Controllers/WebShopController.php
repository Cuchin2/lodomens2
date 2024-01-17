<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class WebShopController extends Controller
{
    public function index(){
        $products = Product::all();
        $categories = Category::all();
        $brands = Brand::all();
        return view('web.shop.index',compact('products','categories','brands'));
    }
    public function show(Product $product){
     return view('web.shop.show',compact('product'));
    }
}
