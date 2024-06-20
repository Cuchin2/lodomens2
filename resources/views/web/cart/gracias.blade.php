@extends('layouts.web')

@section('breadcrumb')

<x-breadcrumb.lodomens.breadcrumb title="Gracias">
    <x-breadcrumb.lodomens.breadcrumb2 name='Gracias' />
</x-breadcrumb.lodomens.breadcrumb>

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
                <a href="{{ route('web.shop.webdashboard.purchase') }}" >
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

        <div class="flex flex-col space-y-1 p-4">
            <div class="flex items-center">
                <span class="w-32 font-bold"> N°. de operación:</span>
                <span class="text-gris-30">{{ $purchaseNumber }}</span>
            </div>
            <div class="flex items-center">
                <span class="w-32 font-bold">Fecha y Hora de pedido:</span>
                <span class="text-gris-30">{{ now()->createFromFormat('ymdHis',$data['dataMap']['TRANSACTION_DATE'])->format('d/m/Y H:i:s') }}</span>
            </div>
            <div class="flex items-center">
                <span class="w-32 font-bold">Tarjeta:</span>
                <span class="text-gris-30">{{ $data['dataMap']['CARD'] }} ({{ $data['dataMap']['BRAND'] }})</span>
            </div>
            <div class="flex items-center">
                <span class="w-32 font-bold">Importe (USD)</span>
                <span class="text-corp-30 font-bold">$ {{ $data['order']['amount'].' '.$data['order']['currency'] }}</span>
            </div>
        </div>
        <div>

        </div>
    @endif
</div>

@endsection


