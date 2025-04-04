@extends('layouts.web')

@section('breadcrumb')
@if(!isset($empty))
 <x-breadcrumb.progress id="{{ $id }}"/>
@endif
@endsection

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<style>
    .leaflet-layer,
    .leaflet-control-zoom-in,
    .leaflet-control-zoom-out,
    .leaflet-control-attribution {
    filter: invert(100%) hue-rotate(180deg) brightness(95%) contrast(90%);
}
</style>
@endsection

@section('content')
@if(!isset($empty))
    @php
        $shipping=$sale_order->shipping->name ?? '';
        $state= $sale_order->shipping->id ?? '""';
        $valor= $sale_order->shipping->price ?? '0';
    @endphp
<div class="md:mx-5 lg:mx-auto lg:w-[987px] bg-black/75  pb-1 2xl:min-h-[374px] lg:min-h-[278px]"
    x-data="{shipping:'{{ $shipping }}', state:{{ $state }}, valor:{{ $valor }}, total0:'{{ Cart::instance('cart')->total() }}', total:'', open: {{ $open }}, map:{{ $state }},
    caltotal(){
        this.total = parseFloat(this.total0) + parseFloat(this.valor);
        this.total = this.total.toFixed(2); console.log(this.shipping+'-'+this.state+'-'+this.valor);
    },
    }" x-init="caltotal()"
>
    <div class="px-4 pb-4 grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="md:col-span-2 col-span-1">
            <div>
                <h5 class="p-2">TIPO DE ENVIO</h5>
            </div>
            <div class="space-y-4">
                {{-- contenido 1 --}}
                @if(isset($collectionState1))
                <div class="bg-gris-100 rounded-[3px] w-full" >
                    <div class="flex items-center px-4 py-2 rounded-[3px] cursor-pointer " x-on:click="if(open == 1) { open=0} else { open=1; }">
                        <div class="flex items-center space-x-5 justify-between w-full">
                            <h6>Envios Distritales a Lima</h6>

                        </div>
                        <div class="flex ml-4 w-fit">
                            <x-icons.chevron-down height="10px" width="10px" grosor="1" class="ml-auto"
                                ::class="{ 'rotate-180': open == 1  }" />
                        </div>


                    </div>


                    <div x-show="open == 1" x-cloak x-collapse {{--  x-on:click.away="open = false"  --}}>
                        <hr class="border-gris-70">
                        <div class="px-4 py-2 space-y-2">

                            @foreach ($collectionState1 as $key=>$district)

                            <div class="items-center rounded-[3px] border border-gris-60 bg-opacity-20 py-2 px-2 sm:px-5 text-[12px]" :class="state == {{ $district->id }} ? '!border-green-600 bg-green-900 text-gris-5' : ''">
                                <input  id="{{ $district->id }}" type="radio" class="hidden" :checked="state == {{ $district->id }}"/>
                                <label for="{{ $district->id }}" class="flex items-center cursor-pointer hover:text-gris-5" @click="shipping='{{ $district->name }}'; state={{ $district->id }}; valor={{ $district->price == 0 ? 0 : (session('location') === 'PE' ? $district->price:  ( $dolar != 0 ? number_format($district->price / $dolar, 2) : 0)) }}; caltotal(); map={{ $district->id }};" >
                                    <span class="w-4 h-4 inline-block mr-2 rounded-full border flex-no-shrink"></span>
                                    <p1>{{ $district->name }} </p1> <b class="ml-auto">{{ $district->price == 0 ? 'GRATIS' : (session('location') === 'PE' ? $district->price.' soles' : ('$ ' . ($dolar != 0 ? number_format($district->price / $dolar, 2) : 'GRATIS'))) }}
                                    </b>
                                    {{--  <img src="{{ asset('image/shipping/OLVA_Logo.png') }}" class="ml-auto h-[30px]" alt="">  --}}

                                    {{--  fin mapa  --}}
                            </label>
                            {{--  <p2>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia quo neque earum nesciunt</p2>  --}}
                            </div>
                            @endforeach

                        </div>



                    {{--      <div class="px-4 py-2 flex items-center">

                        </div>  --}}

                    </div>
                    <div x-show="open == 1">
                        {{--  <hr class="border-gris-70">  --}}
                        @foreach ($collectionState1 as $key=>$district)
                        @if($district->latitude)
                        <div class="px-4 py-2" x-show="map == {{ $district->id }}" x-collapse>
                            <p class="mb-2"><b>Dirección de Tienda</b></p>
                            <div id="mi_mapa{{ $district->id }}" class="my-4 w-full h-[203px] border border-gris-50 shadow rounded-[3px] z-0">
                            </div>
                        </div>
                        @endif
                        @endforeach

                    </div>
                </div>
                @endif
                {{-- fin del contenido 1 --}}
                {{-- contenido 2 --}}
                @if(isset($collectionState2))
                <div class="bg-gris-100 rounded-[3px] w-full" >
                    <div class="flex items-center px-4 py-2 rounded-[3px] cursor-pointer " x-on:click="if(open == 2) { open=0} else { open=2; } map=0;">
                        <div class="flex items-center space-x-5 justify-between w-full">
                            <h6>Envios a todo el Perú</h6>
                        </div>
                        <div class="flex ml-4 w-fit">
                            <x-icons.chevron-down height="10px" width="10px" grosor="1" class="ml-auto"
                                ::class="{ 'rotate-180': open == 2  }" />
                        </div>
                    </div>

                    <div x-show="open == 2" x-cloak x-collapse {{--  x-on:click.away="open = false"  --}}>
                        <hr class="border-gris-70">
                        <div class="px-4 py-2 space-y-2">
                            <p class="py-2">Elige tu currier</p>
                            @foreach ($collectionState2 as $key=>$nacional)
                            <div class="items-center rounded-[3px] border border-gris-60 bg-opacity-20 py-2 px-2 sm:px-5 text-[12px]" :class="state == '{{ $nacional->id }}' ? '!border-green-600 bg-green-900 text-gris-5' : ''">
                                <input id="{{ $nacional->id }}" :checked="state == '{{ $nacional->id }}'" type="radio" class="hidden"/>
                            <label for="{{ $nacional->id }}" class="flex items-center cursor-pointer hover:text-gris-5" @click="shipping='{{ $nacional->name }}'; state='{{ $nacional->id }}'; valor={{ session('location') === 'PE' ? $nacional->price : number_format($nacional->price / $dolar, 2) }}; caltotal()">
                                <span class="w-4 h-4 inline-block mr-2 rounded-full border flex-no-shrink"></span>
                                <p1>{{ $nacional->name }} : <b>{{ session('location') === 'PE' ? $nacional->price.' soles' : '$ '.number_format($nacional->price / $dolar, 2) }}  </b></p1>
                                <img src="{{ asset('storage/'.($nacional->url ?? 'image/dashboard/No_image_dark.png')) }}" class="ml-auto h-[30px]" alt="">
                            </label>
                            <p2>{{ $nacional->description }}</p2>
                            </div>
                            @endforeach
                        </div>


                    </div>
{{--                      <div x-show="open" x-cloak>
                        <hr class="border-gris-70">
                        <div class="px-4 py-2">
                            <p class="mb-2"><b>Envio a domicilio</b></p>



                        </div>
                    </div>  --}}
                </div>
                @endif
                {{-- fin del contenido 2 --}}
               {{-- contenido 3 --}}
               @if(isset($collectionState3))
               <div class="bg-gris-100 rounded-[3px] w-full" >
                <div class="flex items-center px-4 py-2 rounded-[3px] cursor-pointer " x-on:click="if(open == 3) { open=0} else { open=3; } map=0;">
                    <div class="flex items-center space-x-5 justify-between w-full">
                        <h6>Envios Internacionales</h6>

                    </div>
                    <div class="flex ml-4 w-fit">
                        <x-icons.chevron-down height="10px" width="10px" grosor="1" class="ml-auto"
                            ::class="{ 'rotate-180': open == 3  }" />
                    </div>


                </div>


                <div x-show="open == 3" x-cloak x-collapse {{--   x-on:click.away="open = false"  --}}>
                    <hr class="border-gris-70">
                    <div class="px-4 py-2 space-y-2">
                        <p class="py-2">Elige tu currier</p>
                        @foreach ($collectionState3 as $key=>$internacional)
                        <div class="items-center rounded-[3px] border border-gris-60 bg-opacity-20 py-2 px-2 sm:px-5 text-[12px]" :class="state == '{{ $internacional->id }}' ? '!border-green-600 bg-green-900 text-gris-5' : ''">
                            <input x-model="check" id="{{ $internacional->id }}" :checked="state == '{{ $internacional->id }}'" type="radio" class="hidden"/>
                        <label for="{{ $internacional->id }}" class="flex items-center cursor-pointer hover:text-gris-5" @click="shipping='{{ $internacional->name }}'; state='{{ $internacional->id }}'; valor={{ session('location') === 'PE' ? $internacional->price*$dolar : $internacional->price }}; caltotal()">
                            <span class="w-4 h-4 inline-block mr-2 rounded-full border flex-no-shrink"></span>
                            <p1>{{ $internacional->name }} : <b>{{ session('location') === 'PE' ? 'S/.'.$internacional->price*$dolar :'$ '.$internacional->price }}  </b></p1>
                            <img src="{{ asset('storage/'.($internacional->url ?? 'image/dashboard/No_image_dark.png')) }}" class="ml-auto h-[30px]" alt="">
                        </label>
                        <p2>{{ $internacional->description }}</p2>
                        </div>
                        @endforeach

                    </div>
                </div>

            </div>
            @endif
            {{-- fin del contenido 3 --}}
            </div>
        </div>


        <div x-data="{check: false}" {{--  x-init="if(shipping) { check = true }"  --}}>
            <div>
                <h5 class="p-2">TU PEDIDO</h5>
                <div class="bg-gris-100 p-4 rounded-[3px]">
                    <div>
                        <h5>Resumen de pedido</h5>
                        <div class="flex justify-between mt-8">
                            <p>Subtotal ({{ Cart::instance('cart')->content()->count() }})</p>
                            <p>{{session('currency')}}{{ Cart::instance('cart')->subtotal() }}</p>
                        </div>

                        <div class="flex justify-between mt-2">
                        <template x-if="shipping">
                            <div class="flex items-center">
                                <p>Envío</p>
                                <p2 x-text="'- '+shipping" class="ml-1"></p2>

                            </div>

                        </template>
                        <div  class="flex">
                            <template x-if="valor">
                                <p x-text="'{{session('currency')}} '+valor.toFixed(2)" class="ml-2"></p>
                            </template>

                        </div>
                        </div>
                    </div>
                </div>
                <hr class="border-gris-70">

                <div class="bg-gris-100 p-4 rounded-[3px]">
                    <div class="flex justify-between text-white">
                        <p>Total</p>
                        <div class="flex items-center"> <p x-text="'{{session('currency')}} '+total"></p></div>
                    </div>
                </div>
            </div>
            <div class="my-2 p-4">
                {{-- Mensaje de información para retiros --}}
                <div x-show="shipping && valor == 0"
                class="flex rounded-lg border border-green-600 bg-green-900 bg-opacity-20 p-2 mb-2 text-green-600 sm:px-5 text-[12px]">
                <div class="mt-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                        clip-rule="evenodd" />
                </svg></div>
                <p class="mx-1 text-[12px] "><b>Nota:</b> al finalizar la compra se le brindará un enlace para la coordinación del retiro o recojo de su pedido</p>
            </div>
                @foreach (Cart::instance('cart')->content() as $item)
                <div class="mb-4">
                    <div class="flex justify-between mb-1">
                        <p class="font-bold">{{ $item->name }}</p>
                        <p class="font-bold">{{session('currency')}} {{ $item->qty*$item->price }}</p>
                    </div>
                    <div class="grid grid-cols-3 gap-4">
                        <div class="col-span-1">
                            <a class="flex w-max items-center"
                                href="{{ route('web.shop.show',['product'=>$item->options->slug,'color'=>$item->options->color_id]) }}">
                                <x-outstock text="text-[10px]" class="!w-[50px] !h-[50px] md:!w-[65px] md:!h-[65px]"
                                    url="{{ $item->options->productImage }}" name="{{ $item->name }}"
                                    stock="{{ $item->options->stock }}" color="{{$item->options->hex}}" img="{{$item->options->src}}" param="scale-50 top-0 left-0"/>
                            </a>
                        </div>
                        <div class="col-span-2">
                            <p1>Precio unidad: {{session('currency')}}{{ $item->price }}</p1>
                            <p1>Color: {{ $item->options->color }}</p1>
                            <p1> {{ $item->qty == 1 ? '1 unidad' : $item->qty.' unidades' }}</p1>
                        </div>
                    </div>
                </div>
                @endforeach


            </div>
            <template x-if="shipping">
                <div>
                    <div class="flex items-center space-x-4">
                        <div>
                            <x-checkbox.webcheckbox @change="check= !check" ::value="check" />
                        </div>
                        <p1> Al registrarte estás aceptando los
                            <p1 />
                            <a href="#" class="text-[14px]"><b class="hover:text-corp-30"> Términos y
                                    Condiciones</b></a></label>
                    </div>
                    <div class="mt-4 select-none" :class="check ? '' : 'opacity-40 '">
                        <form action="{{ route('web.shop.checkout.forpay') }}" method="post" onsubmit="handleSubmit(event)">@csrf
                        <input type="text" x-model="total" name="total" hidden>
                        <input type="text" x-model="state" name="state" hidden>
                        <input type="text" name="id" value="{{ $id }}" hidden>
                        <input type="text" name='order_id' value="{{ $sale_order->id }}" hidden>
                        <x-button.websecondary type="submit" class="w-full " ::class="check ? '' :'cursor-not-allowed'"
                            ::disabled="!check" @click="$dispatch('heart')">Realizar Pedido
                        </x-button.websecondary>
                        </form>
                    </div>
                </div>
            </template>
        </div>

    </div>
</div>
<x-preloader.heart />
@else
<div class="md:mx-5 lg:mx-auto lg:w-[987px] bg-black/75  pb-1 2xl:min-h-[374px] lg:min-h-[278px] flex items-center ">
    <div class="text-center mx-auto">
    <h3 >No se han creado métodos de envios en el panel administrativo</h3>
    <a href="{{ route('mypage.shipping') }}" >
        <x-button.webprimary class="mt-4">Ir a métodos de envio</x-button-webprimary>
    </a>
    </div>
</div>
@endif
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

@if(isset($collectionState1))

@foreach ($collectionState1 as $key => $district)

@if ($district->latitude !== null)

<script>
    key = '{{ $key }}'; district= [];
    district[key] = '{{ $district->id }}';
    district['latitude'] = '{{ $district->latitude }}';
    district['longitude'] = '{{ $district->longitude }}';
    district['title'] = {!! json_encode($district->title) !!};
    district['url'] = `{{ asset('storage/image/marker-icon-2x2.png') }}`;

    let map{{ $district->id }} = L.map('mi_mapa{{ $district->id }}').setView([district['latitude'],district['longitude']],20);
    var myIcon = L.icon({
        iconUrl: district['url'],
        iconSize: [25, 41],
        popupAnchor: [0, -20],
    });
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> Lodomens'
    }).addTo(map{{ $district->id }});

    L.marker([district['latitude'], district['longitude']], {icon: myIcon}).addTo(map{{ $district->id }}).bindPopup(district['title'])
</script>
@endif
@endforeach

@endif
@endpush
