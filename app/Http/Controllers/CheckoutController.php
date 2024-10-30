<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;
use App\Models\Address;
use App\Models\DeliveryOrder;
use App\Models\SaleOrder;
use App\Models\Setting;
use App\Models\Shipping;
use App\Models\Sku;
use Cart;
class CheckoutController extends Controller
{
    public function index(Request $request)
    {    if (!session('can_checkout')) {
                return redirect()->back();
            }
            // Elimina la variable de sesión para evitar reutilización


        $user = auth()->user(); $form1= null ; $form2 = null;  $on = null;
        $getCity= null;   $getCity2= null;
        $getDistrit= null;        $getDistrit2= null;
        $getState= null;        $getState2= null;
        $getCountry= null;
        $username = config('services.geonames.username');
        $response = Http::get("http://api.geonames.org/countryInfoJSON?lang=es&username=$username");
        $getCountry = collect($response->json()['geonames'])->map(function($country) {
            return [
                'code' => $country['countryCode'],
                'name' => $country['countryName'],
            ];
        });
        $form1= SaleOrder::where(['user_id'=>$user->id,'status'=>'CREATE'])->first();

        if($form1){
        $address = collect(['name'=>'', 'description'=>$form1->address, 'reference'=> $form1->reference]);

        $response = Http::get("http:/api.geonames.org/searchJSON?country=$form1->country&lang=es&username=$username");
        $countryId=$response->json()['geonames'][0]['countryId'];
        $getState = Http::get("http:/api.geonames.org/childrenJSON?geonameId=$countryId&lang=es&username=$username")->json()['geonames'];
        $getCity = Http::get("http:/api.geonames.org/childrenJSON?geonameId=$form1->state&lang=es&username=$username")->json()['geonames'];
        $getDistrit = Http::get("http:/api.geonames.org/childrenJSON?geonameId=$form1->city&lang=es&username=$username")->json()['geonames'];

        $form2= $form1->deliveryOrders;
        } else {
            $address = Address::where(['user_id'=>$user->id,'current'=>1])->first();
        }
        $on = $form1->delivery ?? 0;
        if($on !== 0)
        {    $address2 = collect(['name'=>'', 'description'=>$form2->address, 'reference'=> $form2->reference]);
            $response2 = Http::get("http:/api.geonames.org/searchJSON?country=$form2->country&lang=es&username=$username");
            $countryId2=$response2->json()['geonames'][0]['countryId'];
            $getState2 = Http::get("http:/api.geonames.org/childrenJSON?geonameId=$countryId2&lang=es&username=$username")->json()['geonames'];
            $getCity2 = Http::get("http:/api.geonames.org/childrenJSON?geonameId=$form2->state&lang=es&username=$username")->json()['geonames'];
            $getDistrit2 = Http::get("http:/api.geonames.org/childrenJSON?geonameId=$form2->city&lang=es&username=$username")->json()['geonames'];
        } else { $address2 = $address;}

        /* session()->forget('can_checkout'); */
        return view('web.cart.checkout',compact('address','address2','user','form1','form2','getState','getCity','getDistrit','getCountry','on','getState2','getCity2','getDistrit2'));
    }
    public function pays(Request $request){
        $skus=$this->reserve();
        $id=$request->id;
        if (!session('pay')) {
            return redirect()->route('web.shop.cart.index');
        }
        // Elimina la variable de sesión para evitar reutilización

        $formToken = $this->generateFormToken();
        $sessionToken = $this->generateSessionToken();
        $preferenceId = $this->generatePreferenceId();
        Session::put('reserve', true);
        return view('web.cart.pay',compact('formToken','sessionToken','preferenceId','id','skus'));
    }
    public function topay(Request $request){
        Session::put('totality', $request->total);
        Session::put('pay', true);
        $state=SaleOrder::find($request->order_id);
        $state->shipping_id=$request->state;
        $state->save();
        return redirect()->route('web.shop.checkout.pay',['id'=>$request->id]);
    }

    public function create(CheckoutRequest $request){
       // formulario #1
        $saleOrder = SaleOrder::updateOrCreate(
            ['status' => 'CREATE', 'user_id' => $request->user_id],
            [
                'name' => $request->name,
                'last_name' => $request->last_name,
                'business' => $request->business,
                'document_type' => $request->document_type,
                'dni' => $request->dni,
                'phone'=> $request->phone,
                'email'=>$request->email,
                'country' => $request->country,
                'address' => $request->address,
                'reference' => $request->reference,
                'city' => $request->city,
                'state' => $request->state,
                'district' => $request->district,
                'zip_code' => $request->zip_code,
                'total' => $request->total,
                'currency'=> session('location') == 'PE' ? 'PEN' : 'USD',
                'delivery'=>$request->otra == 'true' ? 1 : 0,

                //'shipping_id'=> 0
            ]
        );
        if($request->otra == 'true'){
            if($saleOrder->status == 'CREATE'){
                DeliveryOrder::updateOrCreate(
               ['order_id' => $saleOrder->id],
               [
                   'name' => $request->name2,
                   'last_name' => $request->last_name2,
                   'country' => $request->country2,
                   'address' => $request->address2,
                   'reference' => $request->reference2,
                   'city' => $request->city2,
                   'state' => $request->state2,
                   'district' => $request->district2,
               ]
           );
             }
        } else{
            DeliveryOrder::updateOrCreate(
                ['order_id' => $saleOrder->id],
                [
                    'name' => $request->name,
                    'last_name' => $request->last_name,
                    'country' => $request->country,
                    'address' => $request->address,
                    'reference' => $request->reference,
                    'city' => $request->city,
                    'state' => $request->state,
                    'district' => $request->district,
                ]
            );
            /* DeliveryOrder::where('order_id', $saleOrder->id)->delete(); */
        }
        /* session()->forget('can_checkout'); */
        /* return redirect()->back(); */
    /* return redirect()->route('web.shop.checkout.pay'); */
    Session::put('shipping', true);
    $id=$saleOrder->id;
    return redirect()->route('web.shop.checkout.shipping',['id'=>$id]);

    }
    public function shipping(Request $request)
    {
        $id = $request->id;

        // Verificar si la sesión 'shipping' está presente
        if (!session('shipping')) {
            return redirect()->back();
        }

        // Verificar si la colección de Shipping está vacía
        $shipping =  Shipping::all();

        if ($shipping->isEmpty()) {
            $empty= true;
            return view('web.cart.shipping',compact('empty'));
        }
        // Agrupar los métodos de envío por estado
        $shippingByState = $shipping->groupBy('state');

        // Encontrar la orden de venta y cargar la relación de envío
        $sale_order = SaleOrder::with('shipping')->with('deliveryOrders')->find($request->id);

        // Mapeo de estados
        $stateMapping = [
            'district' => 1,
            'nacional' => 2,
            'internacional' => 3,
        ];

        // Determinar el estado abierto
        $open = isset($sale_order->shipping->state) ? $stateMapping[$sale_order->shipping->state] : 1;
        $dolar=Setting::find(2)->action ?? 1;
        // Manejo del envío basado en la ubicación de la sesión
        if ($sale_order->deliveryOrders->country === 'PE' /* session('location') === 'PE' */) {
            $collectionState1 = $shippingByState->get('district', collect())->sortBy('order');
            $collectionState2 = $shippingByState->get('nacional', collect())->sortBy('order');
            $currency = 'PEN';

            return view('web.cart.shipping', compact('collectionState1', 'collectionState2', 'sale_order', 'open', 'id','dolar'));
        } else {
            $collectionState3 = $shippingByState->get('internacional', collect())->sortBy('order');
            $currency = 'USD';
            return view('web.cart.shipping', compact('collectionState3', 'sale_order', 'open', 'id','dolar'));
        }
    }

    /* Izipay */
    private function generateFormToken(){

        $auth= base64_encode(config('services.izipay.client_id').':'.config('services.izipay.secret'));
        $response= Http::withHeaders([
             'Authorization' => "Basic $auth",
             'Content-Type' => 'application/json',
        ])->
        post(config('services.izipay.url'),[
            'amount'  => session('totality')*100,
            'currency' => 'PEN',
            'orderId'  => Str::random(20),
            'customer' => [
                'email' => auth()->user()->email,
            ],
        ])->json();

        return $response['answer']['formToken'];
    }
    /* Niubiz */
    private function generateSessionToken(){
        $auth= base64_encode(config('services.niubiz.user').':'.config('services.niubiz.password'));
        $accessToken=Http::withHeaders([
            'Authorization' => "Basic $auth",
        ])->get(config('services.niubiz.url_api').'/api.security/v1/security')
        ->body();

        $sessionToken=Http::withHeaders([
            'Authorization' => $accessToken,
            'Content-Type' => 'application/json',
        ])
        ->post(config('services.niubiz.url_api').'/api.ecommerce/v2/ecommerce/token/session/'.config('services.niubiz.merchant_id'),[
            'channel'=>'web',
            'amount'=> session('totality'),
            'antifraud'=>[
                'clientIp' => request()->ip(),
                'merchantDefineData' => [
                    'MDD4' => auth()->user()->email,
                    'MDD21' =>0,  // Refiera 0 a si nunca compró, 1 si ha comprado antes
                    'MDD32' => auth()->id(),
                    'MDD75' =>'Registrado',
                    'MDD77' => now()->diffInDays(auth()->user()->created_at)+1,
                ],
            ],
        ])->json();
        return $sessionToken['sessionKey'];
    }
    /* MercadoPago */
    public function generatePreferenceId(){
        MercadoPagoConfig::setAccessToken(config('services.mercadopago.token'));
        $price = session('totality');
        $price = str_replace(',', '.', $price);  $price = (float) $price; $price = number_format($price, 2, ',', '');
        $price = (float) $price;

        $client = new PreferenceClient();
            $preference = $client->create([
            "items"=> [
                [
                "title" => "Total",
                "quantity" => 1,
                "unit_price" => $price
                ]
                ],
            "back_urls" => [
                'success' =>/*  route("paid.mercadopago") */ route('web.shop.gracias'),
            ],
            "notification_url" => 'https://webhook.site/07ad52bf-6f41-459d-a4d5-feeff2a26f80' /* route('notifications.mercadopago') */,
            ]);
        return $preference->id;
    }
    public function reserve()
    {
        // Obtener los elementos del carrito
        $items = Cart::instance('cart')->content();
        // Crear una nueva instancia temporal 'temp_reservation'
        Cart::instance('temp_reservation')->destroy(); // Limpiar la instancia antes de usarla

        // Clonar cada elemento de 'cart' a 'temp_reservation'
        foreach ($items as $item) {
            Cart::instance('temp_reservation')->add(
                $item->id,
                $item->name,
                $item->qty,
                $item->price,
                $item->options->toArray() // Clonar opciones si hay
            );
        }
        $skus = [];
        // Iterar sobre los items del carrito
        foreach ($items as $key=>$item) {
            // Obtener el sku desde el item
            $skuCode = $item->options->sku;

            // Buscar el SKU en la base de datos
            $sku = Sku::where('code', $skuCode)->first();

            // Restar la cantidad de la columna 'stock'
            $sku->stock -= $item->qty;
            if($sku->stock == 0){
                $skus[$key] =$item;
            }
            // Guardar los cambios
            $sku->save();
        }

        return $skus;
    }
}
