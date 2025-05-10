<?php

namespace App\Http\Controllers;
use App\Models\Store;
use App\Models\Sku;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function skus(Store $store)
{
    $skus = $store->skus()
        ->with(['product.material', 'product.type.images', 'product.images', 'color', 'brand.images', 'category'])
        ->get()
        ->map(function ($sku) {
            return [
                'id' => $sku->id,
                'sku' => $sku->code,
                'name' => optional($sku->product)->name ?? 'N/A',
                'slug' => optional($sku->product)->slug ?? 'N/A',
                'stock' => $sku->pivot->stock ?? 0, // ← este es el stock de la tienda (pivot)
                'price' => $sku->sell_price,
                'brand' => optional($sku->brand)->name ?? 'N/A',
                'brandimg' => optional($sku->brand->images)->url ?? 'image/dashboard/No_image_dark.png',
                'category' => optional($sku->category)->name ?? 'N/A',
                'color' => optional($sku->color)->name ?? 'N/A',
                'type' => optional(optional($sku->product)->type)->name ?? 'N/A',
                'hex' => optional(optional($sku->product)->type)->hex ?? 'N/A',
                'material' => optional(optional($sku->product)->material)->name ?? 'N/A',
                'img' => optional(optional($sku->product)->type->images)->url ?? 'N/A',
                'image' => optional($sku->product->images->where('color_id', $sku->color_id)->first())->url ?? 'image/dashboard/No_image_dark.png',
            ];
        });

    return response()->json([
        'store_id' => $store->id,
        'store_name' => $store->name,
        'skus' => $skus,
    ]);
}
public function all(){
            $skus = Sku::with(['product', 'color', 'category', 'brand'])
        ->get()
        ->map(function ($sku) {
            return [
                'id' => $sku->id,
                'sku' => $sku->code,
                'name' => $sku->product ? $sku->product->name : 'N/A',
                'slug' =>$sku->product ? $sku->product->slug : 'N/A',
                'stock'=> $sku->stock ?? 0,
                'price' => $sku->sell_price,
                'brand'=> $sku->brand ? $sku->brand->name :'N/A',
                'brandimg' => $sku->brand->images ? $sku->brand->images->url : 'image/dashboard/No_image_dark.png',
                'category' => $sku->category ? $sku->category->name : 'N/A',
                'color' => $sku->color ? $sku->color->name : 'N/A',
                'type' => $sku->product ? $sku->product->type->name : 'N/A',
                'hex' => $sku->product->type ? $sku->product->type->hex : 'N/A',
                'material' => $sku->product && $sku->product->material
                    ? $sku->product->material->name
                    : 'N/A',
                'img'=>$sku->product->type->images ? $sku->product->type->images->url :'N/A',
                'image' => optional($sku->product->images->where('color_id', $sku->color_id)->first())->url ?? 'image/dashboard/No_image_dark.png',
            ];
        });

        $stores= Store::all();
    return view('admin.shop.inventory',compact('skus','stores'));
}
}
