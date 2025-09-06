<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sku;
use App\Models\Store;
use App\Models\Returnn;
use App\Models\ReturnnDetail;
class ReturnController extends Controller
{
   public function index()
    {
        return view('admin.return.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $skus = $this->findSku();
        $stores= Store::all();
        return view('admin.return.create',compact('skus','stores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $storeId = $request->store;
        $skus = $request->detalles;
    // 1. Crear nueva transferencia
        $transfer = Returnn::create([
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
                $newStock = $currentStock - $item['quantity'];
                $sku->stores()->updateExistingPivot($storeId, ['stock' => $newStock]);
            } else {
                // No existe la relación, la creamos
                $sku->stores()->attach($storeId, ['stock' => $item['quantity']]);
            }
                    // ✅ Asociar a transfer_skus
                $transfer->skus()->attach($sku->id, [
                    'quantity' => $item['quantity'],
                ]);
                    // Opcional: puedes guardar los SKUs que se actualizaron
                $updatedItems[] = [
                    'sku_id' => $sku->id,
                    'stock_added' => $item['quantity'],
                ];
                //Creando detalles
                    $transferDetail = new ReturnnDetail();
                    $transferDetail->name = $item['name'];
                    $transferDetail->brand = $item['brand'];
                    $transferDetail->slug = $item['slug'];
                    $transferDetail->qtn = $item['quantity'];
                    $transferDetail->sell_price = $item['price'];
                    $transferDetail->productImage = $item['image'] ?? null;
                    $transferDetail->category = $item['category'] ?? null;
                    $transferDetail->sku = $item['sku'] ?? null;
                    $transferDetail->color = $item['color'] ?? null;
                    $transferDetail->hex = $item['hex'] ?? null;
                    $transferDetail->src = $item['src'] ?? null;
                    $transferDetail->returnn_id = $transfer->id;
                    $transferDetail->save();
        }

        return response()->json([
            'message' => 'Transferencia registrada y SKUs asignados correctamente.',
            'return_id' => $transfer->id,
            'items_updated' => $updatedItems
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transfer=Returnn::find($id);
        return view('admin.return.show',compact('transfer'));
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
            $distributedStock = $sku->stores->sum('pivot.stock') ?? 0;
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
