<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Image;
use App\Models\Product;
use App\Models\Category;
use App\Models\Color;
use App\Models\Sku;
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
    public function show(Product $product,Color $color){
        $color_name=$color->name;
        $colorSelect = $product->colors()->select('name', 'hex', 'colors.id')->get()->map(function ($color) {
            return (object) ['name' => $color->name, 'hex' => $color->hex, 'id' => $color->id];
        });
        $imagenes = []; $skus= [];
        foreach ($colorSelect as $key => $color1) {
            $imagenes2 = $product->images()->where('color_id',$color1->id)->join('row_image', 'images.id', '=', 'row_image.image_id')
            ->join('rows', 'rows.id', '=', 'row_image.row_id')
            ->orderBy('rows.order', 'asc')->get();
        $imagenes[$key]= $imagenes2;
        $skus[$key]= Sku::where(['product_id'=>$product->id,'color_id'=>$color1->id])->first();
        }
        $indice = $colorSelect->search(function ($item) use ($color_name){
            return $item->name === $color_name;
        });
        $firstImage = $imagenes[$indice]->first();


        $product->visit()->withSession();
            return view('web.shop.show',compact('product','colorSelect','imagenes','firstImage','indice','skus'));
    }
    public function getimage(Request $request)
    {

        $image = Image::join('row_image', 'images.id', '=', 'row_image.image_id')
            ->join('rows', 'rows.id', '=', 'row_image.row_id')
            ->where('color_id', $request->colorid)
            ->where('rows.order', $request->row)
            ->where('images.imageable_id', $request->id) // Agrega esta línea
            ->first();

                return response()->json(['url'=>$image->url]);
    }

}
