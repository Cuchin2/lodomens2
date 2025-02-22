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

    @vite(['resources/css/admin/app.css', 'resources/js/app.js'])
    <!-- Scripts -->

    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
 {{--<script src="{{ asset('codemirror/lib/codemirror.js') }}" data-navigate-track></script>
    <script src="{{ asset('codemirror/mode/xml/xml.js') }}" data-navigate-track></script>  --}}
    @livewireStyles
    @stack('styles')
</head>
<body class="font-sans antialiased bg-gris-90">
    <x-banner2 />

    <div class="min-h-screen">

        <div class=" bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">

            <div class="flex bg-gray-300 min-h-screen" x-data="{ isSidebarExpanded: false, contract: true,
                setSidebar() {
                    this.isSidebarExpanded = window.innerWidth > 640;
                }
            }" x-on:resize.window="setSidebar()" x-init="setSidebar()" >

                <aside
                    class="overflow-y-auto overflow-x-hidden simplebar-scrollable-y h-0 flex fixed z-10 flex-col text-gray-300 border-r border-gris-70 bg-gris-90 transition-all duration-300 ease-in-out sm:w-[200px] w-52 sm:h-full"
                    :class="{ 'sm:!w-[52px] w-0 overflow-y-hidden h-0': !isSidebarExpanded ,'h-full' : isSidebarExpanded }"
                    @mouseenter="if (contract===false) isSidebarExpanded = true"
                    @mouseleave="if (contract===false) isSidebarExpanded = false">

                    <a href="#"
                        class="h-[54px] flex fixed z-10 w-inherit items-center dark:bg-gris-90 overflow-hidden border-gris-70 border-r sm:border-b" :class="{'dark:border-none' : !isSidebarExpanded}">
                        {{-- <x-icons.logosSvg.Logo_imag_Def width="38px"></x-icons.logosSvg.Logo_imag_Def> --}}
                        <img src="{{ asset('image/lodomens/Logo_isotipo2.svg') }}" class="h-[23.48px] w-[33px] ml-[9px]">
                        <span class="font-medium duration-300 ease-in-out ml-[13.74px] mr-[13px]"
                            :class="isSidebarExpanded ? 'block' : 'hidden'">
                            <x-icons.logosSvg.Logo_horizontal_Def width="131px" />
                        </span>
                    </a>

                    <nav class=" {{-- space-y-2 --}} pt-20 w-[200px] text-15 h-full" x-data="{ openItem: null }">
                        <div class="flex flex-col justify-between h-full">
                            <div>
                        @can('home')
                        <x-sidebar.ul-simple :active="request()->routeIs('dashboard')" href="{{ route('dashboard') }}">
                            <x-slot name="icon">
                                <x-icons.home-door class="h-[20px] w-[20px]" />
                            </x-slot> Dashboard
                        </x-sidebar.ul-simple>
                        @endcan
{{--                          @can(['reports.day', 'reports.date', 'report.results'])
                        <x-sidebar.ul-drop name="Reportes" id="1">
                            <x-slot name="icon">
                                <x-icons.reportesBarra class="h-[20px] w-[20px]" />
                            </x-slot>
                            <x-sidebar.ul-drop-son>Reportes por día</x-sidebar.ul-drop-son>
                            <x-sidebar.ul-drop-son>Reportes por día</x-sidebar.ul-drop-son>
                            <x-sidebar.ul-drop-son>Reportes por día</x-sidebar.ul-drop-son>
                            <x-sidebar.ul-drop-son>Reportes por fecha</x-sidebar.ul-drop-son>


                        </x-sidebar.ul-drop>
                        @endcan  --}}
                        @role(['Admin','Gerencia'])
                        <x-sidebar.ul-drop name="Mi página" id="2" :active="request()->routeIs('mypage.*')">
                            <x-slot name="icon">
                                <x-icons.planet class="h-[20px] w-[20px]" />
                            </x-slot>
                            <x-sidebar.ul-drop-son href="{{ route('mypage.main') }}" :active2="request()->routeIs('mypage.main')">Inicio</x-sidebar.ul-drop-son>
                            <x-sidebar.ul-drop-son>Tienda</x-sidebar.ul-drop-son>
                            <x-sidebar.ul-drop-son href="{{ route('mypage.contact.index') }}" :active2="request()->routeIs('mypage.contact.*')">Contacto</x-sidebar.ul-drop-son>
                            <x-sidebar.ul-drop-son>Header</x-sidebar.ul-drop-son>
                            <x-sidebar.ul-drop-son href="{{ route('mypage.edit') }}" :active2="request()->routeIs('mypage.edit')">Footer</x-sidebar.ul-drop-son>
                            <x-sidebar.ul-drop-son href="{{ route('mypage.shipping') }}" :active2="request()->routeIs('mypage.shipping')">Envios</x-sidebar.ul-drop-son>

                        </x-sidebar.ul-drop>
                        @endrole
{{--                          @can('purchases.index')
                        <x-sidebar.ul-simple :active="request()->routeIs('home')"
                            href="{{ route('dashboard') }}">
                            <x-slot name="icon">
                                <x-icons.cart-plus class="h-[20px] w-[20px]" />
                            </x-slot> Compras
                        </x-sidebar.ul-simple>
                        @endcan  --}}
                        @can('sales.index')
                        <x-sidebar.ul-simple :active="request()->routeIs('sale.index')"
                            href="{{ route('sale.index') }}">
                            <x-slot name="icon">
                                <x-icons.cart class="h-[20px] w-[20px]" />
                            </x-slot> Ventas
                        </x-sidebar.ul-simple>
                        @endcan
{{--                          @can('orders.index')
                        <x-sidebar.ul-simple :active="request()->routeIs('home')"
                            href="{{ route('dashboard') }}">
                            <x-slot name="icon">
                                <x-icons.pedidos class="h-[20px] w-[20px]" />
                            </x-slot> Pedidos
                        </x-sidebar.ul-simple>
                        @endcan  --}}
                        @can(['products.index', 'categories.index', 'tags.index', 'brands.index'])
                        <x-sidebar.ul-drop name="Inventario" id="3" :active="request()->routeIs('inventory.*')">
                            <x-slot name="icon">
                                <x-icons.inventario />
                            </x-slot>
                            @can('products.index')
                            <x-sidebar.ul-drop-son href="{{ route('inventory.products.index') }}" :active2="request()->routeIs('inventory.products.*')">Productos</x-sidebar.ul-drop-son>
                            <x-sidebar.ul-drop-son href="{{ route('inventory.types.index')}}" :active2="request()->routeIs('inventory.types.index')">Especiales</x-sidebar.ul-drop-son>
                            @endcan
                            @can('categories.index')
                            <x-sidebar.ul-drop-son href="{{ route('inventory.categories.index')}}" :active2="request()->routeIs('inventory.categories.index')">Categorias</x-sidebar.ul-drop-son>
                            @endcan
                            @can('brands.index')
                            <x-sidebar.ul-drop-son href="{{ route('inventory.brands.index')}}" :active2="request()->routeIs('inventory.brands.index')">Marcas</x-sidebar.ul-drop-son>
                            @endcan
                            <x-sidebar.ul-drop-son href="{{ route('inventory.materials.index')}}" :active2="request()->routeIs('inventory.materials.index')">Materiales
                            </x-sidebar.ul-drop-son>
                            <x-sidebar.ul-drop-son href="{{ route('inventory.tags.index')}}" :active2="request()->routeIs('inventory.tags.index')">Etiquetas
                            </x-sidebar.ul-drop-son>
                            <x-sidebar.ul-drop-son href="{{ route('inventory.colors.index')}}" :active2="request()->routeIs('inventory.colors.index')">Colores
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
{{--                          @can(['products.index', 'categories.index', 'tags.index', 'brands.index'])
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
                        @endcan  --}}

                        @can(['users.index', 'users.create', 'users.store', 'users.show', 'users.edit', 'users.update',
                        'users.destroy'])
                        <x-sidebar.ul-simple :active="request()->routeIs('users.*')" href="{{ route('users.index') }}">
                            <x-slot name="icon">
                                <x-icons.users class="h-[20px] w-[20px]" />
                            </x-slot> Usuarios
                        </x-sidebar.ul-simple>
                        @endcan
                        @role('Admin') {{--  @can(['roles.index', 'roles.show'])  --}}
                        <x-sidebar.ul-simple href="{{ route('roles.index') }}" :active="request()->routeIs('roles.*')">
                            <x-slot name="icon">
                                <x-icons.roles class="h-[20px] w-[20px]" />
                            </x-slot> Roles
                        </x-sidebar.ul-simple>
                        @endrole
                        {{--  @endcan  --}}
                    </div>
                    <div class="">
                        <x-sidebar.ul-simple href="{{ route('dashboard') }}" class="border-gris-70 border-t">
                            <x-slot name="icon">
                                <x-icons.setting class="h-[20px] w-[20px]" />
                            </x-slot> Setting
                        </x-sidebar.ul-simple>
                    </div>
                    </div>
                    </nav>

                </aside>

                <div :class="{ 'sm:!ml-[52px]': !isSidebarExpanded }"
                    class="sm:ml-[200px] ml-0 flex-1 flex flex-col transition-all duration-300 ease-in-out bg-gris-90">

                    @livewire('navigation-menu')

                    <main class="flex-1  sm:px-6 px-3 pb-3 bg-gris-90 mt-54 w-screen sm:w-full">
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
                    <div class="text-[12px] text-gris-20 flex mx-[24px] my-1">
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
