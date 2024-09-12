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
        $productId = $product['id'];
        $requestedQuantity = $qtn;
        if(session('location') !== 'PE')
        { $price = $skus['usd']; }
        if($request->choose === 'CART' ){
            // Obtén el ítem del carrito si ya existe
            $cartItem = Cart::instance('cart')->content()->where('id', $productId)->first();
            $currentQtyInCart = $cartItem ? $cartItem->qty : 0;
            // Consulta el stock disponible desde la base de datos
            $stockAvailable = $skus['stock']; // Aquí consultas el stock real del SKU
            if ($cartItem) {
                // Si el producto ya está en el carrito, calcula la nueva cantidad
                $newQty = $cartItem->qty + $requestedQuantity;

                // Verifica si la nueva cantidad excede el stock disponible
                if ($newQty <= $stockAvailable) {
                    // Actualiza la cantidad del producto en el carrito
                    Cart::instance('cart')->update($cartItem->rowId, $newQty);

                    return response()->json([
                        'message' => 'Cantidad actualizada correctamente',
                        'cartItem' => $cartItem,
                    ]);
                } else {
                // Calcula cuántos productos puedes agregar sin exceder el stock
                $availableToAdd = $stockAvailable - $currentQtyInCart;
                Cart::instance('cart')->update($cartItem->rowId, $availableToAdd+$cartItem->qty);
                    return response()->json(['message' => 'No hay suficiente stock disponible']);
                }
            } else {
                // Si el producto no está en el carrito, agrégalo si la cantidad solicitada es menor o igual al stock disponible
                if ($requestedQuantity <= $stockAvailable) {
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

                    return response()->json([
                        'message' => 'Producto agregado correctamente',
                        'cartItem' => $newCartItem,
                    ]);
                } else {
                    return response()->json(['message' => 'No hay suficiente stock disponible']);
                }
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
                'redirect' => route('web.shop.webdashboard.wishlist')
            ]);
        }
    }
}
