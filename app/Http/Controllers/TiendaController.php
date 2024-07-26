<?php

namespace App\Http\Controllers;

use App\Models\Sku;
use App\Models\Image;
use App\Models\Brand;
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
            'image'=>$image
        ]));
    }
    public function addcart(Request $request)
    {
        $skus = $request->skus;

        /* dd($skus['product']['name']); */
        $product = $skus['product'];
        $brand=Brand::find($product['brand_id'])->pluck('name');
        $qtn= $request->counts;
        $price = $skus['sell_price'];
        if(session('location') !== 'PE')
        { $price = $skus['usd']; }
        if($request->choose === 'CART' ){
            Cart::instance('cart')->add(
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
            'stock'=> $skus['stock']
            ]
        )->associate('App\Models\Sku');
        if(auth()->user()){
        Cart::instance('cart')->store(auth()->user()->id);}
                return response()->json([
                    'redirect' => route('web.shop.cart.index')
                ]);
        } else {
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
                'stock'=> $skus['stock']
                ]
            )->associate('App\Models\Sku');
            Cart::instance('wishlist')->store(auth()->user()->id);

            return response()->json([
                'redirect' => route('web.shop.webdashboard.wishlist')
            ]);
        }
    }
}
