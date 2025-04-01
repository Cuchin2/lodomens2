@extends('layouts.web')

@section('breadcrumb')
 <x-breadcrumb.progress />
@endsection

{{--  <x-lodomens.video />  --}}
@section('content')
<div class="mt-[50px] md:m-0">
<div class="md:mx-5 lg:mx-auto lg:w-[987px] bg-black/75  pb-1 2xl:min-h-[374px] lg:min-h-[278px] flex flex-col items-center justify-center">

        <div class="flex flex-col text-center bg-gris-90 h-full p-3 rounded-[5px] border-[1px] border-gris-70 w-2/3 my-6">
            {{--  check  --}}

            <x-elements.success scale="0.75" />

            {{--  fin de check  --}}
            <h2>Un paso más</h2>
         <p>Te envíamos los detalles de tu compra a <b>{{ auth()->user()->email }} </b></p>
         <x-elements.progress-web-bar pay_date="{{ now()->format('d/m/Y H:i:s')}}"/>
            <div class="w-11/12 mx-auto mt-6 mb-3">
                <a href="{{ route('web.shop.webdashboard.purchase', ['open' => $order->id]) }}" >
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
</div>

@if($whatssap)
<x-web.modal.modalstatic maxWidth="sm">
    <x-slot name="title">
            <h6 class="text-center">Gracias por su compra</h6>
    </x-slot>
    <p>A continuación para fijar la hora y fecha de retiro haga click en el enlace siguiente</p>
    <x-slot name="footer">
        <div class="flex mx-auto space-x-2">
        <button @click="other = true; openWhatsApp()"
        class="text-[12px] h-[30px] w-fit bg-green-600 text-white p-2 rounded-[3px] hover:bg-green-700 transition-colors flex items-center justify-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
            viewBox="0 0 24 24">
            <path
                d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
        </svg>
        Coordinemos por WhatsApp
    </button>
        <x-button.corp_secundary @click="show = false" x-show="other" x-cloak>Salir</x-button.corp_secundary>
    </div>
    </x-slot>

</x-web.modal.modalstatic>
@endif
@php
    session()->forget('thanks');
@endphp
<script>

    // Simulación del carrito de compras
    const cart = {
        value: @json($order->saleDetails)
    };

    // Cálculo del total de la orden
    const total = {
        value: cart.value.reduce((sum, item) => {
            return sum + (item.sell_price * (item.qtn || 1));
        }, 0).toFixed(2)
    };

    // Función para abrir WhatsApp
    function openWhatsApp() {
        const message = cart.value.reduce((msg, item) => {
            return msg + `\n Nombre: *(${item.qtn}) ${item.name}* \n Precio *S/.${item.sell_price}* \n SKU: *${item.sku}* \n Subtotal: *S/. ${(item.sell_price * (item.qtn || 1)).toFixed(2)}* \n`;
        }, `¡Hola!, le escribe *{{ auth()->user()->name }}* Acabo de realizar la compra *N°{{ $order->id }}* de el/los siguiente(s) artículo(s), deseo programar hora y fecha de retiro en *{{ $order->shipping->name }}*:\n`);

        const orderMessage = message + `\n\n *Total: S/. ${total.value}*`;
        const encodedMessage = encodeURIComponent(orderMessage);
        const phoneNumber = '51930915760'; // Número de teléfono de WhatsApp

        window.open(`https://wa.me/${phoneNumber}?text=${encodedMessage}`, '_blank');
    }
</script>
@endsection


