<div class="mx-auto w-full col-span-3 space-y-3 ">
    <div class="bg-gris-100 w-full">
        <div class="flex justify-between px-4 py-2 rounded-[3px]">
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
    <div class="bg-gris-100 w-full" x-data="{ open : false}">
        <div class="flex items-center px-4 py-2 rounded-[3px] cursor-pointer " x-on:click="open = !open">
           <div class="flex items-center space-x-5 justify-between w-full">
                <p>Compra N° {{ $order->id }}</h6> 
                @php
                    $num= now()->parse($order->created_at)->translatedFormat('d');
                    $mes= mb_convert_case(now()->translatedFormat('F'), MB_CASE_TITLE, 'UTF-8');
                @endphp
        
                <p>{{ $num.' de '.$mes }}</h6>
                <p>{{ $order->convert() }}</p>
                <p class="font-bold">S/.{{ $order->total }}</p>
             
           </div>
           <div class="flex ml-4 w-fit"> <x-icons.chevron-down height="10px" width="10px" grosor="1" class="ml-auto"
                     ::class="{ 'rotate-180': open  }" />
           </div>
          
            
        </div>

        
        <div x-show="open" x-cloak x-collapse x-on:click.away="open = false">
            <hr class="border-gris-70 border-[1px]">
            <div  class="px-4 py-2">
                <p>Seguimiento del pedido</p>
            </div>
            <div class="mb-14">
            <x-elements.progress-web-bar step="{{ $order->paso() }}" pay_date="{{ now()->format('d/m/Y H:i:s')}}"/>
            </div>
            

            @foreach ($order->saleDetails as $detail)
            <hr class="border-gris-70 border-[1px] ">

            <div  class="px-4 py-2 flex items-center">
                <a class="flex w-max items-center p-2 r"
                href="{{ route('web.shop.show',['product'=>$detail->slug,'color'=>$detail->color_id]) }}" >
                <x-outstock text="text-[10px]" class="!w-60px] !h-[60px] md:!w-[80px] md:!h-[80px]" url="{{ $detail->productImage }}" name="luchin" stock="12"/>
                </a>
                <div class="ml-2">
                   
                    <h6 class="mb-2">{{ $detail->name }}</h6>
                    <p1>Precio unidad S/.{{ $detail->sell_price }}<p1>
                    <p1>Color: {{ $detail->color }}<p1>
                   
                </div>
                <p class="mx-auto"> Cantidad: {{ $detail->qtn }}</p>
                <div class="flex ustify-end space-x-2">
                    <p1 class="text-corp-20 font-bold">{{ $detail->brand }}</p1>

                    <p1>| SKU :</p1>
                    <p1>{{ $detail->sku }}</p1>
                </div>
            </div>

            @endforeach
        </div>
        <div  x-show="open" x-cloak>
            <hr class="border-gris-70 border-[1px]">
            <div  class="px-4 py-2">
                <p class="mb-2"><b>Envio a domicilio</b></p>
                @if ($order->deliveryOrders)
                <p1>{{ $order->deliveryOrders->address }}, {{ $order->deliveryOrders->reference }}</p1>
                <p1>{{ $order->deliveryOrders->district }}, {{ $order->deliveryOrders->city }} </p1>
                <p1>{{ $order->deliveryOrders->state }}, {{ $order->deliveryOrders->country }}.</p1>
                <p1><b>Recibido por:</b> {{ $order->deliveryOrders->name }} {{ $order->deliveryOrders->last_name }}</p1>
                @else
                <p1>{{ $order->address }}, {{ $order->reference }}</p1>
                <p1>{{ $order->district }}, {{ $order->city }} </p1>
                <p1>{{ $order->state }}, {{ $order->country }}.</p1>
                <p1><b>Recibido por:</b> {{ $order->name }} {{ $order->last_name }}</p1> 
                @endif

          
            </div>
        </div>
    </div>
    @endforeach
</div>
