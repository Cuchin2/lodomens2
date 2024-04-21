<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name_dashboard', 'Lodomens') }}</title>

    <!-- Fonts -->
    <link rel="icon" href="{{ asset('image/lodomens/Favicon_LodoMens2.ico') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Styles -->


    <!-- Scripts -->

    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
 {{--<script src="{{ asset('codemirror/lib/codemirror.js') }}" data-navigate-track></script>
    <script src="{{ asset('codemirror/mode/xml/xml.js') }}" data-navigate-track></script>  --}}
    @livewireStyles
    @vite(['resources/css/admin/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased dark:bg-gris-90">

    <x-banner2 />

    <div class="min-h-screen">

        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">

            <div class="flex bg-gray-300 min-h-screen" x-data="{ isSidebarExpanded: true, contract: true }">

                <aside
                    class="overflow-y-auto overflow-x-hidden simplebar-scrollable-y h-screen flex fixed flex-col text-gray-300 border-r dark:border-gris-70 bg-gris-90 transition-all duration-300 ease-in-out w-[200px]"
                    :class="{ sm:w-[52px] overflow-y-hidden': !isSidebarExpanded }"
                    @mouseenter="if (contract===false) isSidebarExpanded = true"
                    @mouseleave="if (contract===false) isSidebarExpanded = false">

                    <a href="#"
                        class="h-[54px] flex fixed z-10 w-inherit items-center dark:bg-gris-90 overflow-hidden dark:border-gris-70 border-r border-b">
                        {{-- <x-icons.logosSvg.Logo_imag_Def width="38px"></x-icons.logosSvg.Logo_imag_Def> --}}
                        <img src="{{ asset('image/lodomens/Logo_isotipo2.svg') }}" class="h-[23.48px] w-[33px] ml-[9px]">
                        <span class="font-medium duration-300 ease-in-out ml-[13.74px] mr-[13px]"
                            :class="isSidebarExpanded ? 'block' : 'hidden'">
                            <x-icons.logosSvg.Logo_horizontal_Def width="131px" />
                        </span>
                    </a>

                    <nav class=" {{-- space-y-2 --}} pt-20 w-[200px] text-15" x-data="{ openItem: null }">

                        @can('home')
                        <x-sidebar.ul-simple :active="request()->routeIs('dashboard')" href="{{ route('dashboard') }}">
                            <x-slot name="icon">
                                <x-icons.home-door class="h-[20px] w-[20px]" />
                            </x-slot> Dashboard
                        </x-sidebar.ul-simple>
                        @endcan
                        @can(['reports.day', 'reports.date', 'report.results'])
                        <x-sidebar.ul-drop name="Reportes" id="1">
                            <x-slot name="icon">
                                <x-icons.reportesBarra class="h-[20px] w-[20px]" />
                            </x-slot>
                            <x-sidebar.ul-drop-son>Reportes por día</x-sidebar.ul-drop-son>
                            <x-sidebar.ul-drop-son>Reportes por día</x-sidebar.ul-drop-son>
                            <x-sidebar.ul-drop-son>Reportes por día</x-sidebar.ul-drop-son>
                            <x-sidebar.ul-drop-son>Reportes por fecha</x-sidebar.ul-drop-son>


                        </x-sidebar.ul-drop>
                        @endcan
                        <x-sidebar.ul-drop name="Mi página" id="2">
                            <x-slot name="icon">
                                <x-icons.planet class="h-[20px] w-[20px]" />
                            </x-slot>
                            <x-sidebar.ul-drop-son>Header</x-sidebar.ul-drop-son>
                            <x-sidebar.ul-drop-son href="{{ route('mypage.edit') }}">Footer</x-sidebar.ul-drop-son>
                            <x-sidebar.ul-drop-son>Inicio</x-sidebar.ul-drop-son>
                            <x-sidebar.ul-drop-son>Tienda</x-sidebar.ul-drop-son>
                            <x-sidebar.ul-drop-son>Contacto</x-sidebar.ul-drop-son>

                        </x-sidebar.ul-drop>

                        @can('purchases.index')
                        <x-sidebar.ul-simple {{-- :active="request()->routeIs('home')" --}}
                            href="{{ route('dashboard') }}">
                            <x-slot name="icon">
                                <x-icons.cart-plus class="h-[20px] w-[20px]" />
                            </x-slot> Compras
                        </x-sidebar.ul-simple>
                        @endcan
                        @can('sales.index')
                        <x-sidebar.ul-simple {{-- :active="request()->routeIs('home')" --}}
                            href="{{ route('dashboard') }}">
                            <x-slot name="icon">
                                <x-icons.cart class="h-[20px] w-[20px]" />
                            </x-slot> Ventas
                        </x-sidebar.ul-simple>
                        @endcan
                        @can('orders.index')
                        <x-sidebar.ul-simple {{-- :active="request()->routeIs('home')" --}}
                            href="{{ route('dashboard') }}">
                            <x-slot name="icon">
                                <x-icons.pedidos class="h-[20px] w-[20px]" />
                            </x-slot> Pedidos
                        </x-sidebar.ul-simple>
                        @endcan
                        @can(['products.index', 'categories.index', 'tags.index', 'brands.index'])
                        <x-sidebar.ul-drop name="Inventario" id="3">
                            <x-slot name="icon">
                                <x-icons.inventario>
                                </x-icons.inventario>
                            </x-slot>
                            @can('products.index')
                            <x-sidebar.ul-drop-son href="{{ route('products.index') }}">Productos</x-sidebar.ul-drop-son>
                            <x-sidebar.ul-drop-son href="{{ route('types.index')}}">Productos Especiales</x-sidebar.ul-drop-son>
                            @endcan
                            @can('categories.index')
                            <x-sidebar.ul-drop-son href="{{ route('categories.index')}}">Categorias</x-sidebar.ul-drop-son>
                            @endcan
                            @can('brands.index')
                            <x-sidebar.ul-drop-son href="{{ route('brands.index')}}">Marcas</x-sidebar.ul-drop-son>
                            @endcan
                            <x-sidebar.ul-drop-son href="{{ route('tags.index')}}">Etiquetas
                            </x-sidebar.ul-drop-son>
                            <x-sidebar.ul-drop-son href="{{ route('colors.index')}}">Colores
                            </x-sidebar.ul-drop-son>
                        </x-sidebar.ul-drop>
                        @endcan

                        {{-- <x-sidebar.ul-simple href="{{ route('tags.index') }}"
                            :active="request()->routeIs('tags.*')">Etiquetas</x-sidebar.ul-simple> --}}

{{--                          <x-sidebar.ul-drop name="Blog" id="4">
                            <x-slot name="icon">
                                <x-icons.blog>
                                </x-icons.blog>
                            </x-slot>
                            <x-sidebar.ul-drop-son function="$dispatch('post-modal')">Añandir nuevo
                            </x-sidebar.ul-drop-son>
                            <x-sidebar.ul-drop-son href="{{ route('posts.index') }}">Publicaciones
                            </x-sidebar.ul-drop-son>
                            <x-sidebar.ul-drop-son href="{{ route('POST.categories') }}">Categorias
                            </x-sidebar.ul-drop-son>
                            @can('tags.index')
                            <x-sidebar.ul-drop-son href="{{ route('tags.indextype','POST')}}">Etiquetas
                            </x-sidebar.ul-drop-son>
                            @endcan
                        </x-sidebar.ul-drop>  --}}
                        @can(['products.index', 'categories.index', 'tags.index', 'brands.index'])
                        <x-sidebar.ul-drop name="eCommerce" id="5">
                            <x-slot name="icon">
                                <x-icons.eCommerce>
                                </x-icons.eCommerce>
                            </x-slot>
                            <x-sidebar.ul-drop-son>Redes sociales</x-sidebar.ul-drop-son>
                            <x-sidebar.ul-drop-son>Sliders</x-sidebar.ul-drop-son>
                            <x-sidebar.ul-drop-son>Suscriptores</x-sidebar.ul-drop-son>
                            <x-sidebar.ul-drop-son>Promociones</x-sidebar.ul-drop-son>
                        </x-sidebar.ul-drop>
                        @endcan

                        @can(['users.index', 'users.create', 'users.store', 'users.show', 'users.edit', 'users.update',
                        'users.destroy'])
                        <x-sidebar.ul-simple :active="request()->routeIs('users.*')" href="{{ route('users.index') }}">
                            <x-slot name="icon">
                                <x-icons.users class="h-[20px] w-[20px]" />
                            </x-slot> Usuarios
                        </x-sidebar.ul-simple>
                        @endcan
                        @can(['roles.index', 'roles.show'])
                        <x-sidebar.ul-simple href="{{ route('roles.index') }}" :active="request()->routeIs('roles.*')">
                            <x-slot name="icon">
                                <x-icons.roles class="h-[20px] w-[20px]" />
                            </x-slot> Roles
                        </x-sidebar.ul-simple>
                        @endcan

                    </nav>
                    <a href="#"
                        class="h-[36px] flex fixed z-10 bottom-0 w-inherit hover:bg-gris-70 border-t dark:bg-gris-90 items-center  dark:border-gris-70items-center overflow-hidden dark:border-gris-70 border-r border-b">

                        <img src="{{ asset('image/SVG/iconos/setting.svg') }}"
                            class="h-[20px] w-[20px] ml-[12px] ">
                        <span class="font-normal text-[15px] text-gris-20 duration-300 ease-in-out ml-[9px] mr-[13px]"
                            :class="isSidebarExpanded ? 'block' : 'hidden'">
                            Settings
                        </span>
                    </a>
                </aside>

                <div :class="{ 'ml-[52px]': !isSidebarExpanded }"
                    class="ml-[200px] flex-1 flex flex-col transition-all duration-300 ease-in-out dark:bg-gris-90">

                    @livewire('navigation-menu')

                    <main class="flex-1 px-6 pb-3 bg-gris-90 mt-54">
                        <div class="flex">
                            {{ $slot1 }}
                        </div>
                        <div class="py-4">
                            <div class=" mx-auto">
                                {{-- <livewire:create-post /> --}}
                                {{ $slot2 }}

                            </div>
                        </div>

                    </main>
                    <div class="text-[12px] dark:text-gris-20 flex mx-[24px] my-1">
                        <p class="mr-auto">Realizado por <a href="https://estudio.nubesita.com/" target="__blank" class="text-corp-50">Nubesita Estudio</a></p>
                        <p>Copyright © {{ now()->year }}. Todos los Derechos Reservados.</p>
                        <p class="ml-auto">Versión: <p class="text-corp-50 ml-1 ">0.1.0</p></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    </div>


    @stack('modals')

    @stack('scripts')

    @livewireScripts
</body>

</html>
