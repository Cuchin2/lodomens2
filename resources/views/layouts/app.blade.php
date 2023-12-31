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

    <script src="{{ asset('ckeditor/ckeditor.js') }}" data-navigate-track></script>
    <script src="{{ asset('codemirror/lib/codemirror.js') }}" data-navigate-track></script>
    <script src="{{ asset('codemirror/mode/xml/xml.js') }}" data-navigate-track></script>
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
                    :class="{ 'w-[52px] overflow-y-hidden': !isSidebarExpanded }"
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
                        <x-sidebar.ul-drop name="Inventario" id="2">
                            <x-slot name="icon">
                                <x-icons.inventario>
                                </x-icons.inventario>
                            </x-slot>
                            @can('products.index')
                            <x-sidebar.ul-drop-son>Productos</x-sidebar.ul-drop-son>
                            @endcan
                            @can('categories.index')
                            <x-sidebar.ul-drop-son>Categorias</x-sidebar.ul-drop-son>
                            @endcan
                            @can('brands.index')
                            <x-sidebar.ul-drop-son>Marcas</x-sidebar.ul-drop-son>
                            @endcan
                            <x-sidebar.ul-drop-son href="{{ route('tags.indextype','PRODUCT')}}">Etiquetas
                            </x-sidebar.ul-drop-son>
                        </x-sidebar.ul-drop>
                        @endcan

                        {{-- <x-sidebar.ul-simple href="{{ route('tags.index') }}"
                            :active="request()->routeIs('tags.*')">Etiquetas</x-sidebar.ul-simple> --}}

                        <x-sidebar.ul-drop name="Blog" id="3">
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
                        </x-sidebar.ul-drop>
                        @can(['products.index', 'categories.index', 'tags.index', 'brands.index'])
                        <x-sidebar.ul-drop name="eCommerce" id="4">
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
                        @can(['clients.index', 'clients.create', 'clients.store', 'clients.show', 'clients.edit',
                        'clients.update', 'clients.destroy'])
                        <x-sidebar.ul-simple {{-- :active="request()->routeIs('users.*')" --}}
                            href="{{ route('home') }}">
                            <x-slot name="icon">
                                <x-icons.clientes class="h-[20px] w-[20px]" />
                            </x-slot> Clientes
                        </x-sidebar.ul-simple>
                        @endcan
                        @can(['providers.index', 'providers.create', 'providers.store', 'providers.show',
                        'providers.edit', 'providers.update', 'providers.destroy'])
                        <x-sidebar.ul-simple {{-- :active="request()->routeIs('users.*')" --}}
                            href="{{ route('home') }}">
                            <x-slot name="icon">
                                <x-icons.provedores class="h-[20px] w-[20px]" />
                            </x-slot> Provedores
                        </x-sidebar.ul-simple>
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
                        <p>Copyright © 2023. Todos los Derechos Reservados.</p>
                        <p class="ml-auto">Versión: <p class="text-corp-50 ml-1 ">0.1.0</p></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    </div>
    <link rel="stylesheet" href="{{ asset('codemirror/lib/codemirror.css') }}" data-navigate-track>
    <link rel="stylesheet" href="{{ asset('codemirror/theme/xq-dark.css') }}" data-navigate-track>
    <style>
        [x-cloak] {
            display: none !important;
        }

        .mll-64 {
            margin-left: 16rem !important;
        }

        .mll-20 {
            margin-left: 4rem !important;
        }

        .wll-64 {
            width: 16rem !important;
        }

        .wll-20 {
            width: 4rem !important;
        }

        .rotate-0 {
            --tw-rotate: 0deg !important;
            transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y)) !important;
        }

        .filterit {
            filter: invert(12%) sepia(93%) saturate(3489%) hue-rotate(344deg) brightness(86%) contrast(103%);
        }
        .filterit:hover{
            filter: invert(11%) sepia(66%) saturate(3775%) hue-rotate(341deg) brightness(87%) contrast(105%);
        }
        .w-inherit {
            width: inherit;
        }

        body::-webkit-scrollbar,
        .simplebar-scrollable-y::-webkit-scrollbar {
            width: 3px;
            background: #202020;
        }


        body::-webkit-scrollbar-thumb,
        .simplebar-scrollable-y::-webkit-scrollbar-thumb {
            background: #393939;
            border-radius: 5px;
        }

        * {
            scrollbar-width: thin;
            scrollbar-color: #26334D #192132;
        }
        input:checked + label > span {
	border: 8px solid #990C1A;
	animation: bounce 250ms;
}

input:checked + label > span::before {
	content: '';
	position: absolute;
	top: 9px;
	left: 3px;
	border-right: 2px solid transparent;
	border-bottom: 2px solid transparent;
	transform: rotate(45deg);
	transform-origin: 0% 100%;
	animation: checked-box 125ms 250ms forwards;
}

@keyframes checked-box {
	0% {
		width: 0;
		height: 0;
		border-color: #212121;
		transform: translate(0,0) rotate(45deg);
	}
	33% {
		width: 4px;
		height: 0;
		border-color: #212121;
		transform: translate(0,0) rotate(45deg);
	}
	100% {
		width: 5px;
		height: 10px;
		border-color: #212121;
		transform: translate(0,-8px) rotate(45deg);
	}
}

@keyframes bounce {
	0% {
		transform: scale(1);
	}
	33% {
		transform: scale(.7);
	}
	100% {
		transform: scale(1);
	}
}
.pan {
    width: 16px;
	height: 16px;
	display: flex;
	justify-content: center;
	border: 1px solid #6C6C6C;
	margin-right: 15px;
	border-radius: 3px;
	transition: all .3s;
}
@keyframes checked-box {
	0% {
		width: 0;
		height: 0;
		border-color: #B5B5B5;
		transform: translate(0,0) rotate(45deg);
	}
	33% {
		width: 4px;
		height: 0;
		border-color: #B5B5B5;
		transform: translate(0,0) rotate(45deg);
	}
	100% {
		width: 5px;
		height: 9px;
		border-color: #B5B5B5;
		transform: translate(0,-8px) rotate(45deg);
	}
}

@keyframes bounce {
	0% {
		transform: scale(1);
	}
	33% {
		transform: scale(.7);
	}
	100% {
		transform: scale(1);
	}
}
    </style>
    @stack('modals')

    @stack('scripts')

    @livewireScripts
</body>

</html>
