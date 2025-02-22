<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div x-data="{ open: window.innerWidth > 1024, open2: false, sort: 3, show: false }" x-init="window.addEventListener('resize', () => {
        console.log(window.innerWidth, open);
        if (window.innerWidth < 671) { sort = 3; }
        if (window.innerWidth > 1024) {
            open = true;
        } else { open = false }
    });"
        class="pb-4 sm:w-[442px] md:w-[711px] lg:w-[962px] xl:w-[1115px] mx-auto"
        @out.window="if(window.innerWidth < 768) { open = false; }">
        {{-- MENU DE FILTROS --}}
        <div
            class="fixed w-full sm:w-[442px] md:w-[711px] lg:w-[962px] xl:w-[1115px] bg-black z-30 left-1/2 transform -translate-x-1/2 md:top-[159px] px-3">
            <div class="flex py-3 mx-auto items-center">
                <div class="!w-[40.5px] h-[34px] bg-gris-90 rounded p-1 cursor-pointer flex items-center mr-2"
                    @click="open=!open;">
                    <x-icons.chevron-left height="22px" width="22px" grosor="2" class="p-1 mx-auto" />
                </div>
                <div class="hidden md:block w-fit mx-[50px] whitespace-nowrap">
                    <p>{{-- 107 --}} {{ $this->products->count() }}
                        {{ $this->products->count() == 1 ? 'Resultado' : 'Resultados' }}</p>
                </div>
                <div class="w-full">
                    <div class="relative">
                        <x-icons.search class="absolute right-1 top-[6px] h-[18px] w-[18px] fill-gris-30" />
                        <input type="text" wire:model.live.debounce.300ms="search"
                            class="text-gris-10 bg-black h-[30px] placeholder:text-gris-30 border-[1.5px] focus:border-gris-50 focus:ring-gris-50 text-[12px] pr-[26px] rounded-[3px] border-gris-50 w-full "
                            placeholder="Buscar" required="" x-cloak>
                    </div>
                </div>
                <div class="{{--  hidden md:block  --}} md:w-1/3  w-1/2 md:mx-4 mx-2 hidden md:block">
                    <x-select-livewire wire:model="selectedOption" :options="[
                        '' => 'Ordenar por',
                        'asc' => 'Precio de menor a mayor',
                        'desc' => 'Precio de mayor a menor',
                        'new' => 'Productos nuevos',
                    ]" />
                </div>
                <div class="flex my-auto ml-2 md:ml-0">
                    <div class="w-[34px] h-[34px] bg-gris-90 rounded p-1 cursor-pointer flex items-center md:hidden"
                        @click="open2 = !open2">
                        <x-icons.chevron-down height="20px" width="20px" grosor="2" class="p-1 mx-auto" />
                    </div>
                    <div class="rounded-l-[3px] p-1 ml-auto cursor-pointer md:flex hidden w-[34px] h-[34px]"
                        :class="{ 'bg-gris-70 text-white': sort === 1, 'bg-gris-90': sort !== 1 }">
                        <x-icons.format_list_bulleted class=" mx-auto my-auto" @click="sort=1" />
                    </div>
                    <div class="p-1 ml-auto cursor-pointer md:flex hidden w-[34px] h-[34px]"
                        :class="{ 'bg-gris-70 text-white': sort === 2, 'bg-gris-90': sort !== 2 }">
                        <x-icons.window class=" mx-auto my-auto" @click="sort=2" />
                    </div>
                    <div class="rounded-r-[3px] p-1 ml-auto cursor-pointer md:flex hidden w-[34px] h-[34px] "
                        :class="{ 'bg-gris-70 text-white': sort === 3, 'bg-gris-90': sort !== 3 }">
                        <x-icons.auto_awesome_mosaic class=" mx-auto my-auto" @click="sort=3" />
                    </div>
                </div>
            </div>
        </div>
        <div class="flex pt-[50px] bg-black/75">
            {{-- menu 1 --}}
            <div class="fixed md:min-h-[208px] xl:min-h-[304px] top-[126px] md:top-0 z-20 left-0 md:relative lg:w-[210px] w-1/2 md:w-1/4 h-full md:h-auto md:ml-[7px] pt-[4px]"
                x-data="{ menu1: 0 }" x-show="open"
                @click.away="if (window.innerWidth < 1024) {
                open = false;
            }">
                <div class="h-full bg-gris-90 md:w-[148px] lg:w-[205px] md:relative rounded-[3px]">
                    <ul class="md:fixed bg-gris-90 md:w-[148px] lg:w-[205px]  rounded-[3px] h-fit md:max-h-full overflow-hidden xl:px-3"
                        @click.away="menu1 = 0">
                        <li class="p-2 ">
                            <div class="flex justify-between items-center">
                                <p1 class=" hover:text-white">Filtros</p1>
                                @if ($cat || $rating || $bra || $gam || $type_name || $material_name)
                                    <div wire:click="clean()" class="hover:text-white cursor-pointer"
                                        @click="if(window.innerWidth < 768) { open = false; }">
                                        <x-icons.cross class="h-2 w-2" />
                                    </div>
                                @endif

                            </div>
                            <div class="flex flex-wrap gap-1">
                                @if ($type_name)
                                    <x-web.special.filter wire:click="typerized('','')"
                                        @click="if(window.innerWidth < 768) { open = false; }">{{ $type_name }}</x-web.special.filter>
                                @endif
                                @if ($cat)
                                    <x-web.special.filter wire:click="categorized('','')"
                                        @click="if(window.innerWidth < 768) { open = false; }">{{ $cat }}</x-web.special.filter>
                                @endif
                                @if ($bra)
                                    <x-web.special.filter wire:click="brandized('','')"
                                        @click="if(window.innerWidth < 768) { open = false; }">{{ $bra }}</x-web.special.filter>
                                @endif
                                @if ($gam)
                                    <x-web.special.filter wire:click="colorized('','')"
                                        @click="if(window.innerWidth < 768) { open = false; }">{{ $gam }}</x-web.special.filter>
                                @endif
                                @if ($rating)
                                    <x-web.special.filter wire:click="$set('rating', '')"
                                        @click="if(window.innerWidth < 768) { open = false; }">{{ $rating == 1 ? '1 estrella' : $rating . ' estrellas' }}</x-web.special.filter>
                                @endif
                                @if ($material_name)
                                <x-web.special.filter wire:click="materialized('','')"
                                    @click="if(window.innerWidth < 768) { open = false; }">{{ $material_name }}</x-web.special.filter>
                                @endif
                            </div>
                        </li>
                        <hr class="border-t border-gris-70">
                        {{-- Categorias --}}
                        <li class=" p-2">
                            <div class="text-gris-10  cursor-pointer">
                                <p1 class="hover:text-white text-gris-10 flex items-center"
                                    @click="menu1 = (menu1 === 1) ? 0 : 1">Categorías
                                    <x-icons.chevron-right height="10px" width="10px" grosor="1" class="ml-auto"
                                        ::class="{ 'rotate-90 transition-all': menu1 === 1 }" />
                                </p1>

                                <ul x-show="menu1===1" x-collapse x-cloak
                                    class="w-full text-[12px] ml-2 overflow-y-auto !max-h-40 bar mt-2">

                                    @foreach ($categories as $category)
                                        <p2 wire:click="categorized('{{ $category->name }}','{{ $category->id }}')"
                                            @click="if(window.innerWidth < 768) { open = false; } else { menu1 = 0;}"
                                            class="hover:text-white">{{ $category->name }}</p2>
                                    @endforeach

                                </ul>
                            </div>
                        </li>
                        {{-- Marcas --}}
                        <li class=" p-2">
                            <div class="text-gris-10  cursor-pointer">
                                <p1 class="hover:text-white text-gris-10 flex items-center"
                                    @click="menu1 = (menu1 === 2) ? 0 : 2">Marcas
                                    <x-icons.chevron-right height="10px" width="10px" grosor="1" class="ml-auto"
                                        ::class="{ 'rotate-90 transition-all': menu1 === 2 }" />
                                </p1>
                                <ul x-show="menu1===2" x-collapse x-cloak class="w-fit text-[12px] ml-2 mt-2">
                                    @foreach ($brands as $brand)
                                        <p2 wire:click="brandized('{{ $brand->name }}','{{ $brand->id }}')"
                                            class="hover:text-white"
                                            @click="if(window.innerWidth < 768) { open = false; } else { menu1 = 0;}">
                                            {{ $brand->name }}</p2>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                        {{-- Calificaciones --}}
                        <li class="p-2">
                            <div class="text-gris-10  cursor-pointer">
                                <p1 @click="menu1 = (menu1 === 4) ? 0 : 4"
                                    class="text-gris-10 hover:text-white flex items-center">Calificaciones
                                    <x-icons.chevron-right height="10px" width="10px" grosor="1" class="ml-auto"
                                        ::class="{ 'rotate-90 transition-all': menu1 === 4 }" />
                                </p1>
                                <ul x-show="menu1===4" x-collapse x-cloak class="flex flex-wrap mt-2">
                                    <x-rating-filtro />

                                </ul>
                            </div>
                        </li>
                        {{-- Tipos --}}
                        <li class=" p-2">
                            <div class="text-gris-10  cursor-pointer">
                                <p1 class="hover:text-white text-gris-10 flex items-center"
                                    @click="menu1 = (menu1 === 5) ? 0 : 5">Tipos
                                    <x-icons.chevron-right height="10px" width="10px" grosor="1"
                                        class="ml-auto" ::class="{ 'rotate-90 transition-all': menu1 === 5 }" />
                                </p1>
                                <ul x-show="menu1===5" x-collapse x-cloak class="w-fit text-[12px] ml-2 mt-2">
                                    @foreach ($types as $type)
                                        <p2 wire:click="typerized('{{ $type->name }}','{{ $type->id }}')"
                                            class="hover:text-white"
                                            @click="if(window.innerWidth < 768) { open = false; } else { menu1 = 0;}">
                                            {{ $type->name }}</p2>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                        {{-- materiales --}}
                        <li class=" p-2">
                            <div class="text-gris-10  cursor-pointer">
                                <p1 class="hover:text-white text-gris-10 flex items-center"
                                    @click="menu1 = (menu1 === 6) ? 0 : 6">Materiales
                                    <x-icons.chevron-right height="10px" width="10px" grosor="1"
                                        class="ml-auto" ::class="{ 'rotate-90 transition-all': menu1 === 6 }" />
                                </p1>
                                <ul x-show="menu1===6" x-collapse x-cloak class="w-fit text-[12px] ml-2 mt-2">
                                    @foreach ($materials as $material)
                                        <p2 wire:click="materialized('{{ $material->name }}','{{ $material->id }}')"
                                            class="hover:text-white"
                                            @click="if(window.innerWidth < 768) { open = false; } else { menu1 = 0;}">
                                            {{ $material->name }}</p2>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                        {{-- Color --}}
                        <li class="p-2">
                            <div class="text-gris-10  cursor-pointer">
                                <p1 @click="menu1 = (menu1 === 3) ? 0 : 3"
                                    class="text-gris-10 hover:text-white flex items-center">Color
                                    <x-icons.chevron-right height="10px" width="10px" grosor="1"
                                        class="ml-auto" ::class="{ 'rotate-90 transition-all': menu1 === 3 }" />
                                </p1>
                                <ul x-show="menu1 === 3" x-collapse x-cloak
                                    class="flex flex-wrap justify-start gap-4 mt-2">
                                    @foreach ($gamas as $gama)
                                        @if (isset($gama->images->url))
                                            <img src="{{ asset('storage/' . $gama->images->url) }}"
                                                wire:click="colorized('{{ $gama->name }}', '{{ $gama->id }}')"
                                                @click="if(window.innerWidth < 768) { open = false; } else { menu1 = 0; }"
                                                class="rounded-full w-4 h-4 cursor-pointer" alt=""
                                                title="{{ $gama->name }}">
                                        @else
                                            <div class="rounded-full w-4 h-4 cursor-pointer"
                                                wire:click="colorized('{{ $gama->name }}', '{{ $gama->id }}')"
                                                @click="if(window.innerWidth < 768) { open = false; } else { menu1 = 0; }"
                                                style="background: {{ $gama->hex }}" title="{{ $gama->name }}">
                                            </div>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            {{-- FIN menu 1 --}}
            <div class="mx-left w-full" :class="{ 'pl-2': open === true }">
                <div wire:loading wire:target="rate,categorized,brandized,colorized,clean,search,typerized,materialized"
                    class="w-full h-[300px]">
                    <x-preloader.heartlite />
                </div>
                <div wire:loading.remove wire:target="rate,categorized,brandized,colorized,clean,search,typerized,materialized"
                    :class="{
                        'grid-cols-2 lg:grid-cols-5 md:grid-cols-4': !open && sort === 3,
                        'grid-cols-2 lg:grid-cols-4 md:grid-cols-3': (open && sort === 3),
                        'grid-cols-2 lg:grid-cols-4 md:grid-cols-2': open && sort === 2,
                        'grid-cols-2 lg:grid-cols-5 md:grid-cols-3': (!open && sort === 2),
                        'mt-1 md:mt-0': true,
                    }"
                    class="{{ $this->products->isNotEmpty() ? 'grid' : 'h-full' }} w-full">

                    @forelse ($this->products as $key0 =>$product)
                        <div class="px-3 mx-auto relative my-[8px] items-center w-fit" x-data="{ icon: false }"
                            x-on:mouseover="icon=true" x-on:mouseleave="icon=false" :class="{ 'flex w-full': sort === 1 }">
                            <a
                                href="{{ !empty($product->colors) && !empty($product->colors[0]->id) ? route('web.shop.show', ['product' => $product, 'color' => $product->colors[0]->id]) : '#' }}">
                                @php
                                    $colorSelect = $product
                                        ->colors()
                                        ->select('name', 'hex', 'colors.id')
                                        ->with('images')
                                        ->get()
                                        ->map(function ($color) {
                                            $image = $color->images;
                                            $url = $image ? $image->url : null;
                                            return (object) [
                                                'name' => $color->name,
                                                'hex' => $color->hex,
                                                'id' => $color->id,
                                                'url' => $url,
                                            ];
                                        });
                                    $imagenes = [];

                                    foreach ($colorSelect as $key => $color) {
                                        $imagenes2 = $product
                                            ->images()
                                            ->where('color_id', $color->id)
                                            ->join('row_image', 'images.id', '=', 'row_image.image_id')
                                            ->join('rows', 'rows.id', '=', 'row_image.row_id')
                                            ->orderBy('rows.order', 'asc')
                                            ->get();
                                        $imagenes[$key] = $imagenes2;
                                    }
                                    $firstImage[$key0] = '';
                                    $sku = '';
                                    if ($imagenes) {
                                        $firstImage[$key0] = $imagenes[0]->first();
                                    }
                                    if (!empty($firstImage[$key0]) && is_object($firstImage[$key0])) {
                                        $sku = \App\Models\Sku::where([
                                            'color_id' => $firstImage[$key0]->color_id,
                                            'product_id' => $product->id,
                                        ])->first();
                                        if (session('location') !== 'PE') {
                                            $sku->sell_price = $sku->usd;
                                        }
                                    } else {
                                        $sku = \App\Models\Sku::where([
                                            'color_id' => $colorSelect[0]->id,
                                            'product_id' => $product->id,
                                        ])->first();
                                        if (session('location') !== 'PE') {
                                            $sku->sell_price = $sku->usd;
                                        }
                                    }
                                @endphp
                                <x-outstock
                                    url="{{ $firstImage[$key0]->url ?? '/image/dashboard/No_image_dark.png' }}"
                                    name="{{ $product->name }}" stock="{{ $sku->stock ?? '' }}"
                                    color="{{ $product->type->hex }}"
                                    img="{{ $product->type->images->url ?? '' }}" />

                            </a>


                            <div class="absolute right-0 top-0 py-[7px] px-[20px] w-[60px]"
                                x-show="(icon && sort !== 1 )|| sort === 1">
                                <button type="button"
                                    @guest @click="show=true;" @else
                                onclick="showCartModall('{{ $product->id }}', '{{ $sku->color_id ?? '' }}', '{{ $firstImage[$key0]->url ?? '/image/dashboard/No_image_dark.png' }}', '{{ $colorSelect ?? '' }}', 'WISHLIST','{{ $product->type->hex ?? '' }}','{{ $product->type->images->url ?? '' }}')" @endguest
                                    class="h-fit w-fit">
                                    <x-icons.heart class="h-[20px] w-[20px] hover:fill-corp-50  cursor-pointer " />
                                </button>
                                <button type="button"
                                    onclick="showCartModall('{{ $product->id }}', '{{ $sku->color_id ?? '' }}', '{{ $firstImage[$key0]->url ?? '/image/dashboard/No_image_dark.png' }}', '{{ $colorSelect ?? '' }}', 'CART','{{ $product->type->hex ?? '' }}','{{ $product->type->images->url ?? '' }}')"
                                    class=" w-fit">
                                    <x-icons.cart class="h-[20px] w-[20px] cursor-pointer hover:fill-corp-50"
                                        x-show="sort !==1" />
                                </button>

                            </div>


                            <div class="m-2 leading-[1.2]" x-show="sort===3" x-cloak>
                                <p class="text-[14px] md:text-[18px] ">{{ $product->name }}</p>
                                <p class="text-[18px] md:text-[22px]">
                                    {{ $sku->sell_price == 0 ? '' : session('currency') . $sku->sell_price ?? '' }}
                                </p>
                            </div>
                            <div x-show="sort===1" x-cloak class="px-8 w-[626px]">
                                <h3>{{ $product->name }}</h3>
                                <div class="mb-2 cursor-pointer flex">

                                </div>
                                <div class="flex space-x-3">
                                    <h4>{{ session('currency') }} {{ $sku->sell_price ?? '' }}</h4>

                                </div>
                                <p class="mt-4 text-justify">{{ $product->short_description }}</p>
                                <x-button.webprimary class="w-fit my-3 px-[50px]"
                                    onclick="showCartModall('{{ $product->id }}', '{{ $sku->color_id ?? '' }}', '{{ $firstImage[$key0]->url ?? '/image/dashboard/No_image_dark.png' }}', '{{ $colorSelect ?? '' }}', 'CART','{{ $product->type->hex ?? '' }}','{{ $product->type->images->url ?? '' }}')">
                                    Añadir a Carrito
                                </x-button.webprimary>
                            </div>

                        </div>
                    @empty
                        <div class="flex w-full items-center h-full">
                            <p class="mx-auto">No hay elementos para mostrar.</p>
                        </div>
                    @endforelse
                </div>
                {{ $this->products->links('vendor.livewire.lodomen') }}
            </div>

        </div>

        {{-- menu 2 --}}

        <div class="absolute top-[86px] z-10 sm:right-[111px] right-[13px]">
            <ul class=" bg-gris-90 md:hidden rounded" x-show="open2" x-collapse x-cloak @click.away="open2 = false">
                {{--                  <li class="mr-6 p-2 ">
                    <a class="text-gris-10 hover:text-red-600 text-[12px] ">FILTROS</a>
                </li>
                <li class="border-[1px] border-gris-70"></li>  --}}
                <li class="mr-6 p-2 cursor-pointer">
                    <ul class="text-gris-10 hover:text-red-600 text-[12px]" wire:click="$set('selectedPrice','asc')">
                        Precio de menor a mayor</ul>
                </li>
                <li class="mr-6 p-2 cursor-pointer">
                    <a class="text-gris-10 hover:text-red-600 text-[12px]"
                        wire:click="$set('selectedPrice','desc')">Precio de mayor a menor</a>
                </li>
                <li class="mr-6 p-2 cursor-pointer">
                    <a class="text-gris-10 hover:text-red-600 text-[12px]" wire:click="abc('new')">Productos
                        nuevos</a>
                </li>
            </ul>
        </div>

        {{-- FIN menu 2 --}}
        {{--   modal registro  --}}
        <div x-on:close.stop="show = false" x-on:keydown.escape.window="show =false" x-show="show"
            class="jetstream-modal fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50" style="display: none;">
            <div x-show="show" class="fixed inset-0 transform transition-all" x-on:click="show = false"
                x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                <div class="absolute inset-0  bg-black/40"></div>
            </div>
            <div class="flex items-center h-full">
                <div x-show="show"
                    class="bg-gris-90 rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-[265px] sm:mx-auto"
                    x-trap.inert.noscroll="show" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                    <div class="px-3 py-4">
                        <div class="text-lg font-medium text-gris-10 mx-4">
                            Iniciar Sesión
                        </div>

                        <div class="mt-4 text-[15px]  text-gris-10">
                            <form class="p-4" action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="mb-3 text-gris-50 relative">
                                    <input autocomplete="off" id="emaill" name="email" type="text"
                                        class="peer rounded-[3px] placeholder-transparent bg-gris-90 text-gris-10 h-10 w-full border-gris-50 focus:ring-gris-50 focus:border-gris-50 focus:outline-none "
                                        placeholder="" />
                                    <label for="emaill"
                                        class="absolute left-[12px] top-[-8px] text-gris-30 peer-placeholder-shown:text-[14px] text-[10px] bg-gris-90  rounded-[3px] peer-placeholder-shown:text-gris-50 peer-placeholder-shown:top-[9px] px-[3px] transition-all peer-focus:top-[-8px] peer-focus:text-gris-10 peer-focus:text-[10px] ">Correo
                                        electrónico</label>


                                </div>
                                <div class="mb-2 text-center text-gris-50 relative">
                                    <input autocomplete="off" id="passwordd" name="password" type="password"
                                        class="peer rounded-[3px] placeholder-transparent bg-gris-90 text-gris-10 h-10 w-full border-gris-50 focus:ring-gris-50 focus:border-gris-50 focus:outline-none"
                                        placeholder="" />
                                    <label for="passwordd"
                                        class="absolute left-[12px] top-[-8px] text-gris-30 peer-placeholder-shown:text-[14px] text-[10px] bg-gris-90  rounded-[3px] peer-placeholder-shown:text-gris-50 peer-placeholder-shown:top-[9px] px-[3px] transition-all peer-focus:top-[-8px] peer-focus:text-gris-10 peer-focus:text-[10px]">Contraseña</label>
                                    <a class="text-[14px] text-corp-50"
                                        href="{{ route('web.recover_password') }}">¿Olvidaste la contraseña?</a>

                                </div>
                                <div class="mb-2 text-[14px]">

                                    <button type="submit"
                                        class="w-full rounded-[3px]  text-white bg-corp-50 h-[33px] hover:bg-corp-70 ">Iniciar
                                        sesión</button>
                                    <div class="flex mt-1">
                                        <eco style="margin-right:5px">¿No tienes cuenta?</eco>
                                        <a class="text-corp-50"
                                            href="{{ route('web.login_register') }}">Registrate</a>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>

                    {{--                      <div class="flex flex-row justify-end px-6 py-4 dark:bg-gris-90 text-end">
                      {{ $footer }}
                    </div>  --}}
                </div>
            </div>
        </div>

    </div>

</div>
