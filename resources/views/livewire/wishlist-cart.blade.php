<div class="col-span-3">
        @if($cartitems->count() > 0)
        <div class="col-span-3">
            <div class="bg-gris-100 px-6 py-3 rounded-t-[3px]">
                <div class="flex justify-between">
                    <div class="flex justify-center items-center relative space-x-2">
                        <h5> Wishlist</h5>
                        <p>({{ $cartitems->count() == 1 ? '1 producto' : $cartitems->count().' productos'}} )</p>
                    </div>
                    <a wire:click="clearCart"
                        class="flex space-x-2 items-center border-[1px] rounded-[3px] border-gris-30 p-1.5 text-gris-30 cursor-pointer hover:border-gris-10 hover:text-gris-10 active:border-gris-5 active:text-gris-5">
                        <x-icons.trash class="w-4" />
                        <p class="text-[14px]">Eliminar todo</p>
                    </a>
                </div>
            </div>
            <div class="bg-gris-100 rounded-b-[3px]">
            @foreach ($cartitems as $index => $item)
            <hr class="border-gris-70">
            <div class="flex px-2 md:px-6 py-3 md:justify-between">

                <div class="md:flex space-x-2 md:space-x-7 md:justify-between w-full">
                    <div class="flex justify-center space-x-5 md:w-full">
                        <a class="flex w-max items-center"
                            href="{{ route('web.shop.show',['product'=>$item->options->slug,'color'=>$item->options->color_id]) }}">
                            <x-outstock text="text-[10px]" class="!w-[90px] !h-[90px] md:!w-[120px] md:!h-[120px]" url="{{ $item->options->productImage }}" name="{{ $item->name }}" stock="{{ $item->options->stock }}"/>
                        </a>
                        <div class="md:w-full">
                            <div class="md:flex md:items-center md:justify-between">
                                <h6 href="">{{ $item->name }}</h6>
                                <p class="text-[13px] md:text-[15px]">SKU:{{ $item->options->sku }}</p>
                            </div>
                            <div>
                                <p>Color: {{ $item->options->color }}</p>
                            </div>
                            <div>
                                <div class="flex justify-between">
                                    <p>Precio unidad: {{session('currency')}}{{ $item->price }}</p>

                                </div>
                                {{--  <p> {{ $item->options->stock == 1 ? 'Queda 1 unidad' : 'Quedán '.$item->options->stock.'
                                    unidades' }}</p>   --}}
                            </div>
                        </div>
                    </div>

                </div>
                <div>
                <div class="flex justify-between mt-4 md:mt-0">
                    <div>
                    <h4 class="flex justify-center md:mb-8"> {{session('currency')}}{{ $item->price*$item->qty }}</h4>
                    <x-specials.input-cart :item="$item" index="{{ $index }}" />

                </div>
                <div class="flex items-center space-x-4 ml-2">
                    <a class="cursor-pointer" wire:click="moveToCart('{{$item->rowId}}','{{ $index }}')">
                        <x-icons.cart class="h-[20px] w-[20px] fill-gris-10 hover:fill-corp-50 cursor-pointer"  />
                    </a>
                    <a class="cursor-pointer" wire:click="removeRow('{{$item->rowId}}','{{ $index }}')">
                        <x-icons.trash class="h-[20px] w-[20px] fill-gris-10 hover:fill-corp-50" />
                    </a>
                </div>
            </div>
            </div></div>
            @endforeach
            </div>
            <x-dialog-modal wire:model="showModal" maxWidth="fit">
                <x-slot name="title">
                    <div class="flex justify-center">
                        <h7 >Advertencia</h5>
                    </div>
                </x-slot>
                <x-slot name="content">
                    <div class="flex whitespace-pre-wrap">
                        @if( $choose == 0)
                    <p>Estas por eliminar </p><p class="text-white">{{ $row['name'] ?? '' }}</p> <p> de color </p><p class="text-white">{{ $row['color'] ?? '' }}</p>
                        @else
                    <p>Estas por eliminar todo el carrito del wishlist</p>
                        @endif
                </div>
                </x-slot>
                <x-slot name="footer">
                    <a href=""></a>

                    <x-button.corp_secundary wire:click="$toggle('showModal')" wire:loading.attr="disabled">Cancelar</x-button.corp_secundary>

                    @if( $choose == 0)
                    <x-button.corp1 wire:click="erase('{{ $row['rowId'] ?? '' }}','{{ $row['index'] ?? ''}}')">Aceptar</x-button.corp1>
                    @else
                    <x-button.corp1 wire:click="ereaseall">Aceptar</x-button.corp1>
                    @endif
                </x-slot>
            </x-dialog-modal>
        </div>
        @else
        <div class="bg-gris-100  m-auto w-full col-span-3 h-full flex items-center">
            <div class="md:w-2/3 w-5/6 mx-auto  mb-4 mt-6">
                <h4 class="mx-auto w-fit">Tu Wishlist está vacío</h4>
                <div class="mx-auto grid grid-cols-4 p-2">
                    <div class="col-span-1 flex items-center">
                        <x-icons.cart class="md:w-18 sm:w-16 w-10 mx-auto" />
                    </div>
                    <div class="col-span-3 text-center flex">


                        <p class="12px w-[80%] m-auto">Actualmente no cuentas con productos en tu wishlist. Ve a Tienda para agregas tus productos.</p>
                    </div>

                </div>
                <div class="my-6 mx-11 flex flex-col items-center space-y-1">
                    <a href="{{route('web.shop.index')}}" class="w-full">
                        <x-button.webprimary class="w-full"> Añadir a Carrito</x-button.webprimary>
                    </a>

                </div>
            </div>
        </div>
        @endif
</div>
