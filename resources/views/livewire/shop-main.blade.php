<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div x-data="{ open: window.innerWidth > 1024, open2: false, sort:3}" x-init="window.addEventListener('resize', () => {
        console.log(window.innerWidth,open);
        if(window.innerWidth > 1024){
        open = true;} else { open = false}
    });" class="pb-4 lg:px-[55px] 2xl:px-[177px]">
    {{--  MENU DE FILTROS  --}}
<div
    class="fixed w-full bg-black z-20 left-1/2 transform -translate-x-1/2 md:top-[159px]">
    <div class="flex py-3 mx-auto items-center sm:w-[442px] md:w-[711px] lg:w-[962px] xl:w-[1115px]">
        <div class="w-[34px] h-[34px] bg-gris-90 rounded p-1 cursor-pointer" @click="open=!open">
            <x-icons.chevron-left height="22px" width="22px" grosor="2" class="p-1" />
        </div>
        <div class="hidden md:block w-fit ml-9 mr-9 whitespace-nowrap">
            <p>{{--  107  --}} {{ $productsall->count() }} Resultados</p>
        </div>
        <div class="mx-3 w-full">
            <div class="relative">
                <x-icons.search class="absolute right-1 top-1 h-[20px] w-[20px] fill-gris-10" />
                <input type="text"
                    wire:model.live.debounce.300ms="search"
                    class="text-gris-60 bg-black h-[30px]  text-[12px] pr-[26px] rounded-[3px] focus:ring-gris-50 focus:border-gris-50 w-full "
                    placeholder="Buscar" required="" x-cloak>
            </div>
        </div>
        <div class="hidden md:block w-1/3 mx-3">
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
            <div class="rounded p-1 ml-auto cursor-pointer md:flex hidden w-[34px] h-[34px]" :class="{ 'bg-gris-70 text-white': sort === 2, 'bg-gris-90': sort !== 2 }">
                <x-icons.window class=" mx-auto my-auto"  @click="sort=2"/>
            </div>
            <div class=" rounded p-1 ml-auto cursor-pointer md:flex hidden w-[34px] h-[34px] " :class="{ 'bg-gris-70 text-white': sort === 3, 'bg-gris-90': sort !== 3 }">
                <x-icons.auto_awesome_mosaic class=" mx-auto my-auto" @click="sort=3"/>
            </div>
        </div>
    </div>
</div>
    <div class="flex pt-[54px] bg-black/75">
        {{-- menu 1 --}}
        <div class="fixed md:min-h-[208px] xl:min-h-[304px] top-[126px] md:top-0 z-10 left-0 md:relative lg:w-[210px] w-1/2 md:w-1/4 h-full md:h-auto md:ml-[7px] pt-[4px]"
        x-data="{menu1 : 0}" x-show="open" @click.away="if (window.innerWidth < 1024) {
                open = false;
            }">
        <div class="h-full bg-gris-90 lg:w-[120px] xl:w-[205px]">
        <ul class="md:fixed bg-gris-90 md:w-[148px] lg:w-[120px] xl:w-[200px] h-fit md:max-h-[300px] overflow-hidden" @click.away="menu1 = 0">
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
                    <ul x-show="menu1===1" x-collapse x-cloak class="w-full text-[12px] ml-2 overflow-y-auto !h-40">
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
    <div class="mx-left " :class="{'pl-2': open === true}">
    <div :class="{
        'grid-cols-2 lg:grid-cols-5 md:grid-cols-4': !open && sort === 3,
        'grid-cols-2 lg:grid-cols-4 md:grid-cols-3': (open && sort === 3) || (!open && sort === 2),
        'grid-cols-2 lg:grid-cols-3 md:grid-cols-2': open && sort === 2,
        'mt-1 md:mt-0': true,
    }" class="grid">

        @foreach ($products as $key0 =>$product )
        <div class="px-3 mx-auto relative my-[8px] items-center" x-data="{icon:false}" x-on:mouseover="icon=true" x-on:mouseleave="icon=false" :class="{'flex':sort===1}">
            <a href="{{ !empty($product->colors) && !empty($product->colors[0]->id) ? route('web.shop.show', ['product' => $product, 'color' => $product->colors[0]->id]) : '#' }}">
                @php
                        $colorSelect = $product->colors()->select('name', 'hex', 'colors.id')->get()->map(function ($color) {
                            return (object) ['name' => $color->name, 'hex' => $color->hex, 'id' => $color->id];
                        }); $imagenes = [];
                        foreach ($colorSelect as $key => $color) {
                            $imagenes2 = $product->images()->where('color_id',$color->id)->join('row_image', 'images.id', '=', 'row_image.image_id')
                            ->join('rows', 'rows.id', '=', 'row_image.row_id')
                            ->orderBy('rows.order', 'asc')->get();
                        $imagenes[$key]= $imagenes2;     }
                        if($imagenes) {
                            $firstImage[$key0] = $imagenes[0]->first();
                        }
                        $sku= \App\Models\Sku::where(['color_id'=>$firstImage[$key0]->color_id,'product_id'=>$product->id])->first();
                        @endphp
                <x-outstock class="md:max-w-[200px] max-w-[150px]" url="{{ $firstImage[$key0]->url }}" name="{{ $product->name }}" stock="{{ $sku->stock }}" />
            </a>

                <div class="absolute right-0 top-0 py-[7px] px-[20px] " x-show="(icon && sort !== 1 )|| sort === 1">

                    <x-icons.heart class="h-[20px] w-[20px] hover:fill-corp-50  cursor-pointer mb-2 " />
                    <button type="button" wire:click="showCartModal('{{ $product->id }}','{{ $sku->color_id }}','{{ $firstImage[$key0]->url }}','{{ $colorSelect }}')" class=" w-fit">
                    <x-icons.cart class="h-[20px] w-[20px] cursor-pointer hover:fill-corp-50" x-show="sort !==1" />
                    </button>

                </div>
                <div class="m-2 leading-[1.2]" x-show="sort===3" x-cloak>
                    <p class="text-[14px] md:text-[18px] ">{{ $product->name }}</p>
                    <p class="text-[18px] md:text-[22px]">S/. {{ $sku->sell_price }}</p>
                </div>
                <div x-show="sort===1" x-cloak class="px-8">
                    <h3>{{ $product->name }}</h3>
                    <div class="mb-2 cursor-pointer flex">
                        <x-star class="h-5 w-5" star=" {{ round($product->reviews->avg('score'), 1)*20 }}"/>
                        <p class="text-gris-30"> - {{ $product->reviews->count() }} reseñas -</p>
                    </div>
                    <div class="flex space-x-3">
                        <h4>S/. {{ $sku->sell_price }}</h4>
                        <h5 class="line-through text-gris-70">S/.65 </h5>
                    </div>
                    <p class="mt-4 text-justify">{{ $product->short_description }}</p>
                    <x-button.webprimary class="w-fit my-3 px-[50px]" wire:click="showCartModal('{{ $product->id }}','{{ $sku->color_id }}','{{ $firstImage[$key0]->url }}','{{ $colorSelect }}')"> Añadir a Carrito
                    </x-button.webprimary>
                </div>

        </div>
        @endforeach
    </div>
    {{$products->links('vendor.livewire.lodomen')}}
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
<x-dialog-modal wire:model="showModal" maxWidth="fit">
    <x-slot name="title">
        Agregando al carrito
    </x-slot>
    <x-slot name="content">
        <div class="bg-gris-100 px-2 md:px-6 py-3">
            <div class="md:flex space-x-2 md:space-x-7 md:justify-between">
                <div class="flex justify-center space-x-5 md:w-full">
                    <x-outstock text="text-[10px]" class="w-[90px] md:w-[120px]" name="{{ $skus->product->name ?? ''}}" url="{{ $image ?? ''}}" stock="{{ $skus->stock ?? ''}}" />
                    <div class="space-y-4 md:w-full">
                        <div class="md:flex md:items-center md:justify-between">
                            <h6 href="">{{ $skus->product->name ?? ''}}</h6>
                            <p class="text-[13px] md:text-[15px]">SKU: {{ $skus->code ?? '' }}</p>
                        </div>

                            <div class="">
                            <p>Precio unidad: S/. {{ $skus->sell_price ?? '' }}</p>
                            <p>Color:  {{ $skus->color->name ?? ''}} </p> </div>
                            <div>
                                <p>@if(isset($skus->stock)) {{ $skus->stock < 2 ? ($skus->stock == 1 ? 'Queda: 1 unidad': 'Fuera de stock') : 'Quedan: '.$skus->stock.' unidades' }} @else  @endif</p>
                            </div>
                        <div class="flex my-4 space-x-1">

                            <p class="font-bold"> {{ $colorSelect->count() === 1 ? 'COLOR: ' : 'COLORES: ' }}</p class="font-bold">
                            <div class="flex space-x-2">
                                @foreach ($colorSelected as $key => $color )
                                    <div  class="h-[27px] w-[27px] rounded-full cursor-pointer hover:border-corp-50 hover:border-[3px] {{ $key == $active ? 'border-corp-50 border-[3px]' : '' }}"           style="background: {{ $color->hex }}" wire:click="changeColor({{ $key }},{{ $skus->product->id }},{{$color->id}})"> </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex md:block justify-between mt-4 md:mt-0">
                    <h4 class="flex justify-end md:mb-8 whitespace-nowrap"> S/. {{ $price_cart ?? '' }}</h4>
                    <div class="flex space-x-2">
                        <div class="flex">
                            @if(isset($skus->stock) && $skus->stock > 0)
                            <div class="cursor-pointer hover:border-gris-10 text-gris-60 bg-black h-[26px] border-[1px] text-[12px] rounded-l-[3px] border-gris-30 w-[30px] flex items-center" wire:click="decreaseCount('','')">
                                <x-icons.chevron-left grosor="1" height="17px" width="17px" class="p-1 mx-auto fill-gris-30" />
                            </div>
                            <div>
                                <input class="text-gris-10 font-bold bg-black h-[26px] mx-auto text-[12px] p-2 focus:ring-gris-50 focus:border-gris-50 w-[47px] border-gris-30 text-center border-x-0" placeholder=" " required="" wire:model='counts' wire:change="changePrice()">
                            </div>
                            <div class="cursor-pointer hover:border-gris-10 text-gris-60 bg-black h-[26px] border-[1px] text-[12px] rounded-r-[3px] border-gris-30 w-[30px] flex items-center" wire:click="increaseCount('','')">
                                <x-icons.chevron-right grosor="1" height="17px" width="17px" class="p-1 mx-auto fill-gris-30" />
                            </div>
                            @endif
                        </div>
                        <div>
                            <a class="cursor-pointer" wire:click="$toggle('showModal')">
                                <x-icons.trash class="w-5 fill-corp-30"/>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-button.corp_secundary wire:click="$toggle('showModal')" wire:loading.attr="disabled">Cancelar</x-button.corp_secundary>
        @if(isset($skus->stock) && $skus->stock > 0)
        <x-button.corp1 wire:click="addToCart" wire:loading.attr="disabled">Agregar al carro</x-button.corp1>
        @endif
    </x-slot>
</x-dialog-modal>
</div>
