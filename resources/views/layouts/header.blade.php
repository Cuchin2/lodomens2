<header class="absolute w-full" x-data="{ open:false}">
    <div  class="flex items-center justify-between flex-wrap bg-gris-80  w-full lg:px-[50px] h-[44px] md:h-[84px]">
        <button @click="open = !open" @click.away="open = false" class="md:hidden p-2 mr-4 ml-2 my-2 ">
           <x-icons.hamburger class="h-[18.375px] w-[14px]" fill="#A4A4A4" grosor="2"/>
        </button>
    <div class="flex-shrink-0 lg:ml-6">
              <a href="../../">
                <x-lodomens.icons.logo_secundario class="md:h-[40px] h-[27px]"/>
              </a>
    </div>


   {{--   Menu normal  --}}
      <div class=" w-full md:w-auto mx-auto hidden md:block">
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

      <div class="flex space-x-[15px] mr-2 pr-2" x-data="{show:true}" >
            <a x-show="show"   @click="show = !show; $nextTick(() => $refs.inputsearh.focus())" class="dark:hover:text-corp-50 md:flex items-center relative hidden"

                >
                <x-icons.search class="h-[20px] w-[20px]" fill="white"/>
            </a>

            <div x-show="!show" x-cloak class="relative w-[260px] ml-auto"
            x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-100"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90"
            >
                <div class="absolute inset-y-1 left-0 flex items-center pl-3 pointer-events-none">
                    <x-icons.search class="w-[14px] h-[14px] text-gris-300 dark:text-gris-40" />

                </div>
                <input @blur="show = true" x-transition:leave-end="opacity-0 scale-90"
                x-ref="inputsearh"
                type="text"
                class="dark:bg-black  border-none h-[30px] dark:text-gris-40 text-[12px] rounded-[20px] focus:ring-gris-50 focus:border-gris-50 block w-full pl-10 p-2"
                placeholder="Buscar" required="">
            </div>
            <a class="dark:hover:text-corp-50 md:flex hidden items-center relative">
            <x-icons.heart class="h-[20px] w-[20px]" fill="white"/>
            <span class="absolute top-[-0.5px] right-[-6px] flex h-3 w-3 items-center justify-center">
                <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-rojo-30 opacity-80"></span>
                <span class="inline-flex h-2 w-2 rounded-full bg-rojo-30"></span>
              </span>

             <a class="dark:hover:text-corp-50 md:flex hidden items-center relative">
            <x-icons.cart class="h-[20px] w-[20px]" fill="white"/> </a>

            @if(auth()->user())

            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())

                           {{--  <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div> --}}
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">


                                    <img class="h-8 w-8 rounded-full object-cover" src="{{Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
            @else
            <span class="inline-flex rounded-md">
                <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
                    {{ Auth::user()->name }}

                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>
            </span>
        @endif
        @else
            <a class="dark:hover:text-corp-50 flex items-center relative"> <x-icons.user class="h-[20px] w-[20px]" fill="white"/> </a>
        @endif

    </div>
            {{--  Menu Responsive  --}}
            <div class="absolute  top-[44px]
           "  >
                <ul class=" bg-blue-800  md:hidden transition-all duration-300 ease-in-out w-0" :class="{ 'w-0': open === false, 'w-[200px]':open === true}">


            <li class="mr-6 p-1">
            <a class="text-white hover:text-red-600 " x-show="open" x-cloak x-transition.duration.500ms
            href="#">INICIO</a>
            </li>
            <li class="mr-6 p-1">
            <a class="text-white hover:text-red-600 " x-show="open" x-cloak href="#" x-transition.duration.500ms>TIENDA</a>
            </li>
            <li class="mr-6 p-1">
            <a class="text-white hover:text-red-600 " x-show="open" x-cloak href="#" x-transition.duration.500ms>CONTACTO</a>
            </li>
                </ul>
            </div>
            {{--  fin  --}}
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
