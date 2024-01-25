<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
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
    // Verificar si la cookie ya ha registrado la vista del producto
    if (!request()->cookie('viewed_product_' . $product->id)) {
        // Incrementar el contador de vistas solo si no se ha registrado la vista anteriormente
        $product->views++;

        // Guardar la cookie para registrar la vista del producto
        $response = new Response(view('web.shop.show', compact('product')));
        $response->cookie('viewed_product_' . $product->id, true, 60*24*365); // Cookie válida por 1 año

        // Guardar el producto actualizado
        $product->save();

        return $response;
    }
       return view('web.shop.show',compact('product'));
    }
}
