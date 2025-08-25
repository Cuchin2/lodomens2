<?php

namespace App\Http\Controllers;
use App\Models\Store;
use App\Models\Sku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
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
public function sales(){
     return view('admin.shop.sales');
}
public function salesDraken(){
    return view('admin.shop.salesdraken');
}
public function stock(Request $request)
{
    DB::beginTransaction();
    $detalles = $request->detalles;
    $productosNoDisponibles = [];
    $storeId = $request->store_id ?? null;

    try {
        // Validar stock y preparar lista de productos no disponibles
        foreach ($detalles as $item) {
            $sku = Sku::where('code', $item['sku'])
                ->where('stock', '>=', $item['quantity'])
                ->first();

            if (!$sku) {
                $skuInfo = Sku::where('code', $item['sku'])->first();
                $productosNoDisponibles[] = [
                    'name' => $skuInfo->product->name ?? 'N/A',
                    'code' => $skuInfo['code'],
                    'image' => optional($skuInfo->product->images->where('color_id', $skuInfo->color_id)->first())->url ?? 'image/dashboard/No_image_dark.png',
                    'available' => $skuInfo?->stock ?? 0,
                    'hex' => $skuInfo->product->type ? $skuInfo->product->type->hex : 'N/A',
                    'img' => $skuInfo->product->type->images ? $skuInfo->product->type->images->first()->url : 'N/A',
                    'required' => $item['quantity']
                ];
                continue;
            }

            // Restar stock general del SKU
            Sku::where('id', $sku->id)
                ->where('stock', '>=', $item['quantity'])
                ->decrement('stock', $item['quantity']);

            // Si se proporciona store_id, restar stock en la tienda específica
            if ($storeId) {
                $store = $sku->stores()->where('store_id', $storeId)->first();

                if ($store && $store->pivot->stock >= $item['quantity']) {
                    // Restar stock en la tienda
                    $newStock = $store->pivot->stock - $item['quantity'];
                    $sku->stores()->updateExistingPivot($storeId, ['stock' => $newStock]);
                } else {
                    // Si no hay suficiente stock en la tienda, agregar a productos no disponibles
                    $productosNoDisponibles[] = [
                        'name' => $sku->product->name ?? 'N/A',
                        'code' => $sku->code,
                        'image' => optional($sku->product->images->where('color_id', $sku->color_id)->first())->url ?? 'image/dashboard/No_image_dark.png',
                        'available' => $store ? $store->pivot->stock : 0,
                        'hex' => $sku->product->type ? $sku->product->type->hex : 'N/A',
                        'img' => $sku->product->type->images ? $sku->product->type->images->first()->url : 'N/A',
                        'required' => $item['quantity']
                    ];
                }
            }
        }

        // Si hay productos sin stock, retornar respuesta estructurada
        if (!empty($productosNoDisponibles)) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Stock insuficiente para algunos productos',
                'unavailable_products' => $productosNoDisponibles
            ], 422);
        }

        DB::commit();
        return response()->json([
            'success' => true,
            'message' => 'Venta registrada con éxito'
        ]);

    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json([
            'success' => false,
            'message' => 'Error en el servidor',
            'error' => $e->getMessage()
        ], 500);
    }
}
public function restock(Request $request)
{
    DB::beginTransaction();
    $detalles = $request->detalles;

    try {
        foreach ($detalles as $item) {
            $sku = Sku::where('code', $item['sku'])->first();
            if ($sku) {
                // Incrementar stock general
                $sku->increment('stock', $item['quantity']);

                // Verificar si también debe actualizar stock en la tabla pivote
                if ($request->has('store_id')) {
                    $storeId = $request->store_id;
                    $store = $sku->stores()->where('store_id', $storeId)->first();

                    if ($store) {
                        $newStock = $store->pivot->stock + $item['quantity'];
                        $sku->stores()->updateExistingPivot($storeId, ['stock' => $newStock]);
                    }
                }
            }
        }

        DB::commit();
        return response()->json([
            'success' => true,
            'message' => 'Stock restaurado correctamente'
        ]);
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json([
            'success' => false,
            'message' => 'Error al restaurar el stock',
            'error' => $e->getMessage()
        ], 500);
    }
}
    public function show($id,$store_id)
    {
        $store=Store::find($store_id); /* gamarra.lodomens.com */
        $response = Http::get("https://{$store->domain}/api/apisale/{$id}");
        $order = $response->json(); // Initialize $order to null or an empty array in case of API failure
        // Pass the $order data (or null if API call failed) to your Blade view
        return view('admin.saledash.show', compact('order'));
    }
}
