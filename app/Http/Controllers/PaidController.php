<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\MerchantOrder\MerchantOrderClient;
use Cart;
class PaidController extends Controller
{
    public function izipay(Request $request){
        if($request->get('kr-hash-algorithm') !== 'sha256_hmac') {
            throw new \Exception("Invalid hash algorithm");
        }
        $krAnswer= str_replace('\/','/', $request->get('kr-answer'));
        $calculateHash = hash_hmac('sha256',$krAnswer, config('services.izipay.hash_key'));

        if($calculateHash !== $request->get('kr-hash'))
        {
            throw new \Exception('invalid hash');
        }
        Session::put('thanks', true);
        //puedes realizar la acción que requiera la compra
        return /* "OK" */ redirect()->route('web.shop.gracias');
    }
    public function niubiz(Request $request){
        $auth= base64_encode(config('services.niubiz.user').':'.config('services.niubiz.password'));
        $accessToken=Http::withHeaders([
            'Authorization' => "Basic $auth",
        ])->get(config('services.niubiz.url_api').'/api.security/v1/security')
        ->body();

        $response= Http::withHeaders([
            'Content-Type'=>' application/json',
            'Authorization'=> $accessToken,
        ])
        ->post(config('services.niubiz.url_api').'/api.authorization/v3/authorization/ecommerce/'.config('services.niubiz.merchant_id'),[
            "channel"=> "web",
            "captureType"=> "manual",
            "countable"=> true,
            "order" => [
                "tokenId"=> $request->transactionToken,
                "purchaseNumber"=>  $request->purchasenumber,
                "amount"=> $request->amount,
                "currency"=> config('services.niubiz.currency')
            ]
        ])->json();
        session()->flash('niubiz',[
            'response'=> $response,
            'purchaseNumber'=> $request->purchasenumber,
        ]);
        if(isset($response['dataMap']) && $response['dataMap']['ACTION_CODE'] === '000'){
            Session::put('thanks', true);
            return redirect()->route('web.shop.gracias');
        }
        else {
            return redirect()->route('checkout.index');
        }

    }
    public function createPaypalOrder(Request $request){
        $access_token = $this->generateAccessTokenPaypal();
        $response = Http::withHeaders([
            'Content-Type'=>'application/json',
            'Authorization' => "Bearer $access_token",
        ])->post(config('services.paypal.url').'/v2/checkout/orders',[
            'intent'=>'CAPTURE',
            'purchase_units'=>[
                [
                    'amount' => [
                        'currency_code' => 'USD',
                        'value'=> $request->amount,
                    ],
                ]
            ]
        ])->json();

        return $response;
    }
    public function capturePaypalOrder(Request $request){
        $orderID =$request->orderID;
        $access_token = $this->generateAccessTokenPaypal();
        $response = Http::withHeaders([
            'Content-Type'=>'application/json',
            'Authorization' => "Bearer $access_token",
        ])->post(config('services.paypal.url')."/v2/checkout/orders/$orderID/capture",[
            'intent'=>'CAPTURE',
        ])->json();
        if (!isset($response['status']) || $response['status'] !== 'COMPLETED') {
           throw new Exception('Error al capturar el pago');
        }
        return $response;
    }
    private function generateAccessTokenPaypal(){
        $auth = base64_encode(config('services.paypal.client_id').':'.config('services.paypal.secret'));

        $response = Http::asForm()->withHeaders([
            'Authorization' => "Basic $auth",
        ])
        ->post(config('services.paypal.url').'/v1/oauth2/token',[
            'grant_type'=> 'client_credentials',
        ])->json();

        return $response['access_token'];
    }
    public function mercadopago(Request $request)
    {
        MercadoPagoConfig::setAccessToken(config('services.mercadopago.token'));
        $merchantOrderClient = new MerchantOrderClient();
        /* $merchantOrderId = $request->input('merchant_order_id'); */
        $merchantOrderId = $request->input('id');
        $merchant_order = $merchantOrderClient->get(intval($merchantOrderId));

        $paid_amount = 0;

        foreach($merchant_order->payments as $payment){
            if($payment->status == 'approved'){
                $paid_amount += $payment->transaction_amount;
            }
        }
        Session::put('thanks', true);
        if($paid_amount == $merchant_order->total_amount){
            //Pago se realizo satisfactoriamente
            //Ejecutamos cualquier action

            /* return redirect()->route('web.shop.gracias'); */
        }
    }
}
