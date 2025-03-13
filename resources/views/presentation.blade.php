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
    <style>
 .fullscreen-video {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: fill; /* Cambiado a fill */
    z-index: -10;
}
.social-icon:hover {
            transform: scale(1.2);
            transition: transform 0.3s ease-in-out;
        }
    </style>
    @stack('styles')
    @stack('head')
    @vite(['resources/css/web/app.css', 'resources/js/app.js'])
    @livewireStyles
    @livewireScripts
</head>
<body class="font-sans antialiased bg-black" x-data="{show_backToTop: false}">
    <video class="fullscreen-video"
    src="{{ asset('storage/image/lodomens/lodovideo.mp4') }}"
    alt="Video de Lodomens"
    autoplay
    loop
    muted>
</video>
<div class="h-screen flex items-center justify-center">
    <div class="shadow-lg rounded-lg p-8 max-w-md  mx-auto text-center">
        <x-lodomens.icons.logo_secundario class="md:h-[80px] h-[54px] mx-auto mb-4" />
        <h1 class="text-2xl font-semibold text-gris-40 mb-2">Lodomens</h1>
        <p class="text-gris-30 mb-4">Joyería y accesorios masculinos | Profesionales</p>

        <div class="flex justify-center space-x-4 mb-6">
            @foreach ($datos['redes'] as $red)
            <a href="{{$red->url }}"alt="" target="_blank" class="social-icon">
                <x-dynamic-component :component="'icons.socialmedia.'.$red->name" :class="'h-[30px] fill-gris-10 hover:fill-corp-50'" />
            </a>
            @endforeach
        </div>

        <a href="{{ route('web.shop.index') }}" class="bg-corp-70 hover:bg-corp-50 text-white font-bold py-2 px-4 rounded">
            <x-button.webprimary>Ir a la tienda</x-button.webprimary>
        </a>

    </div>
</div>

    @yield('scripts')
    @stack('scripts')

    @stack('modals')

</body>
</html>
