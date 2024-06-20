@extends('layouts.web')
@push('head')
<script type="text/javascript"
    src="https://static.micuentaweb.pe/static/js/krypton-client/V4.0/stable/kr-payment-form.min.js"
    kr-public-key="{{ config('services.izipay.public_key') }}" kr-post-url-success="{{ route('paid.izipay') }}" ;
    kr-language="es-ES">
</script>
<link rel="stylesheet" href="https://static.micuentaweb.pe/static/js/krypton-client/V4.0/ext/classic-reset.min.css">
<script type="text/javascript" src="https://static.micuentaweb.pe/static/js/krypton-client/V4.0/ext/classic.js">
</script>
@endpush
@section('breadcrumb')

<x-breadcrumb.lodomens.breadcrumb title="Checkout">
    <x-breadcrumb.lodomens.breadcrumb2 name='Checkout' href="{{ route('web.shop.checkout.index') }}"/>
    <x-breadcrumb.lodomens.breadcrumb2 name='Métodos de pago' />
</x-breadcrumb.lodomens.breadcrumb>

@endsection


@section('content')

    {{-- error de pago --}}
    @if(session('niubiz'))
    @php
    $data= session('niubiz')['response'];
    $purchaseNumber = session('niubiz')['purchaseNumber'];
    @endphp
    <div class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-green-800"
        role="alert">
        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            fill="currentColor" viewBox="0 0 20 20">
            <path
                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>
        <span class="sr-only">Info</span>
        <div>
            <span class="font-medium">Success alert!</span>{{ $data['dataMap']['ACTION_DESCRIPTION'] }}.
        </div>
    </div>
    <div class="flex flex-col space-y-1 p-4">
        <div class="flex items-center">
            <span class="w-32 font-bold"> N°. de pedido:</span>
            <span class="text-gris-30">{{ $purchaseNumber }}</span>
        </div>
        <div class="flex items-center">
            <span class="w-32 font-bold">Fecha y Hora de pedido:</span>
            <span class="text-gris-30">{{
                now()->createFromFormat('ymdHis',$data['data']['TRANSACTION_DATE'])->format('d/m/Y H:i:s') }}</span>
        </div>
        <div class="flex items-center">
            <span class="w-32 font-bold">Tarjeta:</span>
            <span class="text-gris-30">{{ $data['data']['CARD'] }} ({{ $data['data']['BRAND'] }})</span>
        </div>
        {{-- <div class="flex items-center">
            <span class="w-32 font-bold">Importe (USD)</span>
            <span class="text-corp-30 font-bold">$ {{ $data['order']['amount'].' '.$data['order']['currency'] }}</span>
        </div> --}}
    </div>
    @endif

    {{-- fin de error de pago --}}


    <div class="flex flex-col text-center bg-gris-90 h-full p-3 rounded-[5px] border-[1px] border-gris-70 w-1/3 min-w-fit my-6 mx-auto">

        <h5 class="mb-4">Métodos de Pago</h5>
        <div class="flex flex-col mx-auto w-[280px] space-y-4">

            {{--  izipay  --}}
            <div x-data="{open:false}">
                <button x-on:click="open = !open" class="flex justify-center w-full bg-gray-100 py-2 rounded-lg shadow" x-on:click="open = !open">
                    <img src="{{ asset('storage/image/logos_pasarela/izipay2.png') }}" class="h-8" alt="Logo Izipay">
                </button>
                <div class="flex justify-center mt-4" x-show="open" x-cloak>
                <div class="kr-embedded" kr-form-token="{{ $formToken }}" ></div>
                </div>
            </div>
            {{--  Niubiz  --}}
            <div>
                <button onclick="VisanetCheckout.open()" class="flex justify-center w-full bg-gray-100 py-2 rounded-lg shadow">
                    <img src="https://codersfree.com/img/payments/niubiz.png" class="h-8" alt="Logo Niubiz">
                </button>
            </div>
            {{--  Paypal  --}}
            <div x-data="{ open: false }">
                <button x-on:click="open = true" x-show="!open" class="flex justify-center w-full bg-gray-100 py-2 rounded-lg shadow">
                    <img src="https://codersfree.com/img/payments/paypal.png" class="h-8" alt="Logo Niubiz">
                </button>

                <div x-show="open" style="display: none" @click.away="open = false;">
                    <div id="paypal-button-container"><div id="zoid-paypal-buttons-uid_e778a56623_mde6mji6ntg" class="paypal-buttons paypal-buttons-context-iframe paypal-buttons-label-unknown paypal-buttons-layout-vertical" data-paypal-smart-button-version="5.0.440" style="height: 0px; transition: all 0.2s ease-in-out 0s;"><style nonce="">
                            <style>

                            #zoid-paypal-buttons-uid_e778a56623_mde6mji6ntg {
                                position: relative;
                                display: inline-block;
                                width: 100%;
                                min-height: 35px;
                                min-width: 200px;
                                font-size: 0;
                            }

                            #zoid-paypal-buttons-uid_e778a56623_mde6mji6ntg > iframe {
                                position: absolute;
                                top: 0;
                                left: 0;
                                width: 100%;
                                height: 100%;
                            }

                            #zoid-paypal-buttons-uid_e778a56623_mde6mji6ntg > iframe.component-frame {
                                z-index: 100;
                            }

                            #zoid-paypal-buttons-uid_e778a56623_mde6mji6ntg > iframe.prerender-frame {
                                transition: opacity .2s linear;
                                z-index: 200;
                            }

                            #zoid-paypal-buttons-uid_e778a56623_mde6mji6ntg > iframe.visible {
                                opacity: 1;
                            }

                            #zoid-paypal-buttons-uid_e778a56623_mde6mji6ntg > iframe.invisible {
                                opacity: 0;
                                pointer-events: none;
                            }

                            #zoid-paypal-buttons-uid_e778a56623_mde6mji6ntg > .smart-menu {
                                position: absolute;
                                z-index: 300;
                                top: 0;
                                left: 0;
                                width: 100%;
                            }
                            .header-logoImage {
                                width: auto!important;
                            }
                        </style>
                        </div>
                    </div>
                </div>
            </div>


            {{--  Mercado pago  --}}
            <div  x-data="{ open: false }">
                <button x-on:click="open = true" x-show="!open" class="flex justify-center w-full bg-gray-100 py-2 rounded-lg shadow">
                    <img src="{{ asset('storage/image/logos_pasarela/Logo_MercadoPago.png') }}" class="h-8" alt="Logo Niubiz">
                </button>
                <div id="wallet_container" x-show="open" x-cloak></div>
            </div>
        <style>
        #wallet_container > div > div > div > div {
            margin: 0 !important;
        }
        </style>

    </div>
</div>
@endsection


@push('scripts')

<script type="text/javascript" src="{{ config('services.niubiz.url_js') }}" /></script>
<script src="https://www.paypal.com/sdk/js?client-id={{ config('services.paypal.client_id') }}&currency=USD"></script>
<script src="https://sdk.mercadopago.com/js/v2"></script>
//niubiz
<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function(event){
            let purchasenumber=Math.floor(Math.random() * 1000000000) +1;
            let amount = {{ Cart::instance('cart')->total() }};
            VisanetCheckout.configure({
                sessiontoken:'{{ $sessionToken }}',
                channel:'web',
                merchantid:"{{ config('services.niubiz.merchant_id') }}",
                purchasenumber: purchasenumber,
                amount:amount,
                expirationminutes:'20',
                timeouturl:"{{ route('web.shop.checkout.index') }}",
                merchantlogo: "https://pruebas.nubesita.com/storage/662851f44f745.png",
                formbuttoncolor:'#900D0D',
                action:"{{ route('paid.niubiz') }}"+'?purchasenumber='+purchasenumber+'&amount='+amount,
                complete: function(params) {
                alert(JSON.stringify(params));
                }
            });
        });
</script>
//paypal
<script>
    paypal.Buttons({
            createOrder() {
                return axios.post('/paid/create-paypal-order', {
                    amount : "{{ Cart::instance('cart')->total() }}"
                }).then(function(response){
                    return response.data.id
                }).catch(function(error){
                    console.log(error)
                });
            },
            onApprove(data, actions) {
                return axios.post('/paid/capture-paypal-order', {
                        orderID : data.orderID
                }).then(function(response){
                  window.location.href= "{{ route('web.shop.gracias') }}";
                }).catch(function(error){
                    console.log(error)
                });
            },
        })
        .render("#paypal-button-container");

        // Example function to show a result to the user. Your site's UI library can be used instead.
        function resultMessage(message) {
        const container = document.querySelector("#result-message");
        container.innerHTML = message;
        }
</script>
//mercadopago
<script>

    const mp = new MercadoPago("{{ config('services.mercadopago.key') }}");
    const bricksBuilder = mp.bricks();
    mp.bricks().create("wallet", "wallet_container", {
        initialization: {
            preferenceId: "{{ $preferenceId }}",
            redirectMode:"modal",
        },
     customization: {
      texts: {
       valueProp: 'smart_option',
      },
      },
     });

</script>
@endpush

@push('styles')
<style>
    #paypal-button-container>div {
        z-index: 0;
    }
</style>
@endpush
