<x-app-layout>

    <x-slot name="slot1">
        <x-breadcrumb.title title='Venta N° {{$order->id}}'/>
        <x-breadcrumb.breadcrumb>
            <x-breadcrumb.breadcrumb2 name='Lista de Ventas' href="{{ route('sale.index') }}"/>
            <x-breadcrumb.breadcrumb2 name='N° Pedido {{$order->id}}'/>
        </x-breadcrumb.breadcrumb>
    </x-slot>

    @php
    $num= now()->parse($order->created_at)->translatedFormat('d');
    $mes= mb_convert_case(now()->translatedFormat('F'), MB_CASE_TITLE, 'UTF-8');

    $envio = [
        'district'=>'Local',
        'nacional'=>'Nacional',
        'internacional'=>'Internacional'
    ];

    // Validar y formatear precios
    $shippingPrice = $order->shipping->price ?? 0;
    $shippingPrice = is_numeric($shippingPrice) ? $shippingPrice : 0;
    $subtotal = $order->total - $shippingPrice;
    $currencySymbol = $order->country == 'PE' || $order->country == 'Perú' ? 'S/. ' : '$ ';
    @endphp

    <x-slot name="slot2">
        <!-- Contenedor del contenido -->
        <div class="flex flex-col border border-gris-80 mx-10">
            <div class="text-center p-0">
                <!-- Logo o imagen de encabezado -->
                <img src="https://lodomens.com/image/lodomens/Banner_para_correos.png" alt="Lodomens" class="md:w-5/6 mx-auto my-3 w-full" />
            </div>
            <div class="bg-gris-80 p-5 md:w-5/6 mx-auto w-full">
                <!-- Contenido del correo -->
                <div class="text-center text-gris-10 font-sans text-2xl">
                    @if($order->status == 'CANCEL')
                    <b class="text-red-500">Pedido cancelado</b>
                    @else
                    <b>Estado del pedido actual</b>
                    @endif
                </div>

                <div class="max-w-2xl mx-auto">
                    <div class="text-center py-5">
                        <!-- Contenedor de la barra de progreso -->
                        @switch($order->status)
                            @case('PAID')
                                <x-progress.paid />
                                @break
                            @case('TRACKING')
                                <x-progress.track />
                                @break
                            @case('PROCESS')
                                <x-progress.process />
                                @break
                            @case('DONE')
                                <x-progress.done />
                                @break
                        @endswitch
                    </div>

                    <div class="grid p-5 font-sans text-gris-10">
                        <div class="border-b border-gray-300 pb-1 mb-4">
                            <h6 class="m-0 text-lg font-bold">
                                {{ $shippingPrice == 0 ? 'Retiro en: '.($order->shipping->name ?? 'Local') : 'Dirección de envío' }}
                            </h6>
                        </div>

                        @if ($order->deliveryOrders)
                            @if ($shippingPrice > 0)
                                <div>{{ $order->deliveryOrders->address ?? '' }}, {{ $order->deliveryOrders->reference ?? '' }}</div>
                                <div>{{ $order->deliveryOrders->district ?? '' }}, {{ $order->deliveryOrders->city ?? '' }} </div>
                                <div>{{ $order->deliveryOrders->state ?? '' }}, {{ $order->deliveryOrders->country ?? '' }}.</div>
                            @else
                                <div>{{ $order->shipping->description ?? 'Retiro en tienda' }}</div>
                            @endif
                            <div><b>Recibido por:</b> {{ ($order->deliveryOrders->name ?? '') }} {{ ($order->deliveryOrders->last_name ?? '') }}</div>
                        @else
                            @if ($shippingPrice > 0)
                                <div>{{ $order->address ?? '' }}, {{ $order->reference ?? '' }}</div>
                                <div>{{ $order->district ?? '' }}, {{ $order->city ?? '' }} </div>
                                <div>{{ $order->state ?? '' }}, {{ $order->country ?? '' }}.</div>
                            @else
                                <div>{{ $order->shipping->description ?? 'Retiro en tienda' }}</div>
                            @endif
                            <div><b>Comprado por:</b> {{ ($order->name ?? '') .' '. ($order->last_name ?? '') }}</div>
                        @endif
                    </div>

                    <div class="max-w-2xl mx-auto font-sans text-gris-5 p-5">
                        <div class="">
                            <div class="flex border-b border-gray-300">
                                <p class="text-lg font-bold mb-1">Detalles de su pedido:</p>
                                <p class="text-lg mb-1 ml-auto">Pedido N° 00{{ $order->id }}</p>
                            </div>

                            @foreach ($order->saleDetails as $item)
                            @php
                                // Validar precios del item
                                $itemPrice = $item->sell_price ?? 0;
                                $itemPrice = is_numeric($itemPrice) ? $itemPrice : 0;
                                $quantity = $item->qtn ?? 0;
                                $quantity = is_numeric($quantity) ? $quantity : 0;
                                $itemTotal = $itemPrice * $quantity;

                                // Validar imagen
                                $productImage = !empty($item->productImage) ? (asset('storage').'/'.$item->productImage) : '';
                                $srcImage = !empty($item->src) ? (asset('storage').'/'.$item->src) : '';
                                $colorHex = $item->hex ?? '#CCCCCC';
                            @endphp

                            <div class="flex">
                                <!-- Imagen del producto -->
                                <a href="" class="w-24 h-24 m-3 relative border-corp-50">
                                    @if($srcImage)
                                    <img src="{{ $srcImage }}" alt="" class="absolute">
                                    @endif
                                    @if($productImage)
                                    <img src="{{ $productImage }}" alt="{{ $item->name ?? 'Producto' }}"
                                         class="w-24 h-24 object-cover border-2 rounded"
                                         style="border-color: {{ $colorHex }}">
                                    @else
                                    <div class="w-24 h-24 bg-gray-200 border-2 rounded flex items-center justify-center"
                                         style="border-color: {{ $colorHex }}">
                                        <span class="text-gray-500 text-xs">Sin imagen</span>
                                    </div>
                                    @endif
                                </a>

                                <!-- Detalles del producto -->
                                <div class="flex w-full">
                                    <div class="m-3">
                                        <h6 class="m-0 text-lg font-bold">{{ $item->name ?? 'Producto no disponible' }}</h6>
                                        <p class="m-0 text-sm">Precio unidad: {{ $currencySymbol }}{{ number_format($itemPrice, 2) }}</p>
                                        <p class="m-0 text-sm">Color: {{ $item->color ?? 'N/A' }}</p>
                                        <p class="m-0 text-sm">Marca: {{ $item->brand ?? 'N/A' }}</p>
                                    </div>
                                    <div class="mt-3 ml-auto text-right">
                                        <p class="m-0 text-lg font-bold">{{ $currencySymbol }}{{ number_format($itemTotal, 2) }}</p>
                                        <p class="m-0 text-sm">Cantidad: {{ $quantity }}</p>
                                        <p class="m-0 text-sm whitespace-nowrap">SKU: {{ $item->sku ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="font-sans text-gris-5 mb-12 px-5">
                        <div class="flex border-t border-gray-300">
                            <p class="text-lg mb-0">Sub-Total</p>
                            <p class="text-lg mb-0 ml-auto">{{ $currencySymbol }}{{ number_format($subtotal, 2) }}</p>
                        </div>
                        <div class="flex">
                            <p class="m-1 text-lg">Envío - <span class="text-sm">{{ $shippingPrice == 0 ? ($order->shipping->name ?? 'Retiro en tienda') : 'Envío a domicilio' }}</span></p>
                            <p class="m-1 text-lg ml-auto">{{ $currencySymbol }}{{ number_format($shippingPrice, 2) }}</p>
                        </div>
                        <div class="flex font-bold">
                            <p class="m-1 text-xl">Total:</p>
                            <p class="m-1 text-xl ml-auto">{{ $currencySymbol }}{{ number_format($order->total ?? 0, 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>
