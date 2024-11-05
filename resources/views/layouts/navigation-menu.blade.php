<nav x-data="{ open: false,
search: '', src: '{{ Auth::user()->profile_photo_url }}',
show_item(el) {
    let searchText = this.search.toLowerCase();
    let elementText = el.textContent.toLowerCase();
    return searchText === '' || elementText.includes(searchText);
}
}"

class="bg-white dark:bg-gris-90 transition-all duration-300 ease-in-out fixed left-0 right-0 sm:ml-[208px] ml-[52px] z-50" :class="{'sm:!ml-[52px]': !isSidebarExpanded, '!ml-[200px]': isSidebarExpanded }"
<!-- Primary Navigation Menu -->
<div class="mx-auto px-4 sm:px-6 lg:px-8 bg-gris-90" >
    <div class="flex justify-between h-54">
        <div class="flex">
            <!-- Logo -->
            {{-- <div class="shrink-0 flex items-center">
                <a href="{{ route('dashboard') }}">
                    <x-application-mark class="block h-9 w-auto" />
                </a>
            </div> --}}
            <button class="p-2 -ml-2 mr-2  text-gray-100" @click="isSidebarExpanded = !isSidebarExpanded; contract=!contract">
                <svg viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 transform rotate-180" :class="{'rrotate-0': !isSidebarExpanded }">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                  <line x1="4" y1="6" x2="14" y2="6" />
                  <line x1="4" y1="18" x2="14" y2="18" />
                  <path d="M4 12h17l-3 -3m0 6l3 -3" />
                </svg>
              </button>
            <!-- Navigation Links -->
            <div class="relative sm:w-[260px] w-full mr-2 ml-auto">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <x-icons.search class="w-[14px] h-[14px] text-gris-40" />
                </div>
                <input

                type="search" x-model="search"
                class="bg-gris-100 border border-gris-80 mt-[11px] h-[30px] text-gris-40 text-[12px] rounded-[20px] focus:ring-gris-70 focus:border-gris-70 block w-full pl-10 p-2 "
                placeholder="Buscar" required="">
            </div>
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
               {{--  <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-nav-link> --}}

            </div>
        </div>

        <div class="hidden sm:flex sm:items-center sm:ml-6 ">


            <!-- Settings Dropdown -->
            <div class="ml-3 relative flex text-gray-300">
                <div class="flex items-center">
                    <a class="hover:text-corp-50 flex items-center relative">
                        <x-icons.bell class="h-5 mr-[15px]"></x-icons.bell>

                        <span class="absolute top-[-7px] right-[10px] flex h-3 w-3 items-center justify-center">
                            <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-rojo-30 opacity-80"></span>
                            <span class="inline-flex h-2 w-2 rounded-full bg-rojo-30"></span>
                          </span>
                    </a>

                <a  href="/"class="dark:hover:text-corp-50" target="_blank">
                <x-icons.planet class="h-5 mr-[15px]"></x-icons.planet> </a>

                 </div>
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">

                    </x-slot>

                    <x-slot name="content">
                        <!-- Account Management -->
                        <div class="block px-4 py-1 text-[14px] text-gris-30">
                            @php
                            $usuario=auth()->user();
                            @endphp
                            {{ $usuario->name }} {{ $usuario->last_name }}
                            {{--  {{ __('Manage Account') }}  --}}
                        </div>

                        <x-dropdown-link href="{{ route('profile.show') }}" wire:navigate >
                            {{ __('Profile') }}
                        </x-dropdown-link>


                        {{--  <div class="border-t border-gray-200 dark:border-gris-50"></div>  --}}

                        <!-- Authentication -->
                        <form  action="{{ route('logout') }}" method="POST" x-data>
                            @csrf

                            <x-dropdown-link href="{{ route('logout') }}"
                                     @click.prevent="$root.submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>

        <!-- Hamburger -->
        <div class="-mr-2 flex items-center sm:hidden">
            <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md  text-gray-500  hover:text-gray-400  hover:bg-gray-900 focus:outline-none  focus:bg-gray-900  focus:text-gray-400 transition duration-150 ease-in-out">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
</div>

<!-- Responsive Navigation Menu -->
<div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
    <div class="pt-2 pb-3 space-y-1">
        <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
            {{ __('Dashboard') }}
        </x-responsive-nav-link>
    </div>

    <!-- Responsive Settings Options -->
    <div class="pt-4 pb-1 border-t  border-gray-600">
        <div class="flex items-center px-4">


            <div>
                <div class="font-medium text-base  text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>
        </div>

        <div class="mt-3 space-y-1">
            <!-- Account Management -->
            <x-responsive-nav-link href="{{ route('profile.show') }}" wire:navigate :active="request()->routeIs('profile.show')">
                {{ __('Profile') }}
            </x-responsive-nav-link>



            <!-- Authentication -->
            <form  action="{{ route('logout') }}" method="POST" x-data>
                @csrf

                <x-responsive-nav-link href="{{ route('logout') }}"
                               @click.prevent="$root.submit();">
                    {{ __('Log Out') }}
                </x-responsive-nav-link>
            </form>


        </div>
    </div>
</div>
<style>
    @keyframes blink {
  0% {
    opacity: 1;
  }
  50% {
    opacity: 0.5;
  }
  100% {
    opacity: 1;
  }
}

.animate-ping {
    animation: ping 1s cubic-bezier(0,0,.2,1) infinite;
}

</style>
</nav>


