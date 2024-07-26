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
    id:'', counts: 1,
    color:'', location:' {{ session('location') ?? '' }}',
    url:'', route:'',
    skus: '',
    colorSelected:[], routeTemplate: '{{ $routeTemplate }}',
    get (e) {
        this.choose = e.choose;
        this.id = e.id;
        this.color = e.color;
        this.url = e.url;
        this.colorSelected = JSON.parse(e.colorSelected);
        this.route= this.routeTemplate.replace('PLACEHOLDER_ID', this.id).replace('PLACEHOLDER_COLOR', this.color);
        this.getskus();
    },
        getskus(data) {
        axios.get(this.route,data).then(response => {
            this.skus=response.data.skus;
            if(response.data.image){
                this.url= response.data.image;
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
    addToCart(){
        data =  {
                skus: this.skus,
                counts: this.counts,
                image: this.url,
                choose: this.choose
        };
        axios.post(this.routeCart,data).then(response => {
            window.location.href = response.data.redirect;
        }).catch(error => {
            console.error(error);
        });
    }


}" @go.window="get($event.detail);">


    <x-web.modal.modal>
        <x-slot name="title">
            <template x-if="choose == 'CART'">
                <h6>Agregando al Carrito</h6>
            </template>
            <template x-else>
                <h6>Agregando al Wishlist</h6>
            </template>
        </x-slot>
        <x-slot name="slot">
            <div class="bg-gris-90 px-2 md:px-6 py-3">
                <div class="md:flex space-x-2 md:space-x-7 md:justify-between">
                    <div class="flex justify-center space-x-5 md:w-full">
                        <lodo class="relative items-center  flex max-w-[200px] max-h-[200px] mx-auto md:!max-h-[136px] md:!w-1/2 h-full">
                            <img :src="'{{ asset('storage') }}'+'/'+url" class="mx-auto w-full h-full"
                                :alt="skus?.product?.name ?? ''">
                            <div class="absolute top-0 left-0 w-[100%] h-full flex items-center justify-center"
                                :class="skus.stock > 0 ? 'border-[2px]  border-corp-50 rounded-[3px]':'bg-black/80 border-[2px] border-corp-50 rounded-[3px]'">
                                <template x-if="skus.stock < 1">
                                    <span
                                        class="text-gris-20 font-bold  bg-gris-90 p-2 border-[2px]  border-corp-50 rounded-[3px]">SIN
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

</div>
@endsection

@push('scripts')
<script>
    function showCartModall(a,b,c,d,e){
        const event = new CustomEvent('go', {
            detail: {
                id:  a,
                color: b,
                url: c,
                colorSelected: d,
                choose:e,
                time: new Date()
            }
        });
        window.dispatchEvent(event);

    }
</script>

@endpush
