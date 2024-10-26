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
    ]
    @endphp
    <x-slot name="slot2">
        <!-- Contenedor del contenido -->
        <div class="flex flex-col border border-gris-80 mx-10">
            <div class="text-center p-0">
                <!-- Logo o imagen de encabezado -->
                <img src="https://lodomens.com/image/lodomens/Banner_para_correos.png" alt="Lodomens" class="w-5/6 mx-auto my-3" />
            </div>
            <div class="bg-gris-80 p-5 md:w-5/6 mx-auto">
                <!-- Contenido del correo -->
                <div class="text-center text-gris-10 font-sans text-2xl">
                    <b>Estado del pedido actual</b>
                </div>
{{--                  <div class="py-5 text-gris-10 font-sans text-base leading-5">
                    Hola, {{ $mailData['order']['name'] }}, tu pedido ha sido enviado a través de nuestro currier. Si no vas a estar, recuerda que alguien mayor de edad lo puede recibir, mostrando los datos de envio para verificar la compra.
                </div>  --}}
                <div class="max-w-2xl mx-auto">
                    <div class="text-center py-5">
                        <!-- Contenedor de la barra de progreso -->
                        <div class="flex justify-center">
                            <!-- Primer círculo (resaltado) -->
                            <div class="text-center">
                                <div class="flex justify-end items-center w-32">
                                    <div class=" w-8 h-8 rounded-full bg-red-800  text-white flex items-center justify-center font-sans">
                                        1
                                    </div>
                                    <div class="bg-red-800 h-1 w-[40%]"></div>
                                </div>
                                <div class="mt-2 text-gris-10 font-sans text-sm">Recibido</div>
                            </div>
                            <div class="text-center">
                                <div class="flex  items-center w-32">
                                    <div class="bg-red-800 h-1  w-[38%]"></div>
                                    <div class=" w-8 h-8 rounded-full bg-red-800 text-white flex items-center justify-center font-sans">
                                        2
                                    </div>
                                    <div class="bg-red-800 h-1 w-[38%]"></div>
                                </div>
                                <div class="mt-2 text-gris-10 font-sans text-sm">En proceso</div>
                            </div>
                            <div class="text-center">
                                <div class="flex items-center w-32">
                                    <div class="bg-red-800 h-1 w-[38%] "></div>
                                    <div class=" w-8 h-8 rounded-full bg-red-800 text-white flex items-center justify-center font-sans">
                                        3
                                    </div>
                                    <div class="bg-gray-300 h-1 w-[38%] "></div>
                                </div>
                                <div class="mt-2 text-red-800 font-sans text-sm font-bold">En camino</div>
                            </div>
                            <div class="text-center">
                                <div class="flex  items-center w-32">
                                    <div class="bg-gray-300 h-1 w-[40%] "></div>
                                    <div class=" w-8 h-8 rounded-full bg-gray-300 text-gris-80 flex items-center justify-center font-sans">
                                        4
                                    </div>
                                </div>
                                <div class="mt-2 text-gris-10 font-sans text-sm">Entregado</div>
                            </div>
                        </div>
                    </div>
                    <div class="grid p-5 font-sans text-gris-10">
                        <div class="border-b border-gray-300 pb-1 mb-4">
                            <h6 class="m-0 text-lg font-bold">{{ $order->shipping->price == 0 ? 'Retirno en : '.$order->shipping->name : 'Dirección de envio' }}</h6>
                        </div>
                        @if ($order->deliveryOrders)
                            @if ($order->shipping->price)
                                <div>{{ $order->deliveryOrders->address }}, {{ $order->deliveryOrders->reference  }}</div>
                                <div>{{ $order->deliveryOrders->district }}, {{ $order->deliveryOrders->city }} </div>
                                <div>{{ $order->deliveryOrders->state }}, {{ $order->deliveryOrders->country }}.</div>
                            @else
                                <div>{{--  {!! $mailData['shipping']['title'] !!}  --}}</div>
                            @endif
                            <div><b>Recibido por:</b> {{ $order->deliveryOrders->name }} {{ $order->deliveryOrders->last_name }}</div>
                        @else
                            @if ($order->shipping->price > 0)
                                <div>{{  $order->address }}, {{  $order->reference }}</div>
                                <div>{{  $order->district }}, {{  $order->city }} </div>
                                <div>{{  $order->state }}, {{  $order->country }}.</div>
                            @else
                                <div>{{ $order->shipping->description }}</div>
                            @endif
                            <div><b>Comprado por:</b> {{ $order->name.' '.$order->last_name }}</div>
                        @endif
                    </div>

                    <div class="max-w-2xl mx-auto font-sans text-gris-5 p-5">
                        <div class="">
                            <div class="flex border-b border-gray-300">
                                <p class="text-lg font-bold mb-1">Detalles de su pedido:</p>
                                <p class="text-lg mb-1 ml-auto">Pedido N° 00{{ $order->id }}</p>
                            </div>
                            @foreach ($order->saleDetails as $item)
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
                                        <p class="m-3 text-sm">Precio unidad: {{session('currency')}}{{ $item->sell_price }}</p>
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
                    <div class="font-sans text-gris-5 mb-12 px-5">
                        <div class="flex border-t border-gray-300">
                            <p class="text-lg mb-0">Sub-Total</p>
                            <p class="text-lg mb-0 ml-auto">{{ ($order->country =='Perú' ? 'S/. ' : '$ '). number_format($order->total-$order->shipping->price,2 ) }}</p>
                        </div>
                        <div class="flex">
                            <p class="m-1 text-lg">Envio - <span class="text-sm">{{ $order->shipping->price == 0 ?   $order->shipping->name : 'Envio a domicilio' }}</span></p>
                            <p class="m-1 text-lg ml-auto">{{ ($order->country =='Perú' ? 'S/. ' : '$ ').$order->shipping->price }}</p>
                        </div>
                        <div class="flex font-bold">
                            <p class="m-1 text-xl">Total:</p>
                            <p class="m-1 text-xl ml-auto">{{ ($order->country =='Perú' ? 'S/. ' : '$ '). $order->total }}</p>
                        </div>
                    </div>
                </div>

            </div>

        </div>

{{--          <div class="max-w-[793px] h-[1122px] flex flex-col justify-between bg-gris-80 mx-auto shadow-xl mt-12 p-[72px] text-gris-10">
            <div>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-3xl tracking-wide">Invoice</p>
                        <p class="text-xl font-bold tracking-wide mt-4">{{ env('APP_NAME') }}</p>
                        <p class="text-sm text-gris-30">3730 Coulter Lane</p>
                        <p class="text-sm text-gris-30">Richmond, VA 23224</p>
                    </div>
                    <div>
                        <div>
                            <img src="{{ asset('image/lodomens/Favicon_LodoMens.ico') }}" alt="Lodomens" width="70px" height="70px">
                        </div>
                    </div>
                </div>
                <div class="bg-gray-400 w-full h-[1px] my-8"></div>
                <div class="flex justify-between">
                    <div>
                        <p class="font-bold">Boleta para:</p>
                        <p class="text-gris-30 mt-2">{{ $order->name.' '.$order->last_name }}</p>
                        <p class="text-gris-30">{{ $order->address }}</p>
                        <p class="text-gris-30">{{ $order->district.', '.$order->country }}</p>
                    </div>
                    <div class="flex flex-col space-y-1">
                        <div class="flex items-center">
                            <span class="w-32 font-bold">Compra N°</span>
                            <span class="text-gris-30">{{ $order->id }}</span>
                        </div>
                        <div class="flex items-center">
                            <span class="w-32 font-bold">Fecha de Pago</span>
                            <span class="text-gris-30">{{ $num.' de '.$mes }}</span>
                        </div>
                        <div class="flex items-center">
                            <span class="w-32 font-bold">Tipo de envio</span>
                            <span class="text-gris-30">{{ $envio[$order->shipping->state] }}</span>
                        </div>
                        <div class="flex items-center">
                            <span class="w-32 font-bold">Monto ({{ $order->country =='Perú' ? 'Soles' : 'Dólares' }})</span>
                            <span class="text-green-600 font-bold">{{($order->country =='Perú' ? 'S/. ' : '$ '). $order->total }}</span>
                        </div>
                    </div>
                </div>
                <div class="mt-24">
                    <table class="w-full">
                        <thead class="h-12 border-y-4 border-gray-500">
                            <tr><th>#</th>
                            <th>Item</th>
                            <th>SKU</th>
                            <th>Color</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total</th>
                        </tr></thead>
                        <tbody>
                            @foreach ($order->saleDetails as $key=>$item )
                            <tr class="text-gris-30 text-center">
                                <td class="py-2">{{ $key+1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->sku }}</td>
                                <td>{{ $item->color }}</td>
                                <td>{{ $item->qtn }}</td>
                                <td>{{ ($order->country =='Perú' ? 'S/. ' : '$ ').$item->sell_price }}</td>
                                <td>{{ ($order->country =='Perú' ? 'S/. ' : '$ ').$item->sell_price * $item->qtn }}</td>
                            </tr>
                            @endforeach

                            <tr class="border-t-2">
                                <td class="py-2" colspan="5"></td>
                            </tr>
                            <tr class="text-center">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="font-bold">Subtotal</td>
                                <td>{{ ($order->country =='Perú' ? 'S/. ' : '$ '). number_format($order->total-$order->shipping->price,2 ) }}</td>
                            </tr>
                            <tr class="text-center">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="font-bold">Envio</td>
                                <td>{{ ($order->country =='Perú' ? 'S/. ' : '$ ').$order->shipping->price }}</td>
                            </tr>

                            <tr class="text-center">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-lg font-bold py-2">TOTAL</td>
                                <td class="text-lg font-bold text-green-600 py-2">{{ ($order->country =='Perú' ? 'S/. ' : '$ '). $order->total }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="text-center text-xs text-gris-30">
                <p>For questions concering this invoice, please contact</p>
                <p>John Doe, (012) 345 6789, johndoe@example.com</p>
                <p>www.yourwebaddress.com</p>
            </div>
        </div>  --}}


    </x-slot>

</x-app-layout>
