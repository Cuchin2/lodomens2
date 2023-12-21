<header class="absolute w-full" x-data="{ open: false }">
    <div class="flex items-center justify-between flex-wrap bg-black w-full  h-[44px] md:h-[84px]">
        <button @click="open = !open" @click.away="open = false" class="md:hidden mr-4 ml-2 my-2 ">
            <x-icons.hamburger class="h-[22.231px] w-[16.94px]" fill="#A4A4A4" grosor="2" />
        </button>
        <div
            class="absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2 md:relative md:flex md:top-1/4 md:left-[104px]">
            <a href="../../">
                <x-lodomens.icons.logo_secundario class="md:h-[40px] h-[27px]" />
            </a>
        </div>


        {{-- Menu normal --}}
        <div
            class=" w-full md:w-auto mx-auto hidden md:block md:absolute md:left-1/2 md:top-1/2 md:transform md:-translate-x-1/2 md:-translate-y-1/2">
            <ul class="md:flex text-gris-10 md:text-[12px] lg:text-[14px]">


                <li class="mr-6 p-1 ">
                    <a class="hover:text-corp-50" href="#">INICIO</a>
                </li>
                <li class="mr-6 p-1">
                    <a class="hover:text-corp-50" href="#">TIENDA</a>
                </li>
                <li class="mr-6 p-1">
                    <a class="hover:text-corp-50" href="#">CONTACTO</a>
                </li>
            </ul>
        </div>

        <div class="flex space-x-[15px] md:mr-2 mr-0 pr-2 items-center" x-data="{ show: true }">
            <div class="h-[20px] w-[20px]">
            <a @click="show = !show; $nextTick(() => $refs.inputsearh.focus())"
                class="dark:hover:text-corp-50 absolute cursor-pointer z-50">
                <x-icons.search class="h-[20px] w-[20px] fill-gris-10"  />
            </a>
            <div :class="{'md:w-[265px] w-[200px] @auth w-[190px] @endauth' : !show, 'w-0': show}" class="absolute @guest right-[80px] md:right-[187px]
                @else right-[93px] md:right-[200px]
            @endguest  top-[7px] md:top-[27px] duration-500 ease-out ">

                <input @blur="show = true" x-transition:leave-end="opacity-0 scale-90"  x-ref="inputsearh" type="text" :class="{'p-2  pr-[30px]' : !show, 'p-0 border-none': show}"
                    class="text-gris-10 bg-black h-[30px]  text-[12px]  rounded-[3px] focus:ring-gris-50 focus:border-gris-50 block w-full"
                    placeholder="Buscar" required="" x-cloak>
            </div>
             </div>

            <a class=" md:flex hidden items-center relative">
                <x-icons.heart class="h-[20px] w-[20px] fill-gris-10 hover:fill-corp-50"  />
                <x-elements.notification-icon number="1"/>

                <a class="md:flex hidden items-center relative">
                    <x-icons.cart class="h-[20px] w-[20px] fill-gris-10 hover:fill-corp-50"  />
                    <x-elements.notification-icon number="7"/>
                </a>


                @include('layouts.login')
                {{--  flag  --}}
                <div class="relative" x-data="{ isOpen: false, src: '{{ asset('image/flags/Bandera-PE.png') }}', alt:'Peru', lang:'ES' }">
                    <button @click="isOpen = !isOpen" @keydown.escape="isOpen = false"
                        class="flex items-center bg-gris-90 p-1 rounded-[3px] md:w-[57px]">
                        <img :src="src" src="{{ asset('image/flags/Bandera-PE.png') }}":alt="alt" alt="Peru"
                            class="md:w-[32px] w-[20px] h-[12px] md:h-[20.61px]">
                        <x-icons.chevron_down x-show="isOpen === false" fill="#A4A4A4" grosor="1px" class="w-[10px] h-[7px] ml-[5.5px] hidden md:block" />
                        <p x-show="isOpen === true" class="text-gris-10 text-[10px] ml-auto hidden md:block " x-text="lang"  />
                    </button>
                    <ul x-show="isOpen" x-cloak x-collapse @click.away="isOpen = false" :class="isOpen ? 'rounded-t-none' : 'rounded-t-none'"
                        class="absolute font-normal bg-gris-90 shadow overflow-hidden md:w-[57px] right-0 md:top-[25.5px] top-[16.5px] z-20 rounded pb-[6px] w-[28px]" >
                        <li x-show="alt !== 'Peru'" @click="src = '{{ asset('image/flags/Bandera-PE.png') }}',isOpen = false, alt = 'Peru',lang='ES'"
                        class="flex">
                            <img src="{{ asset('image/flags/Bandera-PE.png') }}" alt="Mexico" srcset=""
                                class="md:w-[32px] w-[20px] h-[12px] md:h-[20.61px] cursor-pointer ml-[4px] mt-[8px]">
                                <p class="text-gris-10 text-[10px] mx-auto mt-[10px] hidden md:block">ES</p>
                        </li>
                        <li x-show="alt !== 'Mexico'" @click="src = '{{ asset('image/flags/Bandera-MX.png') }}',isOpen = false, alt = 'Mexico',lang='ES'"
                        class="flex">
                            <img src="{{ asset('image/flags/Bandera-MX.png') }}" alt="Mexico" srcset=""
                                class="md:w-[32px] w-[20px] h-[12px] md:h-[20.61px] cursor-pointer ml-[4px] mt-[8px] ">
                                <p class="text-gris-10 text-[10px] mx-auto mt-[10px] hidden md:block">ES</p>
                        </li>
                        <li x-show="alt !== 'USA'" @click="src = '{{ asset('image/flags/Bandera-US.png') }}',isOpen = false, alt = 'USA', lang='EN'"
                        class="flex">
                            <img src="{{ asset('image/flags/Bandera-US.png') }}" alt="USA" srcset=""
                                class="md:w-[32px] w-[20px] h-[12px] md:h-[20.61px] cursor-pointer ml-[4px] mt-[8px] ">
                                <p class="text-gris-10 text-[10px] mx-auto mt-[10px] hidden md:block">EN</p>
                        </li>

                    </ul>
                </div>
                {{--  fin de flags  --}}
        </div>
        {{-- Menu Responsive --}}
        <div class="absolute  top-[44px] "
           ">
            <ul class="bg-gris-90 md:hidden transition-all duration-300 ease-in-out w-0 h-screen"
                :class="{ 'w-0': open === false, 'w-full': open === true }">


                <li class="mr-6 p-2">
                    <a class="text-gris-10 hover:text-red-600 text-[12px]" x-show="open" x-cloak
                        x-transition.duration.300ms href="#">INICIO</a>
                </li>
                <li class="mr-6 p-2">
                    <a class="text-gris-10 hover:text-red-600 text-[12px]" x-show="open" x-cloak href="#"
                        x-transition.duration.300ms>TIENDA</a>
                </li>
                <li class="mr-6 p-2">
                    <a class="text-gris-10 hover:text-red-600 text-[12px]" x-show="open" x-cloak href="#"
                        x-transition.duration.300ms>CONTACTO</a>
                </li>
            </ul>
        </div>
        {{-- fin --}}
    </div>


</header>
@push('scripts')
    <script>
        function afterEnterTransition() {
            console.log('La transición ha terminado');
            // Aquí puedes llamar a tu función o realizar otras operaciones después de la transición
        }

        Alpine.data('afterEnterTransition', afterEnterTransition);
    </script>
@endpush
