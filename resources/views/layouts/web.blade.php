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

<body class="font-sans antialiased dark:bg-gris-90" x-data="{show_backToTop: false}"
@scroll.window="show_backToTop = window.pageYOffset > 30">
@include('layouts.header')

    <div class="min-h-screen">

        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">

            <div class="flex bg-gray-300 min-h-screen">

                <div
                    class="flex-1 flex flex-col dark:bg-gris-90">

                    <main class="flex-1 px-6 pb-3 bg-gris-90 mt-54">
                        <div class="flex">

                        </div>
                        <div class="py-4">
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
                        </div>

                    </main>
                    @include('layouts.footer')
                    <div class="text-[12px] dark:text-gris-20 flex mx-[24px]">
                        <p class="mr-auto">Realizado por <a href="https://estudio.nubesita.com/" target="__blank" class="text-corp-50">Nubesita Estudio</a></p>
                        <p>Copyright © 2023. Todos los Derechos Reservados.</p>
                        <p class="ml-auto">Versión: <p class="text-corp-50 ml-1">0.1.0</p></p>
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
    <style>

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
