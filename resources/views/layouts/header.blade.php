<header class="fixed w-full z-50" x-data="{ open: false }" >
    <div class="flex  items-center justify-between flex-wrap bg-black w-full  h-[44px] md:h-[84px]" @click="$dispatch('closelogin')">
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
            <ul class="md:flex text-gris-10 ">

                <x-menu-item  :active="request()->routeIs('root')" href="{{route('root')}}">INICIO</x-menu-item>
                <x-menu-item  :active="request()->routeIs('web.shop.*')" href="{{route('web.shop.index')}}">TIENDA</x-menu-item>
                <x-menu-item  :active="request()->routeIs('web.contact.*')" href="{{route('web.contact.index')}}">CONTACTO</x-menu-item>

            </ul>
        </div>

        <livewire:notification-icons cart="{{ Cart::instance('cart')->content()->count() }}" wishlist="{{ Cart::instance('wishlist')->content()->count() }}"/>
        {{-- Menu Responsive --}}
        <div class="absolute top-[44px] z-10 w-0" :class="{ 'w-0': open === false, 'w-1/3': open === true }"
           >
            <ul class="bg-gris-90 md:hidden transition-all duration-300 ease-in-out w-0 h-screen"
                :class="{ 'w-0 border-none border-transparent': open === false, 'w-full border-[1px] border-gris-80': open === true }">
                    <x-menu-item2  :active="request()->routeIs('root')" href="{{route('root')}}">INICIO</x-menu-item2>
                    <x-menu-item2  :active="request()->routeIs('web.shop.*')" href="{{route('web.shop.index')}}">TIENDA</x-menu-item2>
                    <x-menu-item2  :active="request()->routeIs('web.contact.*')" href="{{route('web.contact.index')}}">CONTACTO</x-menu-item2>
            </ul>
        </div>
        {{-- fin --}}
    </div>


</header>

</div>
