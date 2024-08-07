@extends('layouts.web')

@section('breadcrumb')
 <x-breadcrumb.progress />
@endsection

{{--  <x-lodomens.video />  --}}
@section('content')

<div class="md:mx-5 lg:mx-auto lg:w-[987px] bg-black/75  pb-1 2xl:min-h-[374px] lg:min-h-[278px] flex flex-col items-center justify-center">

        <div class="flex flex-col text-center bg-gris-90 h-full p-3 rounded-[5px] border-[1px] border-gris-70 w-2/3 my-6">
            {{--  check  --}}

            <x-elements.success scale="0.75" />

            {{--  fin de check  --}}
            <h2>Gracias por su compra</h2>
         <p>Te envíamos los detalles de tu compra a <b>{{ auth()->user()->email }} </b></p>
         <x-elements.progress-web-bar pay_date="{{ now()->format('d/m/Y H:i:s')}}"/>
            <div class="w-11/12 mx-auto mt-6 mb-3">
                <a href="{{ route('web.shop.webdashboard.purchase',['open'=>true]) }}" >
                    <x-button.webprimary >Ir a mis compras</x-button.webprimary>
                </a>

            </div>
        </div>

        {{--  niubiz --}}

        @if(session('niubiz'))
        @php
        $data= session('niubiz')['response'];
        $purchaseNumber = session('niubiz')['purchaseNumber'];
        @endphp

        <div class="space-y-1 py-4 w-2/3 text-left">
            <div class="flex items-center space-x-5">
                <span class="w-52 font-bold"> N°. de operación:</span>
                <span class="text-gris-30">{{ $purchaseNumber }}</span>
            </div>
            <div class="flex items-center space-x-5">
                <span class="w-52 font-bold">Fecha y Hora de pedido:</span>
                <span class="text-gris-30">{{ now()->createFromFormat('ymdHis',$data['dataMap']['TRANSACTION_DATE'])->format('d/m/Y H:i:s') }}</span>
            </div>
            <div class="flex items-center space-x-5">
                <span class="w-52 font-bold">Tarjeta:</span>
                <span class="text-gris-30">{{ $data['dataMap']['CARD'] }} ({{ $data['dataMap']['BRAND'] }})</span>
            </div>
            <div class="flex items-center space-x-5">
                <span class="w-52 font-bold">Importe ({{session('currency')}})</span>
                <span class="text-gris-30 font-bold">{{session('currency')}} {{ $data['order']['amount']}}</span>
            </div>
        </div>{{--  .' '.$data['order']['currency']   --}}
        <div>

        </div>
    @endif
</div>
@php
    session()->forget('thanks');
@endphp
@endsection


