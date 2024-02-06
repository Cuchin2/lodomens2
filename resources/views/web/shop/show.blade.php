@extends('layouts.web')

@section('breadcrumb')

<x-breadcrumb.lodomens.breadcrumb title="TIENDA">
    <x-breadcrumb.lodomens.breadcrumb2 name='Tienda' href="{{ route('web.shop.index') }}"  />
    <x-breadcrumb.lodomens.breadcrumb2 name='{{$product->category->name}}' href="#" class="hidden md:block"/>
    <x-breadcrumb.lodomens.breadcrumb2 name='{{$product->name}}' />
</x-breadcrumb.lodomens.breadcrumb>

@endsection
<video class="hidden lg:block fixed top-0" src="{{ asset('image/lodomens/video_fondo.mp4') }}" autoplay muted loop></video>
@section('content')
@php
$firstImage = $product->images->sortBy('order')->first();

@endphp
<div class="md:mx-5 lg:mx-auto lg:w-[987px] bg-black/75 px-5 pb-1" x-data="{ tab: 'tab1', ext:'{{ pathinfo(asset($firstImage ->url), PATHINFO_EXTENSION) }}' }">
    <div class="md:grid md:grid-cols-2">
        <div class="md:grid md:grid-cols-6 mt-5" x-data="{src: '{{ asset('storage/'.$firstImage->url) }}'}">
            <div class="pt-[20px] md:order-2 md:w-full md:col-span-5 md:p-2">
                <p x-tet="ext"></p>
 {{--                 <img  :src="src"
                class="w-full border-[2px] border-corp-50 rounded-[3px]" alt="">  --}}
                <template x-if="ext === 'mp4'">
                    <video :src="src" controls
                  class="w-full border-[2px] border-corp-50 rounded-[3px]" :alt="ext" alt="">
                </video>
                 </template>

                  <template x-if="ext === 'jpg' || ext === 'jpeg' || ext === 'png' || ext === 'gif'">
                  <img  :src="src"
                  class="w-full border-[2px] border-corp-50 rounded-[3px]" alt="">
                  </template>


            </div>
            <div
                class="flex md:block md:col-span-1 md:w-fit space-x-2 md:space-x-0 md:space-y-2 mt-2 overflow-x-auto md:overflow-x-hidden md:order-1">
                @foreach ($product->images->sortBy('order') as $image)
                @if (pathinfo(asset('storage/'.$image->url), PATHINFO_EXTENSION) === 'mp4')
                <div @click="src='{{ asset('storage/'.$image->url) }}', ext='mp4'">
                <video src="{{ asset('storage/'.$image->url) }}" muted
                class="w-[52px] border-[2px] border-corp-50 rounded-[3px] md:mx-auto cursor-pointer" >
                :class="{'border-gris-10': src === '{{ asset('storage/'.$image->url) }}'}"
                @click="src='{{ asset('storage/'.$image->url) }}', ext='mp4',alert('hola')">
                </video>
                 </div>
                @else
                <img src="{{ asset('storage/'.$image->url) }}"
                class="w-[52px] border-[2px] border-corp-50 rounded-[3px] md:mx-auto cursor-pointer"
                :class="{'border-gris-10': src === '{{ asset('storage/'.$image->url) }}'}"
                @click="src='{{ asset('storage/'.$image->url) }}', ext='{{ pathinfo(asset('storage/'.$image->url), PATHINFO_EXTENSION) }}'">
                @endif

                @endforeach
            </div>
        </div>
        <hr class="md:hidden mt-[20px] mb-[10px] border-gris-70 ">
        <div class="md:pt-[20px] md:ml-[20px]">
            <div>
                <h3>{{ $product->name }}</h3>
                <div class="mb-2 cursor-pointer flex" x-data
                    x-on:click="$scroll('#second', { offset: 200 }); tab = 'tab2'">
                   <livewire-starmain  product="{{ $product->id }}"/>
                    <p class="text-gris-30"> - {{ $product->reviews->count() }} reseñas -</p>
                </div>
                <div class="flex space-x-3">
                    <h4>S/. {{ $product->sell_price }}</h4>
                    <h5 class="line-through text-gris-70">S/.65 </h5>
                </div>
                <p class="mt-4 text-justify">{{ $product->short_description }}</p>
                <div class="flex my-4 space-x-1">
                    <h5> COLOR</h5>
                    <div>
                        <svg width="72" height="34" viewBox="0 0 72 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="Colores">
                                <path id="Ellipse 16"
                                    d="M30.3631 17C30.3631 24.4715 24.5063 30.5 17.3158 30.5C10.1254 30.5 4.26855 24.4715 4.26855 17C4.26855 9.52854 10.1254 3.5 17.3158 3.5C24.5063 3.5 30.3631 9.52854 30.3631 17Z"
                                    fill="url(#paint0_linear_386_4871)" stroke="#A4A4A4" />
                                <path id="Ellipse 21"
                                    d="M32.2662 17C32.2662 25.6073 25.5267 32.5 17.316 32.5C9.10527 32.5 2.36572 25.6073 2.36572 17C2.36572 8.39273 9.10527 1.5 17.316 1.5C25.5267 1.5 32.2662 8.39273 32.2662 17Z"
                                    stroke="#900D0D" stroke-width="3" />
                                <path id="Ellipse 19"
                                    d="M71.0052 17C71.0052 24.4715 65.1483 30.5 57.9579 30.5C50.7675 30.5 44.9106 24.4715 44.9106 17C44.9106 9.52854 50.7675 3.5 57.9579 3.5C65.1483 3.5 71.0052 9.52854 71.0052 17Z"
                                    fill="url(#paint1_linear_386_4871)" stroke="#A4A4A4" />
                            </g>
                            <defs>
                                <linearGradient id="paint0_linear_386_4871" x1="1.73647" y1="6.5" x2="31.6209"
                                    y2="30.0379" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#1E1E1E" />
                                    <stop offset="0.46875" stop-color="#ACAAAA" />
                                    <stop offset="0.708333" stop-color="#D9D9D9" stop-opacity="0.421569" />
                                    <stop offset="1" stop-color="#D9D9D9" stop-opacity="0" />
                                </linearGradient>
                                <linearGradient id="paint1_linear_386_4871" x1="42.3786" y1="6.5" x2="72.263"
                                    y2="30.0379" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#55410D" />
                                    <stop offset="0.46875" stop-color="#C79719" />
                                    <stop offset="0.708333" stop-color="#DA991B" stop-opacity="0.421569" />
                                    <stop offset="1" stop-color="#E29E1A" stop-opacity="0" />
                                </linearGradient>
                            </defs>
                        </svg>
                    </div>
                </div>
                <div class="flex space-x-1 mb-4">
                    <h5> Disponible : {{ $product->stock }} {{ ($product->stock > 1) ? 'unidades' : 'unidad'}} </h5>
                 </div>

                <div class="flex justify-center space-x-3">
                    <div class="flex" x-data={count:null}>
                        <div class="cursor-pointer hover:border-gris-10 text-gris-60 bg-black h-[30px] border-[1px] text-[12px] rounded-l-[3px]  border-gris-50 w-[30px] flex items-center"
                            @click="count > 0 ? count-- : null">
                            <x-icons.chevron-left height="20px" width="20px" class="p-1 mx-auto fill-gris-30" />
                        </div>
                        <div>
                            <input type="text"
                                class="text-gris-60 bg-black h-[30px] mx-auto text-[12px] p-2 focus:ring-gris-50 focus:border-gris-50 w-[40px] border-gris-50 text-center"
                                placeholder=" 0" required="" x-model="count">
                        </div>
                        <div class="cursor-pointer hover:border-gris-10 text-gris-60 bg-black h-[30px] border-[1px] text-[12px] rounded-r-[3px]  border-gris-50 w-[30px] flex items-center"
                            @click="count++">
                            <x-icons.chevron-right height="20px" width="20px" class="p-1 mx-auto fill-gris-30" />
                        </div>
                    </div>
                    <button class="bg-corp-50 rounded-[3px] px-4">
                        Añadir a Carrito
                    </button>
                </div>
                <div class="flex my-4 space-x-2">
                    <x-icons.heart class="w-[20px]" />
                    <p class="text-[12px]">Añadir a lista de deseos</p>
                </div>
                <div class="my-4">
                    <div class="flex">
                        <p class="text-[12px] text-white mr-1">Categorias :</p>
                        <p class="text-[12px] text-gris-10">{{ $product->category->name }}</p>
                    </div>
                    <div class="flex">

                        @if($product->tags->isNotEmpty())
                        <p class="text-[12px] text-white mr-1">Etiquetas :</p>
                        @endif
                        @foreach ($product->tags as $key => $tag)
                        <p class="text-[12px] text-gris-10">
                            {{ $tag->name }}
                            @if (!$loop->last)
                            ,
                            @endif
                        </p>
                        @endforeach
                    </div>
                </div>
                <div class="flex">
                    <p class="text-[12px] text-white mr-2">Compartir en:</p>
                    <div class="flex space-x-3 ">
                        <div
                            class="h-[24px] w-[24px] border-[1px] border-corp-50 rounded-[3px] flex justify-center items-center ">
                            <a href="https://www.instagram.com/lodo.mens" target="_blank">
                                <x-icons.socialmedia.instagram class="h-[15px] fill-corp-50 hover:fill-corp-30" />
                            </a>
                        </div>
                        <div
                            class="h-[24px] w-[24px] border-[1px] border-corp-50 rounded-[3px] flex justify-center items-center ">
                            <a href="https://www.tiktok.com/@lodo.mens" target="_blank">
                                <x-icons.socialmedia.tiktok class="h-[15px] fill-corp-50 hover:fill-corp-30" />
                            </a>
                        </div>
                        <div
                            class="h-[24px] w-[24px] border-[1px] border-corp-50 rounded-[3px] flex justify-center items-center ">
                            <a href="https://www.facebook.com/profile.php?id=100077757468220" target="_blank">
                                <x-icons.socialmedia.facebook class="h-[15px] fill-corp-50 hover:fill-corp-30" />
                            </a>
                        </div>
                        <div
                            class="h-[24px] w-[24px] border-[1px] border-corp-50 rounded-[3px] flex justify-center items-center ">
                            <a href="https://www.youtube.com/@Lodomens" target="_blank">
                                <x-icons.socialmedia.youtube class="h-[15px] fill-corp-50 hover:fill-corp-30" />
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
    <hr class="mt-[20px] mb-[10px] border-gris-70">
    <div>
        {!! $product->long_description !!}
       {{--   <div class="space-y-4 text-justify">
            <h3 class="text-center">Tamaño y Materiales</h3>
            <h4>Titulo Heading 3</h4>

            <h5>Heading 4</h5>
            <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                ex
                ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                fugiat
                nulla pariatur".</p>
            <h5>Heading 4</h5>
            <ul class="ml-8 list-disc leading-7">
                <li>Títutlo 1</li>
                <li>Títutlo 2</li>
                <li>Títutlo 3</li>
            </ul>
            <h5>Heading 4</h5>
            <p>Ssed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                exercitation ullamco la "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                velit
                esse cillum dolore eu fugiat nulla pariatur. Doris nisi ut aliquip ex ea commodo consequat. Duis aute
                irure
                dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur".</p>
            <p>
                "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Ut enim ad minim veniam, quis nos".</p>
        </div>  --}}
        <hr class="my-[40px] border-gris-70">
        <div id="second">
            <div class="mx-auto mb-4">
                <ul class="flex mb-6">
                    <li class="-mb-px mr-1">
                        <a class="inline-block rounded-t py-2 px-4 font-semibold hover:text-corp-50" href="#"
                            :class="{ ' text-corp-30 border-b border-corp-50': tab == 'tab1'}"
                            @click.prevent="tab = 'tab1'">Comentarios</a>
                    </li>
                    <li class="-mb-px mr-1">
                        <a class="inline-block py-2 px-4  hover:text-corp-50 font-semibold" href="#"
                            :class="{ ' text-corp-30 border-b border-corp-50': tab == 'tab2'}"
                            @click.prevent="tab = 'tab2'">Reseñas</a>
                    </li>
                    <div class="my-auto ml-auto w-[120px]">
                        <x-select class="">
                            <option>Option 1</option>
                            <option>Option 2</option>
                            <option>Option 3</option>
                        </x-select>
                    </div>

                </ul>
                <div>
                    <div x-show="tab == 'tab1'">
                        <livewire-comment commentableType="App\\Models\\Product" commentableId="{{$product->id}}" />
                    </div>
                    <div x-show="tab == 'tab2'" >
                        {{-- estrellas --}}
                            <livewire-review commentableType="App\\Models\\Product" reviewableId="{{$product->id}}" />
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
</div>

@endsection
