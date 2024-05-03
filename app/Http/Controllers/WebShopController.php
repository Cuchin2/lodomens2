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
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast\Object_;

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
        $colorSelect = $product->colors()->select('name', 'hex', 'colors.id')
        ->with('images')
        ->get()
        ->map(function ($color) {
            $image = $color->images;
            $url = $image ? $image->url : null;
            return (object) ['name' => $color->name, 'hex' => $color->hex, 'id' => $color->id, 'url' => $url];
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
       /*  dd($imagenes); */
       if($imagenes[$indice]->isEmpty()){
        $firstImage = new \stdClass();
        $firstImage->url = "image/dashboard/No_image_dark.png";
       }
        $product->visit()->withSession(); 
      
        /* foreach ($imagenes as $coleccion) {
            if ($coleccion->isEmpty()) {
                $imagenDefault = new \stdClass();; // Crear una nueva instancia de la clase Image
                $imagenDefault->url = 'image/dashboard/No_image_dark.png'; // Asignar la URL por defecto
                $coleccion->push($imagenDefault); // Agregar la imagen por defecto a la colección
            } 
        }  */  /* dd($imagenes); */
/*         foreach ($imagenes as $coleccion) {
            
                for ($i=0; $i < $colorSelect->count()  ; $i++) { 
                   
            if (!isset($coleccion[$i])) {
                $imagenDefault = new \stdClass(); // Crear una nueva instancia de la clase stdClass
                $imagenDefault->url = 'image/dashboard/No_image_dark.png'; // Asignar la URL por defecto
                $coleccion[$i]=$imagenDefault; // Agregar la imagen por defecto a la colección
            } } 
        } */ 
            return view('web.shop.show',compact('product','colorSelect','imagenes','firstImage','indice','skus'));
    }
    public function getimage(Request $request)
    {
        $image = Image::join('row_image', 'images.id', '=', 'row_image.image_id')
        ->join('rows', 'rows.id', '=', 'row_image.row_id')
        ->where('color_id', $request->colorid)
        ->where('rows.order', $request->row)
        ->where('images.imageable_id', $request->id)
        ->select('images.url') // Seleccionar solo la URL de la imagen
        ->first();
        /* dd($image); */
    if(!$image){
        $image = new \stdClass();
        $image->url = "image/dashboard/No_image_dark.png";
    }
    
    return response()->json(['url' => $image->url]);
    }

}
