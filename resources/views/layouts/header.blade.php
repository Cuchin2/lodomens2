<header class="absolute w-full" x-data="{ open:false}">
    <div class="flex items-center justify-between flex-wrap bg-black w-full  h-[44px] md:h-[84px]">
        <button @click="open = !open" @click.away="open = false" class="md:hidden mr-4 ml-2 my-2 ">
            <x-icons.hamburger class="h-[22.231px] w-[16.94px]" fill="#A4A4A4" grosor="2" />
        </button>
        <div class="absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2 md:relative md:flex md:top-1/4 md:left-[70px]">
            <a href="../../">
                <x-lodomens.icons.logo_secundario class="md:h-[40px] h-[27px]" />
            </a>
        </div>


        {{-- Menu normal --}}
        <div class=" w-full md:w-auto mx-auto hidden md:block md:absolute md:left-1/2 md:top-1/2 md:transform md:-translate-x-1/2 md:-translate-y-1/2">
            <ul class="md:flex">


                <li class="mr-6 p-1">
                    <a class="text-white hover:text-red-600" href="#">INICIO</a>
                </li>
                <li class="mr-6 p-1">
                    <a class="text-white hover:text-red-600" href="#">TIENDA</a>
                </li>
                <li class="mr-6 p-1">
                    <a class="text-white hover:text-red-600" href="#">CONTACTO</a>
                </li>
            </ul>
        </div>

        <div class="flex space-x-[15px] mr-2 pr-2" x-data="{show:true}">
            <a x-show="show" @click="show = !show; $nextTick(() => $refs.inputsearh.focus())"
                class="dark:hover:text-corp-50 md:flex items-center relative hidden cursor-pointer">
                <x-icons.search class="h-[20px] w-[20px]" fill="white" />
            </a>

            <div x-show="!show" x-cloak class="relative w-[200px] ml-auto"
                x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 scale-90"
                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-100"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
                <div class="absolute inset-y-1 left-0 flex items-center pl-3 pointer-events-none">
                    <x-icons.search class="w-[14px] h-[14px] text-gris-300 dark:text-gris-40" />

                </div>
                <input @blur="show = true" x-transition:leave-end="opacity-0 scale-90" x-ref="inputsearh" type="text"
                    class="dark:bg-black  border-none h-[30px] dark:text-gris-40 text-[12px] rounded-[20px] focus:ring-gris-50 focus:border-gris-50 block w-full pl-10 p-2"
                    placeholder="Buscar" required="">
            </div>
            <a class="dark:hover:text-corp-50 md:flex hidden items-center relative">
                <x-icons.heart class="h-[20px] w-[20px]" fill="white" />
                <span class="absolute top-[-0.5px] right-[-6px] flex h-3 w-3 items-center justify-center">
                    <span
                        class="absolute inline-flex h-full w-full animate-ping rounded-full bg-rojo-30 opacity-80"></span>
                    <span class="inline-flex h-2 w-2 rounded-full bg-rojo-30"></span>
                </span>

                <a class="dark:hover:text-corp-50 md:flex hidden items-center relative">
                    <x-icons.cart class="h-[20px] w-[20px]" fill="white" />
                </a>

                @if(auth()->user())

                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())

                {{-- <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                --}}
                <button
                    class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">


                    <img class="h-8 w-8 rounded-full object-cover" src="{{Auth::user()->profile_photo_url }}"
                        alt="{{ Auth::user()->name }}" />
                </button>
                @else
                <span class="inline-flex rounded-md">
                    <button type="button"
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
                        {{ Auth::user()->name }}

                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>
                </span>
                @endif
                @else
                <a class="dark:hover:text-corp-50 flex items-center relative">
                    <x-icons.user class="h-[20px] w-[20px]" fill="white" />
                </a>
                @endif
                {{--  flag  --}}
                <div class="relative" x-data="{ isOpen: false, src: '{{ asset('image/flags/Bandera-PE.png') }}' }">
                    <button
                            @click="isOpen = !isOpen"
                            @keydown.escape="isOpen = false"
                            class="flex items-center bg-gris-90 p-1 rounded w-[57px]"
                    >
                        <img :src="src" src="{{ asset('image/flags/Bandera-PE.png') }}" alt="Peru" class="w-[32px] h-[20.61px] ">
                        <svg fill="#cacaca" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path d="M15.3 9.3a1 1 0 0 1 1.4 1.4l-4 4a1 1 0 0 1-1.4 0l-4-4a1 1 0 0 1 1.4-1.4l3.3 3.29 3.3-3.3z" class="heroicon-ui"></path></svg>
                    </button>
                    <ul x-show="isOpen" x-cloak x-collapse
                        @click.away="isOpen = false"
                        class="absolute font-normal bg-gris-90 shadow overflow-hidden rounded w-fit right-0 z-20"
                    >
                    <li @click="src = '{{ asset('image/flags/Bandera-PE.png') }}',isOpen = false">
                        <img src="{{ asset('image/flags/Bandera-PE.png') }}" alt="Mexico" srcset="" class="w-[32px] h-[20.61px] cursor-pointer m-1" >
                     </li>
                        <li @click="src = '{{ asset('image/flags/Bandera-MX.png') }}',isOpen = false">
                           <img src="{{ asset('image/flags/Bandera-MX.png') }}" alt="Mexico" srcset="" class="w-[32px] h-[20.61px] cursor-pointer m-1" >
                        </li>
                        <li @click="src = '{{ asset('image/flags/Bandera-US.png') }}',isOpen = false">
                            <img src="{{ asset('image/flags/Bandera-US.png') }}" alt="Mexico" srcset="" class="w-[32px] h-[20.61px] cursor-pointer m-1" >
                         </li>

                    </ul>
                </div>
                {{--  fin de flags  --}}
        </div>
        {{-- Menu Responsive --}}
        <div class="absolute  top-[44px] w-[140px]
           ">
            <ul class="bg-gris-90 md:hidden transition-all duration-300 ease-in-out w-0 h-screen"
                :class="{ 'w-0': open === false, 'w-full':open === true}">


                <li class="mr-6 p-2">
                    <a class="text-white hover:text-red-600 text-[12px]" x-show="open" x-cloak
                        x-transition.duration.300ms href="#">INICIO</a>
                </li>
                <li class="mr-6 p-2">
                    <a class="text-white hover:text-red-600 text-[12px]" x-show="open" x-cloak href="#"
                        x-transition.duration.300ms>TIENDA</a>
                </li>
                <li class="mr-6 p-2">
                    <a class="text-white hover:text-red-600 text-[12px]" x-show="open" x-cloak href="#"
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
