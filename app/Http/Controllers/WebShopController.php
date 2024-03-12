<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Image;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class WebShopController extends Controller
{
    public function index(){
        $products = Product::with('reviews')->get();
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
    $colorSelect = $product->colors()->select('name', 'hex', 'colors.id')->get()->map(function ($color) {
        return (object) ['name' => $color->name, 'hex' => $color->hex, 'id' => $color->id];
    });
    $imagenes = [];
    foreach ($colorSelect as $key => $color) {
        $imagenes2 = $product->images()->where('color_id',$color->id)->join('row_image', 'images.id', '=', 'row_image.image_id')
        ->join('rows', 'rows.id', '=', 'row_image.row_id')
        ->orderBy('rows.order', 'asc')->get();
    $imagenes[$key]= $imagenes2;
    }
        return view('web.shop.show',compact('product','colorSelect','imagenes'));
    }
    public function getimage(Request $request)
    {
        $image = Image::join('row_image', 'images.id', '=', 'row_image.image_id')
    ->join('rows', 'rows.id', '=', 'row_image.row_id')
    ->where('color_id', $request->colorid)
    ->where('rows.order', $request->row)
    ->first();

        return response()->json(['url'=>$image->url]);
    }
}
