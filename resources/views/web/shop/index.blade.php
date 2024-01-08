@extends('layouts.web')

@section('content')
<div x-data="{ open: window.innerWidth > 1024, open2: false}"
        x-init="window.addEventListener('resize', () => {
            console.log(window.innerWidth,open);
            if(window.innerWidth > 1024){
            open = true;} else { open = false}
        });">
    <x-breadcrumb.lodomens.breadcrumb title="TIENDA">
        <x-breadcrumb.lodomens.breadcrumb2 name='Tienda' />
        </x-breadcrumb.lodomens.breadcrumb2>

        <div class="container text-gris-10 mx-auto px-[20px] relative">
            <div class="flex py-3 mx-auto max-w-[1100px]">
                <div class="w-[30px]  bg-gris-90 rounded p-1 cursor-pointer" @click="open=true"
                    >
                    <x-icons.chevron-left height="20px" width="20px" grosor="2" class="p-1" />
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
                <div  class="hidden md:block w-full mx-3">
                    <select name="secondary_color_select" id="secondary_color_select" class="text-gris-60 bg-black h-[30px]  text-[12px]  rounded-[3px] focus:ring-gris-50 focus:border-gris-50 w-full p-0 pl-2">
                        <option disabled selected>Ordenar por</option>
                        <option>Option 1</option>
                        <option>Option 2</option>
                        <option>Option 3</option>
                    </select>
                </div>
                <div class="flex">
                    <div class="w-fit bg-gris-90 rounded p-1 ml-auto cursor-pointer md:hidden block " @click="open2 = !open2">
                        <x-icons.chevron-down height="20px" width="20px" grosor="2" class="p-1" />
                    </div>
                    <div class="bg-gris-90 rounded p-1 ml-auto cursor-pointer md:block hidden">
                        <x-icons.chevron-down height="20px" width="20px" grosor="2" class="p-1" />
                    </div>
                    <div class="bg-gris-90 rounded p-1 ml-auto cursor-pointer md:block hidden">
                        <x-icons.chevron-down height="20px" width="20px" grosor="2" class="p-1" />
                    </div>
                    <div class="bg-gris-90 rounded p-1 ml-auto cursor-pointer md:block hidden">
                        <x-icons.chevron-down height="20px" width="20px" grosor="2" class="p-1" />
                    </div>
                    <div class="bg-gris-70 rounded p-1 ml-auto cursor-pointer md:block hidden text-white">
                        <x-icons.chevron-down height="20px" width="20px" grosor="2" class="p-1" />
                    </div>
                </div>
            </div>
            <div class="flex space-x-4  {{--  items-center  --}} justify-center">
                {{--  <div class="lg:block hidden lg:bg-red-700 w-40 h-auto m-2"> </div>  --}}
                {{-- menu 1 --}}
                <div class="absolute top-[44px] lg:top-[7px] z-10 left-0 lg:relative lg:w-[170px]" x-data="{menu1 : 0}"  x-show="open"
                @click.away="if (window.innerWidth < 1024) {
                    open = false;
                }"
                x-transition:enter="transition ease-out duration-300 -ml-64"
                x-transition:enter-start=""
                x-transition:enter-end="transform translate-x-64"
                x-transition:leave="transition ease-out duration-300"
                x-transition:leave-start=""
                x-transition:leave-end="transform -translate-x-64"
                >
                <ul class=" bg-gris-90 h-fit">
                    <li class="mr-6 p-2 ">
                        <a class="text-gris-10 hover:text-red-600 text-[12px]">FILTROS</a>
                    </li>
                    <li class="border-[1px] border-gris-70"></li>
                    <li class=" p-2" @click="menu1 = (menu1 === 1) ? 0 : 1" >
                        <div class="text-gris-10  cursor-pointer">
                            <div class="hover:text-red-600 text-[12px] text-gris-10 flex items-center">Categorías <x-icons.chevron-right height="10px" width="10px" grosor="1" class="ml-auto" ::class="{'rotate-90 transition-all': menu1 === 1}"/></div>
                            <ul x-show="menu1===1" x-collapse x-cloak class="w-fit text-[12px] ml-2">
                            <li>Categoría 1</li>
                            <li>Categoría 2</li>
                            <li>Categoría 3</li>
                            </ul>
                        </div>
                    </li>
                    <li class=" p-2" @click="menu1 = (menu1 === 2) ? 0 : 2">
                        <dis class="text-gris-10  cursor-pointer">
                            <div class="hover:text-red-600 text-[12px] text-gris-10 flex items-center">Marcas <x-icons.chevron-right height="10px" width="10px" grosor="1" class="ml-auto" ::class="{'rotate-90 transition-all': menu1 === 2}"/></div>
                            <ul x-show="menu1===2" x-collapse x-cloak  class="w-fit text-[12px] ml-2">
                            <li>Marca 1</li>
                            <li>Marca 2</li>
                            <li>Marca 3</li>
                            </ul>
                        </dis>
                    </li>
                    <li class="mr-6 p-2">
                        <a class="text-gris-10 hover:text-red-600 text-[12px]">TIENDA</a>
                    </li>
                    <li class="mr-6 p-2">
                        <a class="text-gris-10 hover:text-red-600 text-[12px]">CONTACTO</a>
                    </li>
                    </ul>
                </div>
                {{-- FIN menu 1 --}}
                <div class="grid grid-cols-2 md:grid-cols-4">
                    <div class="p-2 mx-auto relative">
                        <img src="{{ asset('image/lodomens/Producto_1.png') }}" class=" border-[1px] border-corp-50" alt="">
                        <div class="absolute right-0 top-0 p-[14px]">
                            <x-icons.heart  class="h-[20px] w-[20px] fill-white hover:fill-corp-50 cursor-pointer mb-2"/>
                            <x-icons.cart class="h-[20px] w-[20px] fill-white hover:fill-corp-50 cursor-pointer"/>
                        </div>
                        <div class="m-2 leading-[1.2]">
                            <p>Anillo Serpiente</p>
                            <p>S/. 50</p>
                        </div>
                    </div>
                    <div class="p-2 mx-auto relative">
                        <img src="{{ asset('image/lodomens/Producto_2.png') }}" class=" border-[1px] border-corp-50" alt="">
                        <div class="absolute right-0 top-0 p-[14px]">
                            <x-icons.heart  class="h-[20px] w-[20px] fill-white hover:fill-corp-50 cursor-pointer mb-2"/>
                            <x-icons.cart class="h-[20px] w-[20px] fill-white hover:fill-corp-50 cursor-pointer"/>
                        </div>
                        <div class="m-1 leading-[1.2]">
                            <p>Anillo Serpiente</p>
                            <p>S/. 50</p>
                        </div>
                    </div>
                    <div class="p-2 mx-auto relative">
                        <img src="{{ asset('image/lodomens/Producto_3.png') }}" class=" border-[1px] border-corp-50" alt="">
                        <div class="absolute right-0 top-0 p-[14px]">
                            <x-icons.heart  class="h-[20px] w-[20px] fill-white hover:fill-corp-50 cursor-pointer mb-2"/>
                            <x-icons.cart class="h-[20px] w-[20px] fill-white hover:fill-corp-50 cursor-pointer"/>
                        </div>
                        <div class="m-1 leading-[1.2]">
                            <p>Anillo Serpiente</p>
                            <p>S/. 50</p>
                        </div>
                    </div>
                    <div class="p-2 mx-auto relative">
                        <img src="{{ asset('image/lodomens/Producto_4.png') }}" class=" border-[1px] border-corp-50" alt="">
                        <div class="absolute right-0 top-0 p-[14px]">
                            <x-icons.heart  class="h-[20px] w-[20px] fill-white hover:fill-corp-50 cursor-pointer mb-2"/>
                            <x-icons.cart class="h-[20px] w-[20px] fill-white hover:fill-corp-50 cursor-pointer"/>
                        </div>
                        <div class="m-1 leading-[1.2]">
                            <p>Anillo Serpiente</p>
                            <p>S/. 50</p>
                        </div>
                    </div>
                </div>
            </div>
                {{-- menu 2 --}}

                <div class="absolute top-[47px] z-10 right-5">
                    <ul class=" bg-gris-90 md:hidden rounded"
                    x-show="open2" x-collapse x-cloak @click.away="open2 = false">
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
                        <a class="text-gris-10 hover:text-red-600 text-[12px]" >CONTACTO</a>
                    </li>
                    </ul>
                </div>

                {{-- FIN menu 2 --}}

        </div>




</div>
@endsection
