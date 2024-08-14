@php
$color = [
'PAID'=>'text-azul-30',
'PROCESS'=>'text-morado-30',
'TRACKING'=>'text-amarillo-30',
'DONE'=>'text-verde-30',
'CANCEL'=>'text-rojo-30'
];

if($open !== '1')
{
$order_last= '';
}
@endphp

<div class="mx-auto w-full col-span-3 space-y-3 " x-data="{ open :'{{ $order_last }}' }">
    <div class="bg-gris-100 w-full rounded-[3px]">
        <div class="flex justify-between px-4 py-2 items-center">
            <h6>Mis compras</h6>
            <div class="w-[100px]">
                <x-select wire:change="filter()" wire:model="filterBy">
                    <option value="created_at">Fecha</option>
                    <option value="total">Monto</option>
                    <option value="status">Estado</option>
                </x-select>
            </div>
        </div>
    </div>
    @foreach ($orders as $order)
    @if($order->status !== 'CREATE')
    <div class="bg-gris-100 w-full rounded-[3px]">
        <div class="flex items-center px-4 py-2 rounded-[3px] cursor-pointer "
            x-on:click="if(open == {{ $order->id }}) { open = '' } else { open = {{ $order->id }} }">
            <div class="flex items-center sm:space-x-5 space-x-2 justify-between w-full">
                <p>Pedido N° {{ $order->id }}</p>
                @php
                $num= now()->parse($order->created_at)->translatedFormat('d');
                $mes= mb_convert_case(now()->translatedFormat('F'), MB_CASE_TITLE, 'UTF-8');
                $mes2 = ucfirst(now()->parse($order->created_at)->translatedFormat('M'));
                @endphp

                <p class="hidden md:block">{{ $num.' de '.$mes }}
                <p>
                <p class="md:hidden block">{{ $num.' de '.$mes2 }}
                <p>
                <p class="{{ $color[$order->status] }}">{{ $order->convert() }}</p>
                <p class="font-bold">{{ $order->currency == 'PEN' ? 'S/.' : '$ ' }}{{ $order->total }}</p>

            </div>
            <div class="flex ml-4 w-fit">
                <x-icons.chevron-down height="10px" width="10px" grosor="1" class="ml-auto"
                    ::class="{ 'rotate-180': open == {{ $order->id }}  }" />
            </div>


        </div>


        <div x-show="open == {{ $order->id }}" x-cloak x-collapse x-on:click="open = {{ $order->id }}">
            <hr class="border-gris-70">
            <div class="px-4 py-2">
                <p>Seguimiento del pedido</p>
            </div>
            <div class="mb-14">
                <x-elements.progress-web-bar step="{{ $order->paso() }}" pay_date="{{ now()->format('d/m/Y H:i:s')}}" />
            </div>


            @foreach ($order->saleDetails as $detail)
            <hr class="border-gris-70">

            <div class="px-4 py-2 flex items-center">
                <a class="flex w-max items-center"
                    href="{{ route('web.shop.show',['product'=>$detail->slug,'color'=>$detail->color_id]) }}">
                    <x-outstock text="text-[10px]" class="!w-[70px] !h-[70px] md:!w-[80px] md:!h-[80px]"
                        url="{{ $detail->productImage }}" name="luchin" stock="12" />
                </a>
                <div class="flex justify-between {{--  items-center  --}} w-full ml-2 sm:ml-4" >
                    <div>

                        <h6 class="mb-2">{{ $detail->name }}</h6>
                        <p1>Precio und: {{ $order->currency == 'PEN' ? 'S/.' : '$ ' }}{{ $detail->sell_price }}<p1>
                                <p1>Color: {{ $detail->color }}<p1>
{{--                                      <div>
                                        <p1> Cantidad: {{ $detail->qtn }}</p1>
                                        <p1 class="text-corp-20 font-bold ml-auto">{{ $detail->brand }}</p1>
                                    </div>  --}}
                    </div>

                    <div class="flex justify-end flex-col">
                        <h6 class="mb-2 ml-auto"> {{ $order->currency == 'PEN' ? 'S/.' : '$ ' }}{{ number_format($detail->sell_price * $detail->qtn, 2) }}</h6>
                        <div class="">
                            <p1 class="w-fit ml-auto"> Cantidad: {{ $detail->qtn }}</p1>
                            <div class="ml-auto flex space-x-2">
                                <p1 class=" ml-auto">Marca: {{ $detail->brand }}</p1>
                            </div>
                        </div>
                        <p1> SKU : {{ $detail->sku }}</p1>
                    </div>
                </div>
            </div>

            @endforeach
        </div>
        <div x-show="open == {{ $order->id }}" x-cloak>
            <hr class="border-gris-70">
            <div>
                <p class="my-2 px-4 "><b>{{ $order->shipping->price == 0 ? $order->shipping->name : 'Envio a domicilio'
                        }}</b></p>
                <div class="px-4 py-2 grid grid-cols-2 gap-14">
                    <div>
                        @if ($order->deliveryOrders)
                        @if ($order->shipping->price > 0)
                        <p1>{{ $order->deliveryOrders->address }}, {{ $order->deliveryOrders->reference }}</p1>
                        <p1>{{ $order->deliveryOrders->district }}, {{ $order->deliveryOrders->city }} </p1>
                        <p1>{{ $order->deliveryOrders->state }}, {{ $order->deliveryOrders->country }}.</p1>
                        @else
                        <p1><b>Dirección:</b> {{ $order->shipping->description }}</p1>
                        @endif
                        <p1><b>Recibido por:</b> {{ $order->deliveryOrders->name }} {{ $order->deliveryOrders->last_name
                            }}</p1>
                        @else
                        @if ($order->shipping->price > 0)
                        <p1>{{ $order->address }}, {{ $order->reference }}</p1>
                        <p1>{{ $order->district }}, {{ $order->city }} </p1>
                        <p1>{{ $order->state }}, {{ $order->country }}.</p1>
                        @else
                        <p1><b>Dirección:</b> {{ $order->shipping->description }}</p1>
                        @endif
                        <p1><b>Recibido por:</b> {{ $order->name }} {{ $order->last_name }}</p1>

                        @endif
                    </div>


                    <div>
                        @if ($order->shipping->price > 0)

                        <p1 class="capitalize"> <b>Tipo de Envio:</b> {{ $order->shipping->spanish() }} </p1>
                        <p1><b> Precio :</b>{{ $order->currency == 'PEN' ? 'S/.' : '$ ' }} {{  $order->currency == 'PEN' ? $order->shipping->price : round($order->shipping->price/$dolar,2)  }}
                            @if ($order->shipping->state == 'district')
                            <p1> {{ $order->shipping->name }}</p1>
                            @else
                            <p1><b>Currier :</b>{{ $order->shipping->name }}</p1>
                            @endif
                            @else
                            <p1 class="text-verde-30">Envio Gratis</p1>
                            @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @endforeach

    {{$orders->links('vendor.livewire.lodomen')}}
</div>
