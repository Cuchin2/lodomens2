@extends('layouts.web')
@section('breadcrumb')
<x-breadcrumb.lodomens.breadcrumb title="TIENDA">
    <x-breadcrumb.lodomens.breadcrumb2 name='Tienda' />
</x-breadcrumb.lodomens.breadcrumb>
@endsection
@section('content')
<x-lodomens.video />
<div x-data="{ open: window.innerWidth > 1024, open2: false, sort:3}" x-init="window.addEventListener('resize', () => {
            console.log(window.innerWidth,open);
            if(window.innerWidth > 1024){
            open = true;} else { open = false}
        });" class="pb-4 lg:px-[177px]">
        {{--  MENU DE FILTROS  --}}
    <div
        class="fixed w-full bg-black z-20 left-1/2 transform -translate-x-1/2 md:top-[159px]">
        <div class="flex py-3 mx-auto items-center sm:w-[442px] md:w-[711px] lg:w-[962px] xl:w-[1115px]">
            <div class="w-[34px] h-[34px] bg-gris-90 rounded p-1 cursor-pointer" @click="open=!open">
                <x-icons.chevron-left height="22px" width="22px" grosor="2" class="p-1" />
            </div>
            <div class="hidden md:block w-fit mx-3 whitespace-nowrap">
                <p>107 Resultados</p>
            </div>
            <div class="mx-3 w-full">
                <div class="relative">
                    <x-icons.search class="absolute right-1 top-1 h-[20px] w-[20px] fill-gris-10" />
                    <input type="text"
                        class="text-gris-60 bg-black h-[30px]  text-[12px] pr-[26px] rounded-[3px] focus:ring-gris-50 focus:border-gris-50 w-full "
                        placeholder="Buscar" required="" x-cloak>
                </div>
            </div>
            <div class="hidden md:block w-full mx-3">
                <x-select>
                    <option>Option 1</option>
                    <option>Option 2</option>
                    <option>Option 3</option>
                </x-select>
            </div>
            <div class="flex my-auto">
                <div class="w-fit bg-gris-90 rounded p-1 ml-auto cursor-pointer md:hidden block"
                    @click="open2 = !open2">
                    <x-icons.chevron-down height="20px" width="20px" grosor="2" class="p-1" />
                </div>
                <div class=" rounded p-1 ml-auto cursor-pointer md:flex hidden w-[34px] h-[34px]" :class="{ 'bg-gris-70 text-white': sort === 1, 'bg-gris-90': sort !== 1 }">
                    <x-icons.format_list_bulleted class=" mx-auto my-auto"  @click="sort=1" />
                </div>
{{--                  <div class="bg-gris-90 rounded p-1 ml-auto cursor-pointer md:flex hidden w-[34px] h-[34px]">
                    <x-icons.grid_on class=" mx-auto my-auto" />
                </div>  --}}
                <div class="rounded p-1 ml-auto cursor-pointer md:flex hidden w-[34px] h-[34px]" :class="{ 'bg-gris-70 text-white': sort === 2, 'bg-gris-90': sort !== 2 }">
                    <x-icons.window class=" mx-auto my-auto"  @click="sort=2"/>
                </div>
                <div class=" rounded p-1 ml-auto cursor-pointer md:flex hidden w-[34px] h-[34px] " :class="{ 'bg-gris-70 text-white': sort === 3, 'bg-gris-90': sort !== 3 }">
                    <x-icons.auto_awesome_mosaic class=" mx-auto my-auto" @click="sort=3"/>
                </div>
            </div>
        </div>
    </div>
    <div class="flex justify-center pt-[54px] bg-black/75">
        {{-- <div class="lg:block hidden lg:bg-red-700 w-40 h-auto m-2"> </div> --}}
        {{-- menu 1 --}}
        <div class="fixed top-[126px] md:top-0 z-10 left-0 md:relative lg:w-[210px] w-1/2 md:w-1/4 h-full md:h-auto md:ml-[7px] pt-[4px]"
            x-data="{menu1 : 0}" x-show="open" @click.away="if (window.innerWidth < 1024) {
                    open = false;
                }" {{-- @click.away="open=false" --}}
            x-transition:enter="transition ease-out duration-300 md:duration-0 -ml-64  " x-transition:enter-start=""
            x-transition:enter-end="transform translate-x-64 md:translate-x-[0px] "
            x-transition:leave="transition ease-out duration-300 md:duration-0 " x-transition:leave-start=""
            x-transition:leave-end="transform -translate-x-64 md:-translate-x-[0px]">
            <div class="h-full bg-gris-90 lg:w-[120px] xl:w-[210px]">
            <ul class="md:fixed  md:w-[148px] lg:w-[120px] xl:w-[207px] ">
                <li class="mr-6 p-2 ">
                    <a class="text-gris-10 hover:text-red-600 text-[12px]">FILTROS</a>
                </li>
                <li class="border-[1px] border-gris-70"></li>
                <li class=" p-2" @click="menu1 = (menu1 === 1) ? 0 : 1">
                    <div class="text-gris-10  cursor-pointer">
                        <div class="hover:text-red-600 text-[12px] text-gris-10 flex items-center">CATEGORIAS
                            <x-icons.chevron-right height="10px" width="10px" grosor="1" class="ml-auto"
                                ::class="{'rotate-90 transition-all': menu1 === 1}" />
                        </div>
                        <ul x-show="menu1===1" x-collapse x-cloak class="w-fit text-[12px] ml-2">
                            @foreach ($categories as $category)
                            <li class="hover:text-corp-30">{{ $category->name }}</li>
                            @endforeach


                        </ul>
                    </div>
                </li>
                <li class=" p-2" @click="menu1 = (menu1 === 2) ? 0 : 2">
                    <dis class="text-gris-10  cursor-pointer">
                        <div class="hover:text-red-600 text-[12px] text-gris-10 flex items-center">MARCAS
                            <x-icons.chevron-right height="10px" width="10px" grosor="1" class="ml-auto"
                                ::class="{'rotate-90 transition-all': menu1 === 2}" />
                        </div>
                        <ul x-show="menu1===2" x-collapse x-cloak class="w-fit text-[12px] ml-2">
                            @foreach ($brands as $brand)
                            <li class="hover:text-corp-30">{{ $brand->name }}</li>
                            @endforeach
                        </ul>
                    </dis>
                </li>
                <li class="mr-6 p-2">
                    <a class="text-gris-10 hover:text-red-600 text-[12px]">COLOR</a>
                </li>
                <li class="mr-6 p-2">
                    <a class="text-gris-10 hover:text-red-600 text-[12px]">CALIFICACIONES</a>
                </li>
            </ul>
            </div>
        </div>
        {{-- FIN menu 1 --}}
        <div :class="{
            'grid-cols-2 lg:grid-cols-5 md:grid-cols-4': !open && sort === 3,
            'grid-cols-2 lg:grid-cols-4 md:grid-cols-3': (open && sort === 3) || (!open && sort === 2),
            'grid-cols-2 lg:grid-cols-3 md:grid-cols-2': open && sort === 2,
            'mt-1 md:mt-0': true,
        }" class="grid">
            @foreach ($products as $product )
            <div class="px-2 mx-auto relative my-[8px]" x-data="{icon:false}">
                <a href="{{route('web.shop.show',$product)}}" x-on:mouseover="icon=true" x-on:mouseleave="icon=false" :class="{'flex':sort===1}">
                    <img src="{{ asset('storage/'.$product->images[0]->url) }}" class="border-[2px] border-corp-50 rounded-[3px]"
                        alt="{{ $product->name }}" :class="{'h-[210px] m-auto':sort===1}">
                    <div class="absolute right-0 top-0 p-[14px] " x-show="(icon && sort !== 1 )|| sort === 1">
                        <x-icons.heart class="h-[20px] w-[20px] fill-gris-10 hover:fill-white cursor-pointer mb-2" />
                        <x-icons.cart class="h-[20px] w-[20px] fill-gris-10 hover:fill-white cursor-pointer" x-show="sort !==1"/>
                    </div>
                    <div class="m-2 leading-[1.2]" x-show="sort===3" x-cloak>
                        <p class="text-[14px] md:text-[18px] ">{{ $product->name }}</p>
                        <p class="text-[18px] md:text-[22px]">S/. {{ $product->sell_price }}</p>
                    </div>
                    <div x-show="sort===1" x-cloak class="px-8">
                        <h3>{{ $product->name }}</h3>
                        <div class="mb-2 cursor-pointer flex">
                            <x-star class="h-5 w-5" star=" {{ round($product->reviews->avg('score'), 1)*20 }}"/>
                            <p class="text-gris-30"> - {{ $product->reviews->count() }} reseñas -</p>
                        </div>
                        <div class="flex space-x-3">
                            <h4>S/. {{ $product->sell_price }}</h4>
                            <h5 class="line-through text-gris-70">S/.65 </h5>
                        </div>
                        <p class="mt-4 text-justify">{{ $product->short_description }}</p>
                        <button class="bg-corp-50 rounded-[3px] px-4 my-4">
                            Añadir a Carrito
                        </button>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
    {{-- menu 2 --}}

    <div class="absolute top-[47px] z-10 right-5">
        <ul class=" bg-gris-90 md:hidden rounded" x-show="open2" x-collapse x-cloak @click.away="open2 = false">
            <li class="mr-6 p-2 ">
                <a class="text-gris-10 hover:text-red-600 text-[12px] ">FILTROS</a>
            </li>
            <li class="border-[1px] border-gris-70"></li>
            <li class="mr-6 p-2">
                <ul class="text-gris-10 hover:text-red-600 text-[12px]">Categorías</ul>
            </li>
            <li class="mr-6 p-2">
                <a class="text-gris-10 hover:text-red-600 text-[12px]">TIENDA</a>
            </li>
            <li class="mr-6 p-2">
                <a class="text-gris-10 hover:text-red-600 text-[12px]">CONTACTO</a>
            </li>
        </ul>
    </div>

    {{-- FIN menu 2 --}}


</div>
@endsection
