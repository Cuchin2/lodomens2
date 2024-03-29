@extends('layouts.web')

@section('breadcrumb')

<x-breadcrumb.lodomens.breadcrumb title="TIENDA">
    <x-breadcrumb.lodomens.breadcrumb2 name='Tienda' href="{{ route('web.shop.index') }}"  />
    <x-breadcrumb.lodomens.breadcrumb2 name='{{$product->category->name}}' href="#" class="hidden md:block"/>
    <x-breadcrumb.lodomens.breadcrumb2 name='{{$product->name}}' />
</x-breadcrumb.lodomens.breadcrumb>

@endsection
<x-lodomens.video />
@section('content')

<div class="md:mx-5 lg:mx-auto lg:w-[987px] bg-black/75 px-5 pb-1" x-data="{ tab: 'tab1', colorselect:'0', colorid: '@json($colorSelect[0]->id)',ext:'{{ pathinfo(asset($firstImage ->url), PATHINFO_EXTENSION) }}', abc:'0', src: '{{ asset('storage/'.$firstImage->url) }}', getImage(a,b) {
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
        this.src = '{{ asset('storage') }}/'+response.data.url;}
      })
      .catch(error => {
        // Manejar cualquier error que ocurra durante la solicitud
        console.error('Error al enviar la imagen al backend:', error);
      });
}
 }">
    <div class="md:grid md:grid-cols-2">
        <div class="md:grid md:grid-cols-6 mt-5">
            <div class="pt-[20px] md:order-2 md:w-full md:col-span-5 md:p-2 relat" >
                {{--  <p x-text="ext"></p>  --}}
                <lodo class="w-fit relative items-center h-fit mx-auto">
                <template x-if="ext === 'mp4'">
                    <video :src="src" controls
                  class="w-full border-[2px] border-corp-50 rounded-[3px]" :alt="ext" alt="">
                </video>

                 </template>

                  <template x-if="ext === 'jpg' || ext === 'jpeg' || ext === 'png' || ext === 'gif' || ext === 'svg'" >
                  <img  :src="src"
                  class="w-full border-[2px] border-corp-50 rounded-[3px]" alt="">

                  </template>
                  <div class="absolute top-0 left-0 w-full h-full flex items-center justify-center {{ $product->stock > 0 ? '':'bg-black/80 border-[2px] border-corp-50 rounded-[3px]' }}   "> @if ($product->stock < 1)
                    <span class="text-gris-20 text-[14px] font-bold bg-gris-90 p-2 border-[2px]  border-corp-50 rounded-[3px]">SIN STOCK</span>  @endif
                  </div>
                </lodo>
            </div>
            @foreach ($imagenes as $key =>$images)
            <div
                class="md:max-h-[254px] lg:max-h-[370px] scroll-none flex md:block md:col-span-1 md:w-fit space-x-2 md:space-x-0 md:space-y-2 mt-2 overflow-x-auto md:overflow-x-hidden md:order-1" @send.window="colorselect=$event.detail.parm;" x-show="colorselect === '{{ $key }}'">

                @foreach ($images as $key2=>$image)

                @if (pathinfo(asset('storage/'.$image->url), PATHINFO_EXTENSION) === 'mp4')
                <div @click="src='{{ asset('storage/'.$image->url) }}', ext='mp4'">
                <video src="{{ asset('storage/'.$image->url) }}" muted
                class="w-[52px] border-[2px] border-corp-50 rounded-[3px] md:mx-auto cursor-pointer" >
                :class="{'border-gris-10': src === '{{ asset('storage/'.$image->url) }}'}"
                @click="src='{{ asset('storage/'.$image->url) }}', ext='mp4', abc='{{ $key2 }}'">
                </video>
                 </div>
                @else
                <img src="{{ asset('storage/'.$image->url) }}"
                class="w-[52px] border-[2px] border-corp-50 rounded-[3px] md:mx-auto cursor-pointer"
                :class="{'border-gris-10': src === '{{ asset('storage/'.$image->url) }}'}"
                @click="src='{{ asset('storage/'.$image->url) }}', ext='{{ pathinfo(asset('storage/'.$image->url), PATHINFO_EXTENSION) }}', abc='{{ $key2 }}'">
                @endif

                @endforeach


            </div>
            @endforeach
        </div>
        <hr class="md:hidden mt-[20px] mb-[10px] border-gris-70 ">
        <div class="md:pt-[20px] md:ml-[20px]">
            <div>
                <div class="flex items-center justify-between"><h3>{{ $product->name }}</h3> @if($product->code)
                    <p>SKU: {{ $product->code }}</p>
                @endif
            </div>
                <div class="mb-2 cursor-pointer flex" x-data
                    x-on:click="$scroll('#second', { offset: 200 }); tab = 'tab2'">
                    @if ($product->reviews->count() === 0)

                    @else
                    <livewire-starmain  product="{{ $product->id }}"/>
                        <p class="text-gris-30"> - {{ $product->reviews->count() }} {{  $product->reviews->count() === 1 ? 'Reseña' : 'Reseñas' }} -</p>
                    @endif

                </div>
                <div class="flex space-x-3">
                    <h4>S/. {{ $product->sell_price }}</h4>
                    <h5 class="line-through text-gris-70">S/.65 </h5>
                </div>
                <p class="mt-4 text-justify">{{ $product->short_description }}</p>
                <div class="flex my-4 space-x-1">
                    <p class="font-bold"> {{ $colorSelect->count() === 1 ? 'COLOR: ' : 'COLORES: ' }}</p class="font-bold">
                    <div class="flex space-x-2" x-data="{active:'0'}">
                        @foreach ($colorSelect as $key => $color )
                            <div  class="h-[27px] w-[27px] rounded-full cursor-pointer hover:border-corp-50 hover:border-[3px]"           :class="{'border-corp-50 border-[3px]' : active === '{{ $key}}' }" style="background: {{ $color->hex }}" x-on:click="$dispatch('send',{ parm: '{{ $key }}' }); getImage(abc,{{ $color->id }}); active='{{ $key }}'"> </div>
                        @endforeach
                    </div>
                </div>
                <div class="flex space-x-1 mb-4">

                        @if($product->stock > 0)
                        <p class="font-bold">    Disponible :  </p>
                         <p>{{ $product->stock }} {{ ($product->stock > 1) ? 'unidades' : 'unidad'}}</p>
                        @else
                        <p class="font-bold"> Fuera de stock </p>
                        @endif

                 </div>

                <div class="flex justify-left space-x-3">
                    <div class="flex" x-data={count:0}>
                        <div class="cursor-pointer hover:border-gris-10 text-gris-60 bg-black h-[36px] border-[1px] text-[12px] rounded-l-[3px]  border-gris-30 w-[30px] flex items-center"
                            @click="count > 0 ? count-- : null">
                            <x-icons.chevron-left grosor="1" height="20px" width="20px" class="p-1 mx-auto fill-gris-30" />
                        </div>
                        <div>
                            <input type="text"
                                class="text-gris-10 font-bold bg-black h-[36px] mx-auto text-[14px] p-2 focus:ring-gris-50 focus:border-gris-50 w-[52px] border-gris-30 text-center border-x-0"
                                placeholder=" " required="" x-model="count">
                        </div>
                        <div class="cursor-pointer hover:border-gris-10 text-gris-60 bg-black h-[36px] border-[1px] text-[12px] rounded-r-[3px]  border-gris-30 w-[30px] flex items-center"
                            @click="count++">
                            <x-icons.chevron-right grosor="1" height="20px" width="20px" class="p-1 mx-auto fill-gris-30" />
                        </div>
                    </div>

                    <x-button.webprimary class="w-full"> Añadit a Carrito</x-button.webprimary>

                    {{--  <button class="bg-gradient-to-b from-corp-20 via-corp-50 to-corp-90  text-gris-10 rounded-[3px] px-4 font-bold w-full h-[36px]">
                        Añadir a Carrito
                    </button>  --}}
                </div>
                <div class="flex my-4 space-x-2">
                    <x-icons.heart class="w-[20px]" />
                    <p>Añadir a lista de deseos</p>
                </div>
                <div class="my-4">
                    <div class="flex">
                        <p class=" text-gris-10 mr-1 font-bold">Categorias :</p>
                        <p class=" text-gris-10">{{ $product->category->name }}</p>
                    </div>
                    <div class="flex">

                        @if($product->tags->isNotEmpty())
                        <p class=" text-gris-10 mr-1 font-bold">Etiquetas :</p>
                        @endif
                        @foreach ($product->tags as $key => $tag)
                        <p class="text-gris-10">
                            {{ $tag->name }}
                            @if (!$loop->last)
                            ,
                            @endif
                        </p>
                        @endforeach
                    </div>
                </div>
                <div class="flex">
                    <p class=" text-gris-10 mr-2 font-bold">Compartir en:</p>
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
        {!! $product->body !!}
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

