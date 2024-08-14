<div class="md:flex items-center relative space-x-[15px]">
    <div class="flex space-x-[15px] md:mr-2 mr-0 pr-2 items-center" x-data="{ show: true }">
        <div class="h-[20px] w-[20px]">
        <a @click="show = !show; $nextTick(() => $refs.inputsearh.focus())"
            class="dark:hover:text-corp-50 absolute cursor-pointer z-50">
            <x-icons.search class="h-[20px] w-[20px] fill-gris-10"  />
        </a>
        <div :class="{'md:w-[265px] w-[200px] @auth w-[190px] @endauth' : !show, 'w-0': show}" class="absolute @guest right-[70px] md:right-[150px] top-[-6px]
            @else right-[82px] md:right-[160px] top-[1px]
        @endguest   duration-500 ease-out ">

            <input @blur="show = true" x-transition:leave-end="opacity-0 scale-90"  x-ref="inputsearh" type="text" :class="{'p-2  pr-[30px]' : !show, 'p-0 border-none': show}"
                class="text-gris-10 bg-black h-[30px]  text-[12px]  rounded-[3px] focus:ring-gris-50 focus:border-gris-50 block w-full"
                placeholder="Buscar" required="" x-cloak>
        </div>
         </div>

        <a @auth href="{{ route('web.shop.webdashboard.wishlist') }}" @endauth  class=" md:flex hidden items-center relative">
            <x-icons.heart class="h-[20px] w-[20px] fill-gris-10 hover:fill-corp-50 cursor-pointer"  />
            <x-elements.notification-icon number="{{ $wishlist }}" class="{{ $wishlist == 0 ? 'hidden' : '' }}"/>
        </a>
         <a href="{{ route('web.shop.cart.index') }}"  class="md:flex hidden items-center relative">
                <x-icons.cart class="h-[20px] w-[20px] fill-gris-10 hover:fill-corp-50 cursor-pointer"  />
                <x-elements.notification-icon number="{{ $cart }}" class="{{ $cart == 0 ? 'hidden' : '' }}"/>
        </a>


            @include('layouts.login')
            {{--  flag  --}}
{{--              <div class="relative" x-data="{ isOpen: false, src: '{{ asset('image/flags/Bandera-PE.png') }}', alt:'Peru', lang:'ES' }">
                <button @click="isOpen = !isOpen" @keydown.escape="isOpen = false"
                    class="flex items-center bg-gris-90 p-1 rounded-[3px] md:w-[57px]">
                    <img :src="src" src="{{ asset('image/flags/Bandera-PE.png') }}":alt="alt" alt="Peru"
                        class="md:w-[32px] w-[20px] h-[12px] md:h-[20.61px]">
                    <x-icons.chevron-down x-show="isOpen === false" fill="#A4A4A4" grosor="1px" class="w-[10px] h-[7px] ml-[5.5px] hidden md:block" />
                    <p x-show="isOpen === true" class="text-gris-10 text-[10px] ml-auto hidden md:block " x-text="lang"  />
                </button>
                <ul x-show="isOpen" x-cloak x-collapse @click.away="isOpen = false" :class="isOpen ? 'rounded-t-none' : 'rounded-t-none'"
                    class="absolute font-normal bg-gris-90 shadow overflow-hidden md:w-[57px] right-0 md:top-[25.5px] top-[16.5px] z-20 rounded pb-[6px] w-[28px]" >
                    <li x-show="alt !== 'Peru'" @click="src = '{{ asset('image/flags/Bandera-PE.png') }}',isOpen = false, alt = 'Peru',lang='ES'"
                    class="flex">
                        <img src="{{ asset('image/flags/Bandera-PE.png') }}" alt="Peru" srcset=""
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
            </div>  --}}
            {{--  fin de flags  --}}
    </div>
</div>
