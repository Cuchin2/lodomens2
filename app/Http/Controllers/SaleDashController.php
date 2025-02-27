<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sku;
use App\Models\SaleDashOrder;
use App\Models\SaleDashDetail;
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
                    'image' => optional($sku->product->images->where('color_id', $sku->color_id)->first())->url ?? 'image/dashboard/No_image_dark.png',
                ];
            });
        return view('admin.saledash.create', compact('skus'));
    }

    public function store(Request $request)
    {
        $client= $request->cliente;
        $order = new SaleDashOrder();
            $order->user_id = auth()->user()->id; // Asumiendo que estás autenticando usuarios
            $order->status = 'entregado';
            $order->currency = 'PEN';
            $order->total = $client['total'];
            $order->name = $client['name'];
            $order->phone = $client['phone'];
            $order->dni = $client['doc'];
            $order->save();
            foreach ($request->detalles as $detail) {
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

    }


    public function show(string $id)
    {
        return view(view: 'admin.saledash.show');
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
