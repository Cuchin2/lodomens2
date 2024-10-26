@props(['outstock','zerostock'])
@if($outstock || $zerostock)
<div
    x-data="{ show: true }"
    x-on:close.stop="show = false"
    x-on:keydown.escape.window="show =false"
    x-show="show"
    class="jetstream-modal fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50"

>
    <div x-show="show" class="fixed inset-0 transform transition-all" x-on:click="show = false" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0">
        <div class="absolute inset-0 bg-gray-500 bg-black/40"></div>
    </div>
    <div class="flex items-center h-full">
    <div x-show="show" class="  bg-gris-90 rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-md sm:mx-auto"
                    x-trap.inert.noscroll="show"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                    <div class="px-6 py-4">
                        @if ($outstock)
                        <div class="text-lg font-medium  text-gris-10">
                            <h4 class="text-center">Anuncio</h4>
                            <p class="text-justify">
                                Los siguientes productos han modificado su nivel de stock, se están agotando.
                            </p>
                        </div>

                        <div class="mt-4 text-[15px]  text-gris-10">
                            @foreach ($outstock as $item)

                            <div class="mb-4 text-justify">
                                <div class="flex justify-between mb-2">
                                    <p class="font-bold">{{ $item->name }}</p>
                                    <p class="font-bold">{{session('currency')}} {{ $item->qty*$item->price }}</p>
                                </div>
                                <div class="grid grid-cols-3 gap-4">
                                    <div class="col-span-1">
                                        <div class="flex w-max items-center">
                                            <x-outstock text="text-[10px]" class="!w-[50px] !h-[50px] md:!w-[65px] md:!h-[65px]"
                                                url="{{ $item->options->productImage }}" name="{{ $item->name }}"
                                                stock="{{ $item->options->stock }}" color="{{$item->options->hex}}" img="{{$item->options->src}}" param="scale-50 top-0 left-0"/>
                                        </div>
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
                        @endif
                        @if ($zerostock)
                        <div class="text-lg font-medium  text-gris-10">
                            <p class="text-justify">
                                Los siguientes productos se han agotando.
                            </p>
                        </div>

                        <div class="mt-4 text-[15px]  text-gris-10">
                            @foreach ($zerostock as $item)

                            <div class="mb-4 text-justify">
                                <div class="flex justify-between mb-2">
                                    <p class="font-bold">{{ $item->name }}</p>
                                    <p class="font-bold">{{session('currency')}} {{ $item->qty*$item->price }}</p>
                                </div>
                                <div class="grid grid-cols-3 gap-4">
                                    <div class="col-span-1">
                                        <div class="flex w-max items-center">
                                            <x-outstock text="text-[10px]" class="!w-[50px] !h-[50px] md:!w-[65px] md:!h-[65px]"
                                                url="{{ $item->options->productImage }}" name="{{ $item->name }}"
                                                stock="{{ $item->options->stock }}" color="{{$item->options->hex}}" img="{{$item->options->src}}" param="scale-50 top-0 left-0"/>
                                        </div>
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
                        @endif
                    </div>

                    <div class="flex flex-row justify-end px-6 py-4 bg-gris-90 text-end">
                        <div class="flex justify-center w-full">
                            <x-button.corp1 @click=" show=false;">
                                Aceptar
                            </x-button.corp1>
                        </div>
                    </div>
    </div>
    </div>
</div>
@endif
