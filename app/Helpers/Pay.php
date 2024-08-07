<?php
use App\Models\SaleDetail;
use App\Models\SaleOrder;
use Illuminate\Support\Facades\Http;
use App\Mail\Gracias;
use Illuminate\Support\Facades\Mail;

     function checkoutPay(){
        $user=auth()->user();
        $cartItems = Cart::instance('cart')->content();
        $order = SaleOrder::where(['user_id'=>$user->id,'status'=>'CREATE'])->first();
        $district = $order->district;
        //cambiar datos de API de ubicaciones a strings
                $username = config('services.geonames.username');
                $lugar = Http::get("http://api.geonames.org/get?geonameId=$district&lang=es&username=$username");
                $lugar= $lugar->body();
                $xml = new \SimpleXMLElement($lugar);
               /* dd((string) $xml->adminName3); */
                    $order->country = (string) $xml->countryName;
                    $order->state =(string) $xml->adminName1;
                    $order->city=(string) $xml->adminName2;
                    $order->district=(string) $xml->name;
                    $order->save();
        if($order->deliveryOrders){
                $deliverOrder=$order->deliveryOrders;
                $district2= $deliverOrder->district;
                $lugar2 = Http::get("http://api.geonames.org/get?geonameId=$district2&lang=es&username=$username");
                $lugar2= $lugar2->body();
                $xml2 = new \SimpleXMLElement($lugar2);
                $deliverOrder->country = (string) $xml2->countryName;
                $deliverOrder->state =(string) $xml2->adminName1;
                $deliverOrder->city=(string) $xml2->adminName2;
                $deliverOrder->district=(string) $xml2->name;
                $deliverOrder->save();
                // fin de pruebas
            }
        //fin de cambias ubicaciones
        foreach ($cartItems as $item) {
            SaleDetail::create([
                'order_id' => $order->id, // Reemplaza 'orderId' con el ID de la orden correspondiente
                'name'=>$item->name,
                'brand'=>$item->options->brand,
                'slug'=> $item->options->slug,
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
        // Enviarn eo correo de Gracias y el detalle de la compra
        $email= $order->email;
        // Enviar correo al cliente
        $data= [
           'email'=>env('MAIL_FROM_ADDRESS'),
           'name'=>env('APP_NAME'),
           'order'=>$order,
           'subject'=>'Gracias por su compra',
           'cartItems'=>$order->saleDetails,
           'shipping'=>$order->shipping,
           'deliveryOrders'=>$order->deliveryOrders,
        ];
       Mail::to($email)->send(new Gracias($data));
        //
        Cart::instance('cart')->destroy();
        Cart::instance('cart')->store($user->id);

    }
