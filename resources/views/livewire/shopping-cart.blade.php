<div class="md:mx-5 lg:mx-auto lg:w-[987px] bg-black/75 px-5 pb-1 flex items-center 2xl:min-h-[374px] lg:min-h-[278px]">
    @if($cartitems->count() > 0)

<div class="grid lg:grid-cols-3 w-full gap-5 my-4">
        <div class="col-span-2">
            <div class="bg-gris-100 px-6 py-3">
                <div class="flex justify-between">
                    <div class="flex justify-center items-center relative space-x-2">
                        <h5> Carrito</h5>
                        <p>(4 productos)</p>
                    </div>
                    <a wire:click="clearCart" class="flex space-x-2 items-center border-[2px] rounded-[3px] border-gris-50 p-2 cursor-pointer">
                        <x-icons.trash class="w-5"/>
                        <p>Eliminar todo</p>
                    </a>
                </div>
            </div>
            @foreach ($cartitems as $item)
            <hr class=" border-gris-70">
            <div class="bg-gris-100 px-2 md:px-6 py-3">
                <div class="md:flex space-x-2 md:space-x-7 md:justify-between">
                    <div class="flex justify-center space-x-5 md:w-full">
                    <a class="flex w-max items-center" href="{{ route('web.shop.show',$item->model->slug) }}">
                        <img src="{{ asset('storage/'.$item->options->productImage) }}" alt="{{ $item->model->name }}" class="w-[90px] md:w-[120px] border-[2px] border-corp-50 rounded-[3px]">
                    </a>
                    <div class="space-y-4 md:w-full">
                        <div class="md:flex md:items-center md:justify-between">
                        <h6 href="{{ route('web.shop.show',$item->model->slug) }}">{{ $item->model->name }}</h6>
                        <p class="text-[13px] md:text-[15px]">SKU:14500293</p>
                        </div>
                        <div class="">
                            <p>Precio unidad: S/.{{ $item->price }}</p>
                            <p>Color: Plateado</p>
                        </div>
                    </div>
                    </div>
                    <div class="flex md:block justify-between mt-4 md:mt-0">

                        <h4 class="flex justify-end md:mb-8"> S/.{{ $item->price*$item->qty }}</h4>
                        <div class="flex space-x-2 ">
                            <div class="flex" x-data="{count: {{ $item->qty }}}">
                                <div class="cursor-pointer hover:border-gris-10 text-gris-60 bg-black h-[26px] border-[1px] text-[12px] rounded-l-[3px]  border-gris-30 w-[30px] flex items-center"
                                    @click="count > 0 ? count-- : null; $wire.updateCart('{{$item->rowId}}',count)">
                                    <x-icons.chevron-left grosor="1" height="17px" width="17px" class="p-1 mx-auto fill-gris-30" />
                                </div>
                                <div>
                                    <input type="text"
                                        class="text-gris-10 font-bold bg-black h-[26px] mx-auto text-[12px] p-2 focus:ring-gris-50 focus:border-gris-50 w-[47px] border-gris-30 text-center border-x-0"
                                        placeholder=" " required="" x-model="count" @change="$wire.updateCart('{{$item->rowId}}',count)">
                                </div>
                                <div class="cursor-pointer hover:border-gris-10 text-gris-60 bg-black h-[26px] border-[1px] text-[12px] rounded-r-[3px]  border-gris-30 w-[30px] flex items-center"
                                    @click="count++, $wire.updateCart('{{$item->rowId}}',count)">
                                    <x-icons.chevron-right grosor="1" height="17px" width="17px" class="p-1 mx-auto fill-gris-30" />
                                </div>
                            </div>
                            <div>


                                <a  class="cursor-pointer" wire:click="removeRow('{{$item->rowId}}')">
                                    <x-icons.trash class="w-5 fill-corp-30"/>
                                <a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>

        <div class="col-span-2 md:col-span-1 space-y-4">
            <div class="bg-gris-100 px-6 py-3">
                <h5>Añadir Cupón</h5>
                <div class="flex space-x-2 my-2">
                    <input type="text"
                        class="text-gris-60 bg-black h-[30px] border-gris-70 text-[12px] pr-[26px] rounded-[3px] focus:ring-gris-50 focus:border-gris-50 w-full"
                        placeholder="Código de cupón" required="">
                    <div
                        class="border-[2px] rounded-[3px] border-corp-50 w-full text-center text-corp-20 cursor-pointer">
                        Aplicar cupón </div>
                </div>
            </div>
            <div class="bg-gris-100 p-6 py-3">
                <h5>Resumen de pedido</h5>
                <div class="flex justify-between my-8">
                    <p>Subtotal(4)</p>
                    <p>S/.{{ Cart::instance('cart')->subtotal() }}</p>
                </div>
                <div class="flex justify-between my-2">
                    <p>IVA</p>
                    <p>S/.{{ Cart::instance('cart')->tax() }}</p>
                </div>
                <div class="flex justify-between my-2 text-white">
                    <p>Sub Total</p>
                    <p>S/.{{ Cart::instance('cart')->total() }}</p>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="bg-gris-100  mx-auto w-[80%] p-4">
        <div class="w-2/3 mx-auto">
            <div class="mx-auto grid grid-cols-4 p-2">
                <div class="col-span-1 flex items-center">
                    <x-icons.cart class="w-20 mx-auto" />
                </div>
                <div class="col-span-3 text-center space-y-3">

                    <h4>Tu Carro está vacío</h4>
                    <p class="12px w-[80%] mx-auto">Inicia sesión para ver los productos que habías guardado en tu
                        carro.</p>
                </div>

            </div>
            <div class="my-6 mx-11 flex flex-col items-center space-y-1">
                <a href="{{route('web.shop.index')}}" class="w-full" >
                <x-button.webprimary class="w-full"> Añadir a Carrito</x-button.webprimary></a>
                <div class="flex space-x-2">
                    <p>¿No tienes cuenta?</p> <a class="text-corp-30 cursor-pointer"
                        href="{{ route('web.login_register') }}">Registrarse</a>
                </div>
                {{--  <p class="text-corp-30">Ir a tienda</p>  --}}
            </div>
        </div>
    </div>
    @endif
</div>
