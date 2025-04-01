<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta property="og:url" content="https://www.lodomens.com">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Lodo Mens | Joyería Masculina que Redefine el Lujo">
    <meta property="og:description" content="Piezas únicas para el hombre que no teme al brillo ni al color. Diseños artesanales, materiales sofisticados y envíos a todo el mundo.">
    <meta property="og:image" content="{{ asset('image/lodomens/Favicon_LodoMens.ico') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name_web') }}</title>

    <!-- Fonts -->
    <link rel="icon" href="{{ asset('image/lodomens/Favicon_LodoMens.ico') }}"  type="image/x-icon">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Styles -->

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Scripts -->
    @yield('styles')
    @stack('styles')
    @stack('head')
    @vite(['resources/css/web/app.css', 'resources/js/app.js'])
    @livewireStyles

</head>

<body class="font-sans antialiased bg-black" x-data="{show_backToTop: false}"
@scroll.window="show_backToTop = window.pageYOffset > 30">
<x-web.modal.alert-stock :outstock="$outstock ?? ''" :zerostock="$zerostock ?? ''"/>
@include('layouts.header')

    <div class="min-h-screen mobile-height ">

        <div class="overflow-hidden shadow-xl">

            <div class="flex min-h-screen">

                <div
                    class="flex-1 flex flex-col">

                    <main class="flex-1 mt-54">
                        <div class="flex">

                        </div>

                        <div class=" mx-auto" >
                            {{--  contenido principal  --}}

                            <div class=" md:mt-[81px] mt-[44px]">
                                @yield('breadcrumb')
                                    @yield('main')
                                <div class="container text-gris-10 mx-auto px-[5px] md:px-[20px] relative md:pt-[81px] pt-[28px]" >

                                    {{--  <x-lodomens.video/>  --}}
                                        @php
                                        if(!isset($fondo) || $fondo !== false )
                                           { $fondo = true;}
                                        @endphp
                                        @if($fondo)
                                            <x-lodomens.background/>
                                         @endif
                                    @yield('content')
                                </div>

                            </div>


                            {{--  boton scroll-top     --}}
                            <button id="topButton"
                                        x-ref="backTotop"
                                        @click="window.scrollTo({top: 0, behavior: 'smooth'})"
                                        class="z-30 scrollTop fixed bottom-[6px] rounded-[3px] right-[6px] md:bottom-[9px] md:right-[9px] lg:bottom-[18px] lg:right-[20px] bg-corp-50 p-2 hidden"
                                >

                                <svg  xmlns="http://www.w3.org/2000/svg" class="h-[15px] w-[15px] rotate-180" fill="none" viewBox="0 0 24 24" stroke="white">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                                </button>
                        {{--  fin boton scroll-top     --}}

                        </div>


                    </main>
                           {{--   footer  --}}
                           <div class="relative z-30">
                            @include('layouts.footer')
                              </div>
                            {{--  fin  footer  --}}
                            <div x-data="{ mostrarBoton: false }" x-init="
                            window.addEventListener('scroll', () => {
                                const alturaTotalPagina = document.documentElement.scrollHeight;
                                const alturaVentana = window.innerHeight;
                                const posicionScroll = window.scrollY || document.documentElement.scrollTop;
                                const distanciaDesdeFinal = 100; // Ajusta este valor según la distancia desde el final

                                mostrarBoton = (posicionScroll + alturaVentana >= alturaTotalPagina - distanciaDesdeFinal);
                            });
                        " x-show="mostrarBoton" class="fixed z-50 bottom-0 ml-2 mb-2">
                            <a href="{{ route('reclamation.index') }}">
                                <svg class="fill-gris-30 hover:fill-gris-10 bg-transparent" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path d="M23 5v13.883l-1 .117v-16c-3.895.119-7.505.762-10.002 2.316-2.496-1.554-6.102-2.197-9.998-2.316v16l-1-.117v-13.883h-1v15h9.057c1.479 0 1.641 1 2.941 1 1.304 0 1.461-1 2.942-1h9.06v-15h-1zm-12 13.645c-1.946-.772-4.137-1.269-7-1.484v-12.051c2.352.197 4.996.675 7 1.922v11.613zm9-1.484c-2.863.215-5.054.712-7 1.484v-11.613c2.004-1.247 4.648-1.725 7-1.922v12.051z"/>
                                </svg>
                            </a>
                        </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    @yield('scripts')
    @stack('scripts')

    @stack('modals')
    @livewireScripts
    </div>

            <script>

                const topBtn = document.querySelector("#topButton");
                window.onscroll = () => {
                    if (window.pageYOffset > 50) {
                        // unhide
                        topBtn.classList.add("flex");
                        topBtn.classList.remove("hidden");
                    } else {
                        // hide
                        topBtn.classList.remove("flex");
                        topBtn.classList.add("hidden");
                    }
                }
            </script>
            <script>
                function stopPropagation(event) {
                  event.stopPropagation();
                }
            </script>



</body>

</html>
