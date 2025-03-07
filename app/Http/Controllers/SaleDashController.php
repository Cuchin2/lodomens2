<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Sku;
use App\Models\SaleDashOrder;
use App\Models\SaleDashDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Testing\TestResponse;

class SaleDashController extends Controller
{

    public function index()
    {
        return view('admin.saledash.index');
    }


    public function create()
    {
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
                    'img'=>$sku->product->type->images ? $sku->product->type->images->first()->url :'N/A',
                    'image' => optional($sku->product->images->where('color_id', $sku->color_id)->first())->url ?? 'image/dashboard/No_image_dark.png',
                ];
            });
        return view('admin.saledash.create', compact('skus'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        $client = $request->cliente;

        try {
            $detalles = $request->detalles;
            $productosNoDisponibles = [];

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
                        'img'=>$sku->product->type->images ? $skuInfo->product->type->images->first()->url :'N/A',
                        'required' => $item['quantity']
                    ];
                    continue;
                }

                // Restar stock
                Sku::where('id', $sku->id)
                    ->where('stock', '>=', $item['quantity'])
                    ->decrement('stock', $item['quantity']);
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

            // Crear orden y detalles
            $order = new SaleDashOrder();
            $order->user_id = auth()->user()->id;
            $order->status = 'entregado';
            $order->currency = 'PEN';
            $order->total = $client['total'];
            $order->name = $client['name'] ?? 'Desconocido';
            $order->email = $client['email'] ?? '';
            $order->phone = $client['phone'] ?? '';
            $order->dni = $client['doc'] ?? '';
            $order->save();

            foreach ($detalles as $detail) {
                $orderDetail = new SaleDashDetail();
                $orderDetail->name = $detail['name'];
                $orderDetail->brand = $detail['brand'];
                $orderDetail->slug = $detail['slug'];
                $orderDetail->qtn = $detail['quantity'];
                $orderDetail->sell_price = $detail['price'];
                $orderDetail->productImage = $detail['image'] ?? null;
                $orderDetail->category = $detail['category'] ?? null;
                $orderDetail->sku = $detail['sku'] ?? null;
                $orderDetail->color = $detail['color'] ?? null;
                $orderDetail->hex = $detail['hex'] ?? null;
                $orderDetail->src = $detail['src'] ?? null;
                $orderDetail->order_dash_id = $order->id;
                $orderDetail->save();
            }

            DB::commit();
            return response()->json([
                'success' => true,
                'order' => $order,
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


    public function show($id)
    {
        $order=SaleDashOrder::find($id);
        return view('admin.saledash.show',compact('order'));
    }


    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }
}
