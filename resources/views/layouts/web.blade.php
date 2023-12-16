<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="icon" href="{{ asset('image/lodomens/Favicon_LodoMens.ico') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Styles -->

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Scripts -->



    @livewireStyles
    @vite(['resources/css/web/app.css', 'resources/js/app.js'])
    @yield('styles')
    @stack('styles')
</head>

<body class="font-sans antialiased bg-black" x-data="{show_backToTop: false}"
@scroll.window="show_backToTop = window.pageYOffset > 30">
@include('layouts.header')

    <div class="min-h-screen">

        <div class="bg-black  overflow-hidden shadow-xl sm:rounded-lg">

            <div class="flex bg-black min-h-screen">

                <div
                    class="flex-1 flex flex-col">

                    <main class="flex-1  pb-3  mt-54">
                        <div class="flex">

                        </div>

                            <div class=" mx-auto">

                                @yield('content')
                                <button id="topButton"
                                        x-ref="backTotop"
                                        @click="window.scrollTo({top: 0, behavior: 'smooth'})"
                                        class="scrollTop fixed bottom-10 right-10 bg-corp-50 p-2 hidden"
                                >

                                <svg  xmlns="http://www.w3.org/2000/svg" class="h-[15px] w-[15px] rotate-180" fill="none" viewBox="0 0 24 24" stroke="white">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                  </svg>
                                </button>
                            </div>


                    </main>
                    @include('layouts.footer')
                    <div class="items-center hidden h-[38px] md:text-[14px] text-[12px] bg-gris-90 text-gris-10 md:flex w-full border-t-[1px] border-t-gris-70">
                        <div class="mx-auto flex">

                        <p class="mr-auto">© 2023 Realizado por <a href="https://estudio.nubesita.com/" target="__blank" class="hover:text-corp-50 font-bold">Nubesita Estudio</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    </div>
    <link rel="stylesheet" href="{{ asset('codemirror/lib/codemirror.css') }}" data-navigate-track>
    <link rel="stylesheet" href="{{ asset('codemirror/theme/xq-dark.css') }}" data-navigate-track>

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
