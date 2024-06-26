<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;
use App\Models\Address;
use App\Models\DeliveryOrder;
use App\Models\SaleOrder;
use Cart;
class CheckoutController extends Controller
{
    public function index(Request $request)
    {    if (!session('can_checkout')) {
                return redirect()->back();
            }
            // Elimina la variable de sesión para evitar reutilización
            session()->forget('can_checkout');

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

        if($form2)
        {   $on = 1; $address2 = collect(['name'=>'', 'description'=>$form2->address, 'reference'=> $form2->reference]);
            $response2 = Http::get("http:/api.geonames.org/searchJSON?country=$form2->country&lang=es&username=$username");
            $countryId2=$response2->json()['geonames'][0]['countryId'];
            $getState2 = Http::get("http:/api.geonames.org/childrenJSON?geonameId=$countryId2&lang=es&username=$username")->json()['geonames'];
            $getCity2 = Http::get("http:/api.geonames.org/childrenJSON?geonameId=$form2->state&lang=es&username=$username")->json()['geonames'];
            $getDistrit2 = Http::get("http:/api.geonames.org/childrenJSON?geonameId=$form2->city&lang=es&username=$username")->json()['geonames'];
        } else { $address2 = $address;}

        Session::put('can_checkout', true);
        return view('web.cart.checkout',compact('address','address2','user','form1','form2','getState','getCity','getDistrit','getCountry','on','getState2','getCity2','getDistrit2'));
    }
    public function pays(){
        if (!session('can_checkout')) {
            return redirect()->route('web.shop.cart.index');
        }
        // Elimina la variable de sesión para evitar reutilización
        session()->forget('can_checkout');
        $formToken = $this->generateFormToken();
        $sessionToken = $this->generateSessionToken();
        $preferenceId = $this->generatePreferenceId();
        return view('web.cart.pay',compact('formToken','sessionToken','preferenceId'));
    }
    private function generateFormToken(){
        $auth= base64_encode(config('services.izipay.client_id').':'.config('services.izipay.secret'));
        $response= Http::withHeaders([
             'Authorization' => "Basic $auth",
             'Content-Type' => 'application/json',
        ])->
        post(config('services.izipay.url'),[
            'amount'  => 10000,
            'currency' => 'USD',
            'orderId'  => Str::random(20),
            'customer' => [
                'email' => auth()->user()->email,
            ],
        ])->json();

        return $response['answer']['formToken'];
    }
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
            'amount'=> Cart::instance('cart')->total(),
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
    public function generatePreferenceId(){
        MercadoPagoConfig::setAccessToken(config('services.mercadopago.token'));

        $client = new PreferenceClient();
            $preference = $client->create([
            "items"=> [
                [
                "title" => "Mi producto",
                "quantity" => 1,
                "unit_price" => 100
                ]
                ],
            "back_urls" => [
                'success' =>/*  route("paid.mercadopago") */ route('web.shop.gracias'),
            ],
            "notification_url" => 'https://webhook.site/07ad52bf-6f41-459d-a4d5-feeff2a26f80' /* route('notifications.mercadopago') */,
            ]);
        return $preference->id;
    }
    public function create(Request $request){
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
            ]
        );
        if($request->otra == 'on'){
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
            DeliveryOrder::where('order_id', $saleOrder->id)->delete();
        }

        /* return redirect()->back(); */
    return redirect()->route('web.shop.checkout.pay');
    }
}
