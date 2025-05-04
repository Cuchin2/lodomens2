<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sku;
use App\Models\Store;
use App\Models\Transfer;
class TransferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $skus = $this->findSku();
        $stores= Store::all();
        return view('admin.transfer.index',compact('skus','stores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
/*         $request->validate([
            'store' => 'required|exists:stores,id',
            'detalles' => 'required|array',
            'detalles.*.id' => 'required|exists:skus,id',
            'detalles.*.stock' => 'required|integer|min:0',
        ]); */

        $storeId = $request->store;
        $skus = $request->detalles;
    // 1. Crear nueva transferencia
        $transfer = Transfer::create([
            'user_id' => auth()->id(),  // Asegúrate que el usuario esté autenticado
            'store_id' => $storeId,
            'observations' => $request->observations ?? null, // si tienes campo opcional
        ]);
        $updatedItems = [];
        foreach ($skus as $item) {
            $sku = Sku::find($item['id']);

            // Revisamos si ya hay relación con la tienda
            $existing = $sku->stores()->where('store_id', $storeId)->first();

            if ($existing) {
                // Ya existe la relación, sumamos el stock
                $currentStock = $existing->pivot->stock;
                $newStock = $currentStock + $item['quantity'];
                $sku->stores()->updateExistingPivot($storeId, ['stock' => $newStock]);
            } else {
                // No existe la relación, la creamos
                $sku->stores()->attach($storeId, ['stock' => $item['quantity']]);
            }
                    // Opcional: puedes guardar los SKUs que se actualizaron
                $updatedItems[] = [
                    'sku_id' => $sku->id,
                    'stock_added' => $item['quantity'],
                ];
        }

        return response()->json([
            'message' => 'Transferencia registrada y SKUs asignados correctamente.',
            'transfer_id' => $transfer->id,
            'items_updated' => $updatedItems
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function findSku()
    {
        $skus = Sku::with([
            'product.material',
            'product.type.images',
            'product.images',
            'color',
            'category',
            'brand.images',
            'stores' // importante para acceder al stock por tienda
        ])->get()
        ->map(function ($sku) {
            // Stock general menos lo distribuido a tiendas
            $distributedStock = $sku->stores->sum('pivot.stock');
            $realStock = ($sku->stock ?? 0) - $distributedStock;

            return [
                'id' => $sku->id,
                'sku' => $sku->code,
                'name' => optional($sku->product)->name ?? 'N/A',
                'slug' => optional($sku->product)->slug ?? 'N/A',
                'stock' => max($realStock, 0), // evita negativos
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

        return $skus;
    }

}
