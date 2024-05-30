@extends('layouts.web')

@section('breadcrumb')

<x-breadcrumb.lodomens.breadcrumb title="Gracias">
    <x-breadcrumb.lodomens.breadcrumb2 name='Gracias' />
</x-breadcrumb.lodomens.breadcrumb>

@endsection

{{--  <x-lodomens.video />  --}}
@section('content')

<div class="md:mx-5 lg:mx-auto lg:w-[987px] bg-black/75  pb-1 2xl:min-h-[374px] lg:min-h-[278px] flex items-center justify-center">
    @if(session('niubiz'))
        @php
            $data= session('niubiz')['response'];
            $purchaseNumber = session('niubiz')['purchaseNumber'];
        @endphp
    <div class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800" role="alert">
        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
          <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
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

        <div class="flex flex-col text-center bg-gris-90 h-full p-3 rounded-[5px] border-[1px] border-gris-70 w-2/3 my-6">
            {{--  check  --}}
            
            <x-elements.success scale="0.75" />      
        
            {{--  fin de check  --}}
            <h2>Gracias por su compra</h2>
         <p>Te envíamos los detalles de tu compra a</p>
         <x-elements.progress-web-bar pay_date="{{ now()->createFromFormat('ymdHis',$data['dataMap']['TRANSACTION_DATE'])->format('d/m/Y H:i:s') }}"/>
            <div class="w-11/12 mx-auto mt-4">
            <x-button.webprimary>Ir a mis compras</x-button.webprimary>
            </div>
        </div>
      
  
</div>

@endsection


