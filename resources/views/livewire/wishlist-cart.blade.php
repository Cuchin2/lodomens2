<div class="col-span-3">
        @if($cartitems->count() > 0)
        <div class="col-span-3">
            <div class="bg-gris-100 px-6 py-3">
                <div class="flex justify-between">
                    <div class="flex justify-center items-center relative space-x-2">
                        <h5> Wishlist</h5>
                        <p>({{ $cartitems->count() == 1 ? '1 producto' : $cartitems->count().' productos'}} )</p>
                    </div>
                    <a wire:click="clearCart"
                        class="flex space-x-2 items-center border-[2px] rounded-[3px] border-gris-50 p-2 cursor-pointer">
                        <x-icons.trash class="w-5" />
                        <p class="text-[14px]">Eliminar todo</p>
                    </a>
                </div>
            </div>
            @foreach ($cartitems as $index => $item)
            <hr class="border-gris-70">
            <div class="flex bg-gris-100 px-2 md:px-6 py-3 md:justify-between">

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
                                    <p>Precio unidad: S/.{{ $item->price }}</p>

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
                    <h4 class="flex justify-center md:mb-8"> S/.{{ $item->price*$item->qty }}</h4>
                    <div class="flex space-x-2">
                        <div class="flex">
                            <div class="cursor-pointer hover:border-gris-10 text-gris-60 bg-black h-[26px] border-[1px] text-[12px] rounded-l-[3px] border-gris-30 w-[30px] flex items-center"
                                wire:click="decreaseCount('{{$item->rowId}}','{{ $index }}','{{ $item->options->stock }}')">
                                <x-icons.chevron-left grosor="1" height="17px" width="17px"
                                    class="p-1 mx-auto fill-gris-30" />
                            </div>
                            <div>
                                <input type="text"
                                    class="text-gris-10 font-bold bg-black h-[26px] mx-auto p-2 focus:ring-gris-50 focus:border-gris-50 w-[47px] border-gris-30 text-center border-x-0"
                                    placeholder=" " required=""
                                    wire:change="updateCart('{{ $item->rowId }}','{{$index}}','{{ $item->options->stock }}')"
                                    wire:model.change="counts.{{ $index }}">
                            </div>
                            <div class="cursor-pointer hover:border-gris-10 text-gris-60 bg-black h-[26px] border-[1px] text-[12px] rounded-r-[3px] border-gris-30 w-[30px] flex items-center"
                                wire:click="increaseCount('{{$item->rowId}}','{{ $index }}','{{ $item->options->stock }}')">
                                <x-icons.chevron-right grosor="1" height="17px" width="17px"
                                    class="p-1 mx-auto fill-gris-30" />
                            </div>
                        </div>

                    </div>
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
            <div class="w-2/3 mx-auto">
                <div class="mx-auto grid grid-cols-4 p-2">
                    <div class="col-span-1 flex items-center">
                        <x-icons.cart class="w-20 mx-auto" />
                    </div>
                    <div class="col-span-3 text-center space-y-3">

                        <h4>Tu Wishlist está vacío</h4>
                        <p class="12px w-[80%] mx-auto">Inicia sesión para ver los productos que habías guardado en tu
                            carro.</p>
                    </div>

                </div>
                <div class="my-6 mx-11 flex flex-col items-center space-y-1">
                    <a href="{{route('web.shop.index')}}" class="w-full">
                        <x-button.webprimary class="w-full"> Añadir a Carrito</x-button.webprimary>
                    </a>
        {{--                      <div class="flex space-x-2">
                                <p>¿No tienes cuenta?</p> <a class="text-corp-30 cursor-pointer"
                                    href="{{ route('web.login_register') }}">Registrarse</a>
                            </div>  --}}
                            {{-- <p class="text-corp-30">Ir a tienda</p> --}}
                </div>
            </div>
        </div>
        @endif
</div>