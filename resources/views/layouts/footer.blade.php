{{--   Responsive  --}}
<footer class=" bg-gris-90 md:hidden border-t-[1px] border-t-gris-70 z-20" aria-labelledby="footer-heading">
    <h2 id="footer-heading" class="sr-only">Footer</h2>
    <div class="max-w-7xl mx-auto">

        <div class=" grid md:grid-cols-3  xl:col-span-2 text-center" x-data="{ openItem: null }">
            <div class="col-12  border-b-[1px] border-b-gris-70 py-[9.4px] cursor-pointer">
                <h3 @click="openItem === 1 ? openItem = null : openItem = 1"
                    class="collapsible text-sm font-semibold text-gris-10 tracking-wider uppercase">
                    {{--  ¿Quiénes Somos?  --}} {{ $datos['title'] }}
                    <!-- :class="open ? 'fa-chevron-down' : 'fa-chevron-up'" -->
                    <span class="absolute right-[0.5px] text-gris-10 hover:text-gris-30 md:hidden cursor-pointer">
                        <svg :class="openItem === 1 ? 'hidden' : 'block'" xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 mr-[14px]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                        <svg :class="openItem === 1 ? 'block' : 'hidden'" x-cloak="mobile"
                            xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-[14px]" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                        </svg>
                    </span>

                </h3>
                <ul x-show="openItem === 1" x-collapse.duration.400ms x-cloak="mobile" role="list"
                    class="content space-y-0 text-[13px] mb-1 text-gris-10 cursor-default">
                    <li class="mt-2">
                        {!! nl2br(e($datos['content'])) !!}
                    </li>
{{--                      <li class="mt-2">
                            Joyería y moda masculina
                    </li>
                    <li>
                            Potencia tu imagen y tu estilo
                    </li>
                    <li>
                            La perfección está en los detalles
                    </li>  --}}

                </ul>
            </div>
            <div class="col-12  border-b-[1px] border-b-gris-70 py-[9.4px] cursor-pointer">
                <h3 @click="openItem === 2 ? openItem = null : openItem = 2"
                    class="collapsible text-sm font-semibold text-gris-10 tracking-wider uppercase">
                    Contacto
                    <span class="absolute right-[0.5px] text-gris-10 hover:text-gris-30 md:hidden ">
                        <svg :class="openItem === 2 ? 'hidden' : 'block'" xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 mr-[14px]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                        <svg :class="openItem === 2 ? 'block' : 'hidden'" x-cloak="mobile"
                            xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-[14px]" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                        </svg>
                    </span>
                </h3>
                <ul x-show="openItem === 2" x-collapse.duration.400ms x-cloak="mobile" role="list"
                    class="content space-y-1 text-[13px] mx-[20px] mb-1 cursor-default">
                    <li class="mt-[10px]">
                        <div
                            class=" text-gris-10 flex">
                            <x-icons.address class="h-[15px] mr-4 mt-1"/> <p>{{ $datos['address'] }}</p>
                        </div>
                    </li>

                    <li>
                        <div
                            class=" text-gris-10 flex">
                            <x-icons.phone class="h-[15px] mr-4 mt-1"/> <p>+51 {{ $datos['phone'] }}</p>
                        </div>
                    </li>

                    <li>
                        <div
                            class=" text-gris-10 flex">
                            <x-icons.mail class="h-[15px] mr-4 mt-1"/> <p>{{ $datos['email'] }}</p>
                        </div>
                    </li>

                    <li>
                        <div
                            class=" text-gris-10 flex">
                            <x-icons.pedidos class="h-[15px] mr-4 mt-1"/> <p class="text-left">{{ $datos['order_message'] }}</p>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-12  py-[13.4px]  mx-auto">
                <div class="flex justify-between w-[270px]">
                    @foreach ($datos['redes'] as $red)
                    <a href="{{$red->url }}"alt="">
                        <x-dynamic-component :component="'icons.socialmedia.'.$red->name" :class="'h-[15.5px] fill-gris-10 hover:fill-corp-50'" />
                    </a>
                    @endforeach
                </div>
            </div>

        </div>


    </div>
</footer>
 {{--  normal  --}}
<footer class="bg-gris-90 hidden md:flex h-[182px]  border-t-[1px] border-t-gris-70 " aria-labelledby="footer-heading">

    <div class=" mx-auto mt-[20px] px-4  lg:px-8">

        <div class="grid lg:grid-cols-3 gap-[120px] md:grid-cols-2 xl:col-span-2 ">
            <div class="col-12 md:col-4 text-gris-10 ">
                <h3
                    class="collapsible font-semibold tracking-wider mb-[10px] uppercase">
                    {{--  ¿Quiénes Somos?  --}}
                    {{ $datos['title'] }}

                </h3>
                <ul class="list h-[81px] w-[310px] leading-[27px]"
                    class="content ">
                    <li>
                        {!! nl2br(e($datos['content'])) !!}
                            {{--  Joyería y moda masculina Potencia tu imagen y tu estilo La perfección está en los detalles  --}}

                    </li>

                </ul>
            </div>
            <div class="hidden lg:block col-12 md:col-4 mx-auto w-[300px]">
                    <img src="{{ asset('storage/'.$datos['logo']) }}" alt=""  class="w-auto h-[82px] mx-auto">


                <div class="mt-[25px] flex justify-between">
                    @foreach ($datos['redes'] as $red)
                    <a href="{{$red->url }}"alt="">
                        <x-dynamic-component :component="'icons.socialmedia.'.$red->name" :class="'h-[15.5px] fill-gris-10 hover:fill-corp-50'" />
                    </a>
                @endforeach
{{--                      <a href="https://www.instagram.com/lodo.mens" target="_blank"><x-icons.socialmedia.instagram class="h-[15.5px] fill-gris-10 hover:fill-corp-50"/></a>
                    <a href="https://www.tiktok.com/@lodo.mens" target="_blank"><x-icons.socialmedia.tiktok class="h-[15.5px] fill-gris-10 hover:fill-corp-50"/></a>
                    <a href="https://www.facebook.com/profile.php?id=100077757468220" target="_blank"><x-icons.socialmedia.facebook class="h-[15.5px] fill-gris-10 hover:fill-corp-50"/></a>
                    <a href="https://www.youtube.com/@Lodomens" target="_blank"><x-icons.socialmedia.youtube class="h-[15.5px] fill-gris-10 hover:fill-corp-50"/></a>
                    <a href="https://www.youtube.com/@Lodomens" target="_blank"><x-icons.socialmedia.spotify class="h-[15.5px] fill-gris-10 hover:fill-corp-50"/></a>
                    <a href="https://www.youtube.com/@Lodomens" target="_blank"><x-icons.socialmedia.pinterest class="h-[15.5px] fill-gris-10 hover:fill-corp-50"/></a>
                    <a href="https://www.youtube.com/@Lodomens" target="_blank"><x-icons.socialmedia.flikr class="h-[15.5px] fill-gris-10 hover:fill-corp-50"/></a>  --}}
                </div>

            </div>
            <div class="col-12 md:col-4">

                <ul  role="list"
                    class="content space-y-3 cola">
                    <li>
                        <div
                            class="text-base text-gris-10 flex">
                            <x-icons.address class="h-[20px] mr-4"/> <p>{{ $datos['address'] }}</p>
                    </div>
                    </li>

                    <li>
                        <div
                            class="text-base text-gris-10 flex">
                            <x-icons.phone class="h-[20px] mr-4"/> <p>+51 {{ $datos['phone'] }}</p>
                    </div>
                    </li>

                    <li>
                        <div
                            class="text-base text-gris-10 flex">
                            <x-icons.mail class="h-[20px] mr-4"/> <p>{{ $datos['email'] }}</p>
                    </div>
                    </li>

                    <li>
                        <div
                            class="text-base text-gris-10 flex">
                            <x-icons.pedidos class="h-[20px] mr-4"/> <p>{{ $datos['order_message'] }}</p>
                    </div>
                    </li>


                </ul>
            </div>

        </div>


    </div>
</footer>
<div class="md:px-4 lg:px-auto hidden md:flex lg:h-[35px] md:h-[50px] md:text-[14px] text-[12px] bg-gris-90 text-gris-10 border-t-[1px] border-t-gris-70 ">
<div class="items-center hidden md:grid md:grid-cols-2 md:gap-[120px] md:mx-auto lg:flex md:px-[50px]">
    <div class="lg:flex">

        <p class=" lg:block md:hidden">© {{ now()->year }} </p> <p class="lg:ml-1"> Realizado por <a href="https://www.instagram.com/nubesita.estudio/" target="__blank" class="hover:text-corp-50 font-bold">Nubesita Estudio</a></p>
    </div>
    <div class="md:flex lg:hidden justify-between  w-[280px]">
        @foreach ($datos['redes'] as $red)
            <a href="{{$red->url }}"alt="">
                <x-dynamic-component :component="'icons.socialmedia.'.$red->name" :class="'h-[15.5px] fill-gris-10 hover:fill-corp-50'" />
            </a>
        @endforeach
{{--          <a href="https://www.instagram.com/lodo.mens" target="_blank"><x-icons.socialmedia.instagram class="h-[15.5px] fill-gris-10 hover:fill-corp-50"/></a>
        <a href="https://www.tiktok.com/@lodo.mens" target="_blank"><x-icons.socialmedia.tiktok class="h-[15.5px] fill-gris-10 hover:fill-corp-50"/></a>
        <a href="https://www.facebook.com/profile.php?id=100077757468220" target="_blank"><x-icons.socialmedia.facebook class="h-[15.5px] fill-gris-10 hover:fill-corp-50"/></a>
        <a href="https://www.youtube.com/@Lodomens" target="_blank"><x-icons.socialmedia.youtube class="h-[15.5px] fill-gris-10 hover:fill-corp-50"/></a>

        <a href="https://www.youtube.com/@Lodomens" target="_blank"><x-icons.socialmedia.spotify class="h-[15.5px] fill-gris-10 hover:fill-corp-50"/></a>
        <a href="https://www.youtube.com/@Lodomens" target="_blank"><x-icons.socialmedia.pinterest class="h-[15.5px] fill-gris-10 hover:fill-corp-50"/></a>
        <a href="https://www.youtube.com/@Lodomens" target="_blank"><x-icons.socialmedia.flikr class="h-[15.5px] fill-gris-10 hover:fill-corp-50"/></a>  --}}
    </div>
</div>
</div>
