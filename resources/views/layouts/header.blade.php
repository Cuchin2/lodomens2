<header class="absolute w-full h-[84px]">
    <div  class="flex items-center justify-between flex-wrap bg-gris-80 py-4 w-full lg:px-[50px]">
    <div class="flex-shrink-0 ml-6">
              <a href="#">
      <i class="fas fa-drafting-compass fa-2x text-yellow-500"></i>
      <span class="ml-1 text-3xl text-gris-20 font-semibold">LodoMens</span>
              </a>
    </div>



      <div class=" w-full md:w-auto hidden md:block mx-auto" id="nav-content">
          <ul class="md:flex">
{{--        <li class="mr-6 p-1 md:border-b-2 border-yellow-500">
        <a class="text-blue-200 cursor-default" href="#">Home</a>
      </li>  --}}

      <li class="mr-6 p-1">
        <a class="text-white hover:text-red-600" href="#">Inicio</a>
      </li>
      <li class="mr-6 p-1">
        <a class="text-white hover:text-red-600" href="#">Tienda</a>
      </li>
      <li class="mr-6 p-1">
        <a class="text-white hover:text-red-600" href="#">Contacto</a>
      </li>
          </ul>
      </div>

      <div class="flex space-x-[15px]" x-data="{show:true}" >
            <a x-show="show"   @click="show = !show; $nextTick(() => $refs.inputsearh.focus())" class="dark:hover:text-corp-50 flex items-center relative"

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
            <a class="dark:hover:text-corp-50 flex items-center relative">
            <x-icons.heart class="h-[20px] w-[20px]" fill="white"/>
            <span class="absolute top-[-7px] right-[-6px] flex h-3 w-3 items-center justify-center">
                <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-rojo-30 opacity-80"></span>
                <span class="inline-flex h-2 w-2 rounded-full bg-rojo-30"></span>
              </span>

             <a class="dark:hover:text-corp-50 flex items-center relative">
            <x-icons.cart class="h-[20px] w-[20px]" fill="white"/> </a>
            @if(auth()->user())


            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())

                           {{--  <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div> --}}
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">


                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
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
        <button id="nav-toggle" class="md:hidden p-2 mr-4 ml-6 my-2 border rounded border-gray-600 text-blue-200 hover:border-blue-200">
            <i class="fas fa-bars fa-2x"></i>
                </button>
    </div>
    </div>


  </header>
@push('scripts')
    <script>
        document.getElementById('nav-toggle').onclick = function(){
            document.getElementById("nav-content").classList.toggle("hidden");
          }
          function afterEnterTransition() {
            console.log('La transición ha terminado');
            // Aquí puedes llamar a tu función o realizar otras operaciones después de la transición
        }

        Alpine.data('afterEnterTransition', afterEnterTransition);
    </script>
@endpush
