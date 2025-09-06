<x-app-layout>

    <x-slot name="slot1">
        <x-breadcrumb.title title='Transferencia N° {{$transfer->id}}'/>
        <x-breadcrumb.breadcrumb>

            <x-breadcrumb.breadcrumb2 name='Lista de transferencia' href="{{ route('sale.dash.index') }}"/>
            <x-breadcrumb.breadcrumb2 name='N° transferencia {{$transfer->id}}'/>
        </x-breadcrumb.breadcrumb>
    </x-slot>
    @php
    $num= now()->parse($transfer->created_at)->translatedFormat('d');
    $mes= mb_convert_case(now()->translatedFormat('F'), MB_CASE_TITLE, 'UTF-8');
    @endphp

    <x-slot name="slot2">

        <div class="flex flex-col border border-gris-80 mx-10">
            <div class="text-center p-0">
                <!-- Logo o imagen de encabezado -->
                <img src="https://lodomens.com/image/lodomens/Banner_para_correos.png" alt="Lodomens" class="md:w-5/6 mx-auto my-3 w-full" />

            </div>
            <div class="bg-gris-80 p-5 md:w-5/6 mx-auto w-full">
                <!-- Contenido del correo -->

                <div class="text-center text-gris-10 font-sans text-2xl">
                    <p class="uppercase font-bold">Devolución de la tienda "{{ $transfer->store->name }}"</p>
                    @if($transfer->status == 'cancelado')
                    <b class="text-rojo-50">Devolución cancelado</b>
                    @else
                    <b class="text-verde-50">Estado del Devolución (Entregado)</b>
                    @endif
                </div>

                <div class="max-w-2xl mx-auto">

                    <div class="grid p-5 font-sans text-gris-10">
                            <div><b class="text-gris-5">Realizado por:</b> {{ $transfer->user->name }} {{ $transfer->user->last_name }}
                            </div>
                            <div><b class="text-gris-5">Fecha:</b> {{ $transfer->created_at }}
                            </div>
                    </div>

                    <div class="max-w-2xl mx-auto font-sans text-gris-5 p-5">
                        <div class="">
                            <div class="flex border-b border-gray-300">
                                <p class="text-lg font-bold mb-1">Detalles:</p>
                                <p class="text-lg mb-1 ml-auto">Devolución N° 00{{ $transfer->id }}</p>
                            </div>
                            @foreach ($transfer->details as $item)
                            <div class="flex">
                                <!-- Imagen del producto -->
                                <a href="" class=" w-24 h-24 m-3 relative border-corp-50">
                                    <img src="{{ (asset('storage').'/'.$item->src ?? '') }}" alt="" class="absolute">
                                    <img src="{{(asset('storage').'/'.$item->productImage) }}" alt="{{ $item->name }}" class="w-24 h-24 object-cover border-2  rounded" style="border-color: {{ $item->hex }}">
                                </a>

                                <!-- Detalles del producto -->
                                <div class="flex w-full">
                                    <div class="m-3">
                                        <h6 class="m-0 text-lg font-bold">{{ $item->name }}</h6>
                                        <p class="m-0 text-sm">Precio unidad: {{session('currency')}}{{ $item->sell_price }}</p>
                                        <p class="m-0 text-sm">Color:  {{ $item->color }}</p>
                                        <p class="m-0 text-sm">Marca:  {{ $item->brand }}</p>
                                    </div>
                                    <div class="mt-3 ml-auto text-right">
                                        <p class="m-0 text-lg font-bold">{{session('currency')}} {{ $item->qtn*$item->sell_price }}</p>
                                        <p class="m-0 text-sm">Cantidad: {{ $item->qtn }}</p>
                                        <p class="m-0 text-sm whitespace-nowrap">SKU: {{ $item->sku }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>

        </div>


    </x-slot>

</x-app-layout>
