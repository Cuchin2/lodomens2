<?php
use App\Models\SaleDetail;
use App\Models\SaleOrder;
     function checkoutPay(){
        $user=auth()->user();
        $cartItems = Cart::instance('cart')->content();
        $order = SaleOrder::where(['user_id'=>$user->id,'status'=>'CREATE'])->first();
        foreach ($cartItems as $item) {
            SaleDetail::create([
                'order_id' => $order->id, // Reemplaza 'orderId' con el ID de la orden correspondiente
                'name'=>$item->name,
                'slug'=> $item->options->sku,
                'qtn'=>$item->qty,
                'sell_price'=>$item->price,
                'sku'=>$item->options->sku,
                'color'=>$item->options->color,
                'color_id'=>$item->options->color_id,
                'productImage'=>$item->options->productImage,
            ]);
        }
        $order->status = 'PAID';
        $order->save();
        Cart::instance('cart')->destroy();
        Cart::instance('cart')->store($user->id);
    }
