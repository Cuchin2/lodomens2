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

        <div class="max-w-[793px] h-[1122px] flex flex-col justify-between bg-gris-80 mx-auto shadow-xl mt-12 p-[72px] text-gris-10">
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
{{--                              <tr class="text-center">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="font-bold">Tax 8%</td>
                                <td>$ 257,04</td>
                            </tr>  --}}
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
        </div>


    </x-slot>

</x-app-layout>
