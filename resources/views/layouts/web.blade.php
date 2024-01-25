<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
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


    @livewireStyles
    @vite(['resources/css/web/app.css', 'resources/js/app.js'])

</head>

<body class="font-sans antialiased bg-black" x-data="{show_backToTop: false}"
@scroll.window="show_backToTop = window.pageYOffset > 30">

@include('layouts.header')

    <div class="min-h-screen">

        <div class="overflow-hidden shadow-xl sm:rounded-lg">

            <div class="flex min-h-screen">

                <div
                    class="flex-1 flex flex-col">

                    <main class="flex-1 mt-54">
                        <div class="flex">

                        </div>

                        <div class=" mx-auto"  x-data="{preloader: true}" x-init="preloader = false">
                            {{--  contenido principal  --}}

                            <div id="preloader">
                            <div id="loader" x-show="preloader"

                            ></div>
                            </div>
                            <div class=" md:mt-[81px] mt-[44px]">
                                @yield('breadcrumb')
                                    @yield('main')
                                <div class="container text-gris-10 mx-auto px-[5px] md:px-[20px] relative md:pt-[81px] pt-[28px] lg:px-[190px]">
                                    @yield('content')
                                </div>

                            </div>


                            {{--  boton scroll-top     --}}
                            <button id="topButton"
                                        x-ref="backTotop"
                                        @click="window.scrollTo({top: 0, behavior: 'smooth'})"
                                        class="z-30 scrollTop fixed bottom-[6px] right-[6px] md:bottom-[9px] md:right-[9px] lg:bottom-[18px] lg:right-[20px] bg-corp-50 p-2 hidden"
                                >

                                <svg  xmlns="http://www.w3.org/2000/svg" class="h-[15px] w-[15px] rotate-180" fill="none" viewBox="0 0 24 24" stroke="white">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                                </button>
                        {{--  fin boton scroll-top     --}}

                        </div>


                    </main>
                           {{--   footer  --}}
                           <div class="relative">
                            @include('layouts.footer')
                              </div>
                            {{--  fin  footer  --}}

                </div>
            </div>
        </div>
    </div>

    </div>
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

    @yield('scripts')
    @stack('scripts')

    @stack('modals')

    @stack('scripts')
    @livewireScripts

</body>

</html>
