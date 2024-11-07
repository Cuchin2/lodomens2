@extends('layouts.web')

@section('breadcrumb')

<x-breadcrumb.lodomens.breadcrumb title="TIENDA">
    <x-breadcrumb.lodomens.breadcrumb2 name='Tienda' href="{{ route('web.shop.index') }}"  />
    <x-breadcrumb.lodomens.breadcrumb2 name='{{$product->category->name}}' href="{{ route('web.shop.index',['category_id'=>$product->category->id]) }}" class="hidden md:block"/>
    <x-breadcrumb.lodomens.breadcrumb2 name='{{$product->name}}' />
</x-breadcrumb.lodomens.breadcrumb>

@endsection
{{--  <x-lodomens.video />  --}}
@section('content')

<div class="md:mx-5 lg:mx-auto lg:w-[987px] bg-black/75 md:px-16 px-2 pb-1"
 x-data="{ tab: 'tab1', colorselect:'{{ $indice }}', colorid: '@json($colorId)', abc:'0', src: '{{ asset('storage/'.$firstImage->url) }}', skus: {{ json_encode($skus) }}, skuselect:{{ $skus[$indice]->color_id }},
 showBtn: false, isVideo: true, review: '{{ $review }}', offset: window.innerWidth <= 758 ? -350 : 150,
 getImage(a,b) {
    axios.get('{{ route('getimage.product.select') }}', {
        params: {
          row: a,
          colorid: b,
          id: {{ $product->id }}
          // Agrega más parámetros según sea necesario
        }
      })
      .then(response => {
        // Manejar la respuesta del backend
        if(response.data.url){
        this.src = '{{ asset('storage') }}/'+response.data.url;
        this.checkextensions(this.src);
        }
      })
      .catch(error => {
        // Manejar cualquier error que ocurra durante la solicitud
        console.error('Error al enviar la imagen al backend:', error);
      });
},
checkextensions(url){
 const extension = url.split('.').pop().toLowerCase();
        const videoExtensions = ['mp4', 'webm', 'mov','avi'];
        this.isVideo = videoExtensions.includes(extension);
},
 }" x-init="checkextensions(src); if(review) { $scroll('#second', { offset: offset  }); tab = 'tab2';}">
    <div class="md:grid md:grid-cols-2 text-gris-30">
        <div class="md:grid md:grid-cols-6 mt-5">
            <div class="pt-[20px] md:order-2 md:w-full md:col-span-5 md:p-2 flex items-start" >
                {{--  <p x-text="ext"></p>  --}}
                <lodo class="md:w-[338px] lg:h-[338px] md:h-[217px] lg:min-w-[318px] relative mx-auto border-[2px] rounded-[3px] flex items-center overflow-hidden" style="border-color: {{ $product->type->hex ?? ''}}"
                        @mouseenter="showBtn = true"
                        @mouseleave="showBtn = false"
                    >
                    <img class="absolute top-5 left-5" src="{{ asset('storage').'/'.($product->type->images->url ??'') }}" alt="" style="z-index: 20;">
                    <template x-if="isVideo">
                        <video :src="src" class="rounded-[3px] h-full w-full" style="z-index: 10;" controls

                        ></video>
                    </template>
                    <template x-if="!isVideo">
                        <img :src="src" class="rounded-[3px] transition duration-500 mx-auto w-full h-full" :class="showBtn ? 'scale-125' : ''"
                        alt="{{ $product->name }}" >
                    </template>



                  @if($product->skus)
                  <template x-for="sku in skus" @sku.window="skuselect=$event.detail.parm">
                    <div x-show="skuselect === parseInt(sku.color_id)" x-cloak class="absolute top-0 left-0 w-full h-full flex items-center justify-center" :class="{'bg-black/80 ': sku.stock == 0 }">
                        <template x-if="sku.stock == 0" >
                        <span class="text-gris-20 text-[14px] font-bold bg-gris-90 p-2 border-[2px]  border-corp-50 rounded-[3px]">SIN STOCK</span>
                        </template>
                    </div>
                    </template>
                    @endif
                </lodo>
            </div>
            @foreach ($imagenes as $key =>$images)
            <div
                class="md:max-h-[254px] lg:max-h-[370px] scroll-none flex md:block md:col-span-1 md:w-fit space-x-2 md:space-x-0 md:space-y-2 mt-2 overflow-x-auto md:overflow-x-hidden md:order-1" @send.window="colorselect=$event.detail.parm;" x-show="colorselect === '{{ $key }}'">

                @foreach ($images as $key2=>$image)
                <div x-data="{
                    imageUrl:'{{ asset('storage/'.$image->url) }}',
                    isVideo2: null,
                    checkextension2() {
                    const extension = this.imageUrl.split('.').pop().toLowerCase();
                    const videoExtensions = ['mp4', 'webm', 'mov','avi'];
                    this.isVideo2 = videoExtensions.includes(extension);
                    },
                    }" x-init="checkextension2()">
                    <template x-if="isVideo2">
                        <video :src="imageUrl"  class="w-[52px] min-h-[52px] border-[2px] border-corp-50 rounded-[3px] md:mx-auto cursor-pointer" style="border-color: {{ $product->type->hex ?? ''}}"
                            :class="{'!border-gris-10': src === imageUrl }"
                             @click="src=imageUrl, abc='{{ $key2 }}', isVideo = true"
                            >
                    </template>
                    <template x-if="!isVideo2">
                        <img :src="imageUrl" class="w-[52px] border-[2px] border-corp-50 rounded-[3px] md:mx-auto cursor-pointer" style="border-color: {{ $product->type->hex ?? ''}}"
                        :class="{'!border-gris-10': src === imageUrl }"
                        @click="src=imageUrl, abc='{{ $key2 }}', isVideo = false "
                        >
                    </template>
                </div>


                @endforeach


            </div>
            @endforeach
        </div>
        <hr class="md:hidden mt-[20px] mb-[10px] border-gris-70 ">
        <div class="md:pt-[20px] md:ml-[20px]">
            <div>
                <div class="flex" x-data="{skus: {{ json_encode($skus) }}, skuselect:{{ $skus[$indice]->color_id }}}">
                    <p class="mr-1 text-corp-30">{{ $product->brand->name }}</p>
                    @if($product->skus)
                        <template x-for="sku in skus" @sku.window="skuselect=$event.detail.parm;">
                            <p x-text="'| SKU : '+sku.code" x-show="skuselect === parseInt(sku.color_id)" x-cloak></p>
                        </template>
                    @endif

                </div>
                <h3>{{ $product->name }}</h3>
                <div class="mb-2 cursor-pointer flex items-center" x-data
                    x-on:click="$scroll('#second', { offset: 200 }); tab = 'tab2'">
                    @if ($product->reviews->count() === 0)

                    @else
                    <livewire-starmain  product="{{ $product->id }}"/>
                        <p class="text-gris-30"> {{ $product->reviews->count() }} {{  $product->reviews->count() === 1 ? 'Reseña' : 'Reseñas' }} </p>
                    @endif

                </div>
                <div class="flex space-x-3">
                    <div class="flex items-center justify-between">
                        <template x-for="sku in skus" @sku.window="skuselect=$event.detail.parm">
                            <h4 x-text="'{{ session('currency') }} '+sku.sell_price"x-show="skuselect === parseInt(sku.color_id)" x-cloak></h4>
                        </template>
                    </div>
                    {{--  <h5 class="line-through text-corp-50">{{ session('currency') }}65 </h5>  --}}
                </div>
                <p class="mt-4 text-justify">{{ $product->short_description }}</p>
                <div class="flex my-4 space-x-1 items-center">
                    <p class="font-bold"> {{ $colorSelect->count() === 1 ? 'COLOR: ' : 'COLORES: ' }}</p class="font-bold">
                    <div class="flex space-x-2" x-data="{active:'{{ $indice }}'}">
                        @foreach ($colorSelect as $key => $color )
                            <div  class="h-[27px] w-[27px] rounded-full cursor-pointer hover:border-corp-50 hover:border-[3px]"           :class="{'border-corp-50 border-[3px]' : active === '{{ $key}}' }"
                            @if(!$color->url)
                            style="background:{{ $color->hex }}"
                            @endif

                            x-on:click="$dispatch('send',{ parm: '{{ $key }}' }); getImage(abc,{{ $color->id }}); active='{{ $key }}'; $dispatch('sku',{parm:{{ $color->id }}});">
                            @if($color->url)
                            <img src="{{ asset('storage/'.$color->url) }}"  class="rounded-full mx-auto w-full h-full" alt="">
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="flex space-x-1 mb-4">
                    @if($product->skus)
                    <template x-for="sku in skus" @sku.window="skuselect=$event.detail.parm">

                            <p  x-show="skuselect === parseInt(sku.color_id)" x-cloak x-text="sku.stock === 0 ? 'Fuera de stock' : (sku.stock === 1 ? 'Queda: 1 unidad' : 'Quedan: '+sku.stock+' unidades')"></p>
                   </template>
                    @endif

                 </div>
                <livewire:add-cart product="{{$product->id}}" color="{{ $colorId }}" product_name="{{ $product->name }}"/>

                <a class="flex my-4 space-x-2 hover:text-white cursor-pointer w-fit" @click=" $dispatch('add-wishlist',{ color: skuselect})">
                    <x-icons.heart class="w-[20px]" />
                    <p>Añadir a lista de deseos</p>
                </a>
                <div class="my-4">
                    <div class="flex">
                        <p class=" {{--  text-gris-10  --}} mr-1 font-bold">Categorias :</p>
                        <p class=" {{--  text-gris-10  --}}">{{ $product->category->name }}</p>
                    </div>
                    <div class="flex">

                        @if($product->tags->isNotEmpty())
                        <p class=" {{--  text-gris-10  --}} mr-1 font-bold">Etiquetas :</p>
                        @endif
                        @foreach ($product->tags as $key => $tag)
                        <p class="{{--  text-gris-10  --}}">
                            {{ $tag->name }}
                            @if (!$loop->last)
                            ,
                            @endif
                        </p>
                        @endforeach
                    </div>
                </div>
                <div class="flex">
                    <p class=" {{--  text-gris-10  --}} mr-2 font-bold">Compartir en:</p>
                    <div class="flex space-x-3 ">
                        <div
                            class="h-[24px] w-[24px] border-[1px] border-corp-50 rounded-[3px] flex justify-center items-center ">
                            <a href="https://www.instagram.com/lodo.mens" target="_blank">
                                <x-icons.socialmedia.simple.instagram class="h-[15px] fill-corp-50 hover:fill-corp-30" />
                            </a>
                        </div>
                        <div
                            class="h-[24px] w-[24px] border-[1px] border-corp-50 rounded-[3px] flex justify-center items-center ">
                            <a href="https://www.tiktok.com/@lodo.mens" target="_blank">
                                <x-icons.socialmedia.simple.tiktok class="h-[15px] fill-corp-50 hover:fill-corp-30" />
                            </a>
                        </div>
                        <div
                            class="h-[24px] w-[24px] border-[1px] border-corp-50 rounded-[3px] flex justify-center items-center ">
                            <a {{--  href="https://www.facebook.com/profile.php?id=100077757468220"  --}} target="_blank"
                            href="https://www.facebook.com/sharer/sharer.php?u={{ URL::current() }}"  rel="noopener noreferrer"
                            >
                                <x-icons.socialmedia.simple.facebook class="h-[15px] fill-corp-50 hover:fill-corp-30" />
                            </a>
                        </div>
                        <div
                            class="h-[24px] w-[24px] border-[1px] border-corp-50 rounded-[3px] flex justify-center items-center ">
                            <a href="https://www.youtube.com/@Lodomens" target="_blank">
                                <x-icons.socialmedia.simple.youtube class="h-[15px] fill-corp-50 hover:fill-corp-30" />
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
    <hr class="mt-[20px] mb-[10px] border-gris-70">
    <div class="text-gris-30">
        {!! $product->body !!}
        <hr class="my-[40px] border-gris-70">
        <div id="second" class="md:mx-16">
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
{{--                      <div class="my-auto ml-auto w-[120px]">
                        <x-select class="">
                            <option>Option 1</option>
                            <option>Option 2</option>
                            <option>Option 3</option>
                        </x-select>
                    </div>  --}}

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

