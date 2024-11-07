<?php

namespace App\Http\Controllers;

use App\Models\Sku;
use App\Models\Image;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Cart;

class TiendaController extends Controller
{
    public function skus(Request $request,$id,$color)
    {
       $skus = Sku::where(['product_id' => $id, 'color_id' => $color])->with(['product', 'color'])->first();
       if (session('location') !== 'PE') {
        $skus->sell_price = $skus->usd;
       }
       $image=0;
       if($request->name == 'image'){
        $image = Image::join('row_image', 'images.id', '=', 'row_image.image_id')
        ->join('rows', 'rows.id', '=', 'row_image.row_id')
        ->where('color_id', $color)
        ->where('rows.order', 0)
        ->where('images.imageable_id', $id) // Agrega esta línea
        ->first()->url ?? '/image/dashboard/No_image_dark.png';
       }
       return response()->json(([
            'skus'=> $skus,
            'image'=>$image,
        ]));
    }
    public function addcart(Request $request)
    {
        $skus = $request->skus;
        $product = $skus['product'];
        $brand=Brand::find($product['brand_id'])->pluck('name');
        $qtn= $request->counts;
        $price = $skus['sell_price'];
        $requestedQuantity = $qtn;
        $rowId=$this->getRowIdBySku($skus['code']);
        if($rowId){

            $cartCount=Cart::instance('cart')->get($rowId)->qty;

            if($qtn + $cartCount > $skus['stock']){
                $requestedQuantity = $skus['stock']-$cartCount;
            }
            if($requestedQuantity == 0){

                 return response()->json(['message' => 'No hay suficiente stock disponible']);
            }
        }
        if(session(key: 'location') !== 'PE')
        { $price = $skus['usd']; }

        if($request->choose === 'CART' ){
           $newCartItem = Cart::instance('cart')->add(
            $product['id'],
            $product['name'],
            $requestedQuantity,
            $price,
            [
                'productImage' => $request->image ?? 'image/dashboard/No_image_dark.png',
                'brand' => $brand,
                'slug' => $product['slug'],
                'sku' => $skus['code'],
                'color' => $skus['color']['name'],
                'color_id' => $skus['color']['id'],
                'stock' => $skus['stock'],
                'hex' => $request->hex,
                'src' => $request->src,
            ]
        )->associate('App\Models\Sku');
        Cart::instance('cart')->store(auth()->user()->id);
        if($qtn !== $requestedQuantity){
            $unitLabel = $requestedQuantity > 1 ? 'unidades' : 'unidad';
            return response()->json([
                'message' => "No hay suficiente stock disponible. Se agregaron solo {$requestedQuantity} {$unitLabel}.",
                'alert' => true,
            ]);
        } else {
        return response()->json([
            'message' => 'Producto '.$product['name'].' agregado correctamente',
            'cartItem' => $newCartItem,
        ]);
        }
        }

        else {
            Cart::instance('wishlist')->add(
                $product['id'],
                $product['name'],
                $qtn,
                $price,
                ['productImage' => $request->image ?? 'image/dashboard/No_image_dark.png',
                'brand'=> $brand,
                'slug'=> $product['slug'],
                'sku'=> $skus['code'],
                'color'=> $skus['color']['name'],
                'color_id'=> $skus['color']['id'],
                'stock'=> $skus['stock'],
                'hex'=> $request->hex,
                'src'=> $request->src,
                ]
            )->associate('App\Models\Sku');
            Cart::instance('wishlist')->store(auth()->user()->id);

            return response()->json([
                'redirect' => route('web.shop.webdashboard.wishlist'),
                'wishmessage'=>'¿Deseas ir a tu wishlist?'
            ]);
        }
    }
    function getRowIdBySku($skuCode)
        {
            // Recorremos todos los items en el carrito
            foreach (Cart::instance('cart')->content() as $item) {
                // Comparamos el SKU para encontrar el item deseado
                if ($item->options->sku === $skuCode) {
                    return $item->rowId;
                }
            }
            // Retornamos null si no se encuentra el item
            return null;
        }
}
