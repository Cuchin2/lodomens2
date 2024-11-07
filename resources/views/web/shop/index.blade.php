@extends('layouts.web')
@section('breadcrumb')
<x-breadcrumb.lodomens.breadcrumb title="TIENDA">
    <x-breadcrumb.lodomens.breadcrumb2 name='Tienda' />
</x-breadcrumb.lodomens.breadcrumb>
@endsection
@section('content')
{{--
<x-lodomens.video /> --}}
<livewire:shop-main cat_id="{{ $category_id ?? '' }}"/>
{{--
<livewire:shop-main-modal /> --}}
@php
$routeTemplate = route('get.skus', ['id' => 'PLACEHOLDER_ID', 'color' => 'PLACEHOLDER_COLOR']);
$routeCart = route('addcart');
@endphp
<div x-data="{
    choose :'', active:0, routeCart: '{{ $routeCart }}',
    id:'', counts: 1, open:false, show:false, message:'', wishmessage: '',
    color:'', location:' {{ session('location') ?? '' }}',
    url:'', route:'',
    showBtn: false,
    isVideo: null,
    skus: '', hex:'', src:'',
    colorSelected:[], routeTemplate: '{{ $routeTemplate }}',
    get (e) {
        this.choose = e.choose; this.counts=1;
        this.id = e.id;
        this.color = e.color;
        this.url = e.url; console.log(this.url);
        this.checkextension(this.url);
        this.colorSelected = JSON.parse(e.colorSelected);
        this.route= this.routeTemplate.replace('PLACEHOLDER_ID', this.id).replace('PLACEHOLDER_COLOR', this.color);
        this.getskus(); this.hex=e.hex; this.src=e.src;
    },
        getskus(data) {
        axios.get(this.route,data).then(response => {
            this.skus=response.data.skus;
            if(response.data.image){
                this.url= response.data.image;
                console.log(this.url);
                this.checkextension(this.url);

            }
            $dispatch('fire'); this.loading=true;
        }).catch(error => {
            console.error(error);
        });
    },
    changeColor(index,skuproductid,colorid)
    {
    this.route= this.routeTemplate.replace('PLACEHOLDER_ID', skuproductid).replace('PLACEHOLDER_COLOR', colorid);
    data =  {
            params: {
                name: 'image'
            }
        };
    this.getskus(data);
    this.active = index; this.counts=1;
    },
        decreaseCount() {
        if (this.counts > 0) {
            this.counts--; // Lógica para disminuir el conteo
            this.changePrice(); // Llama a la función para cambiar el precio
        }
    },

    increaseCount() {
        this.counts++; // Lógica para aumentar el conteo
        this.changePrice(); // Llama a la función para cambiar el precio
    },

    changePrice() {
         if (!Number.isFinite(this.counts) || this.counts < 1) {
            this.counts = 1;
        }
        else  {
            if((this.counts > this.skus.stock))
            { this.counts = this.skus.stock; }
        };
    },
    toWishlist(){
    window.location.href = '{{ route('web.shop.webdashboard.wishlist') }}';
    },
    addToCart(){
        data =  {
                skus: this.skus,
                counts: this.counts,
                image: this.url,
                choose: this.choose,
                hex: this.hex,
                src: this.src
        };
        axios.post(this.routeCart,data).then(response => {
        $dispatch('cart-added');
        if(response.data.message){
        this.open=true;
        this.message=response.data.message;
        console.log(response.data.cart); }
        else{ {{--  window.location.href = response.data.redirect;  --}} $dispatch('wishlist-added'); this.open = true;

            this.wishmessage = response.data.wishmessage;
        }
        }).catch(error => {
            console.error(error);
        });
    },
    checkextension(url) {
        const extension = url.split('.').pop().toLowerCase();
        const videoExtensions = ['mp4', 'webm', 'mov','avi'];
        this.isVideo = videoExtensions.includes(extension);
                                           },


}" @go.window="get($event.detail);">


    <x-web.modal.modal>
        <x-slot name="title">
            <template x-if="choose == 'CART'">
                <h6>Agregando al Carrito</h6>
            </template>
            <template x-if="choose !== 'CART'">
                <h6>Agregando al Wishlist</h6>
            </template>
        </x-slot>
        <x-slot name="slot">
            <div class="bg-gris-90 px-2 md:px-6 py-3">
                <div class="md:flex space-x-2 md:space-x-7 md:justify-between">
                    <div class="flex justify-center space-x-5 md:w-full">
                        <lodo class="relative items-center  flex max-w-[200px] max-h-[200px] mx-auto md:!max-h-[136px] md:!w-1/2 h-full overflow-hidden"
                            @mouseenter="showBtn = true"
                            @mouseleave="showBtn = false"
                        >
                            <img class="absolute top-3 left-2 scale-75 z-50" :src="'{{ asset('storage')}}'+'/'+src" alt="">
                            <template x-if="isVideo">
                                <video :src="'{{ asset('storage') }}'+'/'+url" class="rounded-[3px]  w-full h-full border-corp-50 border-[3px]" style="z-index: 20" controls>
                            </template>
                            <template x-if="!isVideo">
                                <img :src="'{{ asset('storage') }}'+'/'+url" class="mx-auto w-full h-full transition duration-500"
                                :class="showBtn ? 'scale-125' : ''"
                                :alt="skus?.product?.name ?? ''">
                            </template>

                            <div class="absolute top-0 left-0 w-[100%] h-full flex items-center justify-center" :style="'border-color: ' + hex"
                                :class="skus.stock > 0 ? 'border-[2px]  rounded-[3px]':'bg-black/80 border-[2px]  rounded-[3px]'">
                                <template x-if="skus.stock < 1">
                                    <span
                                        class="text-gris-20 font-bold  bg-gris-90 p-2 border-[2px]  rounded-[3px]" :style="'border-color: ' + hex">SIN
                                        STOCK</span>
                                </template>
                            </div>
                        </lodo>
                        <div class="space-y-4 md:w-full">
                            <div class="md:flex md:items-center md:justify-between">
                                <h6 x-text="skus?.product?.name ?? ''"></h6>
                                <p class="text-[13px] md:text-[15px]" x-text="'SKU : '+skus.code"></p>
                            </div>
                            <div>
                                <p x-text="'Precio unidad: {{ session('currency') }}'+skus.sell_price"></p>
                                <p x-text="'Color: '+(skus?.color?.name ?? '')"></p>
                            </div>
                            <div>
                                <p
                                    x-text="skus.stock < 2 ? (skus.stock == 1 ? 'Queda: 1 unidad' : 'Fuera de stock') : 'Quedan: ' + skus.stock + ' unidades'">
                                </p>
                            </div>
                            <div class="flex my-4 space-x-1">
                                <p class="font-bold" x-text="colorSelected.length == 1 ? 'COLOR' : 'COLORES'"></p>
                                <div class="flex space-x-2">
                                    <template x-for="(color, index) in colorSelected" :key="index">
                                        <div class="h-[27px] w-[27px] rounded-full cursor-pointer hover:border-corp-50 hover:border-[3px]"
                                            :class="active == index ? 'border-corp-50 border-[3px]' : ''"
                                            :style="{   background: (color.url ? 'url(' + '{{ asset('storage') }}' + '/' + color.url + ')' : color.hex)  }"
                                            @click="changeColor(index,skus.product.id,color.id)">
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="flex md:block justify-between mt-4 md:mt-0">
                        <h4 class="flex justify-end md:mb-8 whitespace-nowrap"
                            x-text="'{{ session('currency') }}'+' '+skus.sell_price"> </h4>
                        <div class="flex space-x-2">
                            <template x-if="skus.stock > 0">
                                <div class="flex">
                                    <div class="cursor-pointer hover:border-gris-10 hover:text-gris-10 text-gris-60 bg-transparent h-[26px] border-[1px] text-[12px] rounded-l-[3px] border-gris-30 w-[30px] flex items-center"
                                        @click="decreaseCount">
                                        <x-icons.chevron-left grosor="1" height="17px" width="17px"
                                            class="p-1 mx-auto fill-gris-30" />
                                    </div>

                                    <div>
                                        <input
                                            class="text-gris-10 font-bold bg-transparent h-[26px] mx-auto text-[12px] p-2 focus:ring-gris-50 focus:border-gris-50 w-[47px] border-gris-30 text-center border-x-0"
                                            placeholder=" " required="" x-model.number="counts" @change="changePrice">
                                    </div>

                                    <div class="cursor-pointer hover:border-gris-10 hover:text-gris-10 text-gris-60 bg-transparent h-[26px] border-[1px] text-[12px] rounded-r-[3px] border-gris-30 w-[30px] flex items-center"
                                        @click="increaseCount">
                                        <x-icons.chevron-right grosor="1" height="17px" width="17px"
                                            class="p-1 mx-auto fill-gris-30" />
                                    </div>
                                </div>

                            </template>
                            <div>
                                <a class="cursor-pointer" @click="show=false">
                                    <x-icons.trash class="w-5 fill-corp-30" />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </x-slot>
        <x-slot name="footer">
            <x-button.corp_secundary @click="show = false">Cancelar</x-button.corp_secundary>
            <template x-if="skus.stock > 0">
                <x-button.corp1 @click="addToCart(), show=false;">
                    <p1 x-text="choose == 'CART' ? 'Agregar al Carrito' : 'Agregar al Wishlist'"></p1>
                </x-button.corp1>
            </template>

        </x-slot>
    </x-web.modal.modal>


    {{--  modal de stock  --}}

    <div
    x-on:close.stop="open = false"
    x-on:keydown.escape.window="open =false"
    x-show="open"
    class="jetstream-modal fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50"
    style="display: none;"
>
    <div x-show="open" class="fixed inset-0 transform transition-all" x-on:click="open = false" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0">
        <div class="absolute inset-0  bg-black/40"></div>
    </div>
    <div class="flex items-center h-full">
    <div x-show="open" class="  bg-gris-90 rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-md sm:mx-auto"
                    x-trap.inert.noscroll="open"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                    <div class="px-6 py-4">
                        <div class="text-lg font-medium  text-gris-10 mb-3">
                            <h4 class="mx-auto w-fit">Anuncio</h3>
                        </div>


                        <div class="mt-4 text-[15px]  text-gris-10">
                             <template x-if="message == 'No hay suficiente stock disponible'">
                                <x-web.special.alert scale="0.75"/>
                            </template>
                            <template x-if="message !== 'No hay suficiente stock disponible'" >
                                <x-elements.success scale="0.75" />
                            </template>
                            <div x-show="choose == 'CART'" class="mt-2">
                            <p x-text="message" class="text-center"></p>
                            </div>
                            <div x-show="choose !== 'CART'" class="mt-2">
                                <p x-text="wishmessage" class="text-center"></p>
                             </div>
                        </div>
                    </div>

                    <div class="flex flex-row justify-center px-6 py-4 bg-gris-90 text-center">
                       {{--   {{ $footer }}  --}}

                        <x-button.corp_secundary @click="open = false">Salir</x-button.corp_secundary>

                     <template  x-if="choose !== 'CART'">
                        <x-button.corp1 @click="toWishlist(), open=false;">
                            <p1>Aceptar</p1>
                        </x-button.corp1>
                    </template>
                    </div>
    </div>
    </div>
</div>
</div>
@endsection

@push('scripts')
<script>
    function showCartModall(a,b,c,d,e,f,g){
        const event = new CustomEvent('go', {
            detail: {
                id:  a,
                color: b,
                url: c,
                colorSelected: d,
                choose:e,
                hex:f,
                src:g,
                time: new Date()
            }
        });
        window.dispatchEvent(event);

    }
</script>

@endpush
