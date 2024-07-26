<?php
$msie = strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') ? true : false;
$firefox = strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') ? true : false;
$safari = strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') ? true : false;
$chrome = strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') ? true : false;
?>
<div x-data="{ isOpen: false }" style="cursor: pointer; display:inline-flex" @click="stopPropagation">
    <div x-on:click="isOpen = !isOpen" @keydown.escape="isOpen = false" class="flex-items-center"
        title=@guest
"Iniciar sesión"
    @else
    {{ Auth::user()->name }} @endguest>
        @guest
            <a class="dark:hover:text-corp-50 flex items-center relative">
                <x-icons.user class="h-[20px] w-[20px] fill-gris-10" />
            </a>
        @else
            <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                alt="{{ Auth::user()->name }}" />
                <span class="absolute top-[-1px] left-[57px] flex h-3 w-3 items-center justify-center md:hidden {{ $cart>0 || $wishlist>0 ? '' :'hidden' }}">

                    <span class="inline-flex h-[9px] w-[9px] rounded-full bg-corp-30"></span>
                  </span>
        @endguest

    </div>
    <ul x-show="isOpen" @closelogin.window="isOpen = false" x-collapse x-cloak
        class="absolute z-50 @guest w-[235px] @else w-fit  @endguest rounded-[5px] bg-gris-90 md:top-[34px] md:right-[17px] top-[26px] right-[9px] text-gris-10 border-[0.5px] border-gris-80">
        @guest
            <div @if ($firefox == true) style="left: 200px" @endif
                @if ($chrome == true) style="left: 200px" @endif></div>
            <form class="p-4" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-3 text-gris-50 relative" >
                    <input autocomplete="off" id="email" name="email" type="text" class="peer rounded-[3px] placeholder-transparent bg-gris-90 text-gris-10 h-10 w-full border-gris-50 focus:ring-gris-50 focus:border-gris-50 focus:outline-none" placeholder="" />
                    <label for="email" class="absolute left-[12px] top-[-8px] text-gris-30 peer-placeholder-shown:text-[14px] text-[10px] bg-gris-90  rounded-[3px] peer-placeholder-shown:text-gris-50 peer-placeholder-shown:top-[9px] px-[3px] transition-all peer-focus:top-[-8px] peer-focus:text-gris-10 peer-focus:text-[10px]" >Correo electrónico</label>


                </div>
                <div class="mb-2 text-center text-gris-50 relative" >
                    <input autocomplete="off" id="password" name="password" type="password" class="peer rounded-[3px] placeholder-transparent bg-gris-90 text-gris-10 h-10 w-full border-gris-50 focus:ring-gris-50 focus:border-gris-50 focus:outline-none" placeholder="" />
                    <label for="password" class="absolute left-[12px] top-[-8px] text-gris-30 peer-placeholder-shown:text-[14px] text-[10px] bg-gris-90  rounded-[3px] peer-placeholder-shown:text-gris-50 peer-placeholder-shown:top-[9px] px-[3px] transition-all peer-focus:top-[-8px] peer-focus:text-gris-10 peer-focus:text-[10px]">Contraseña</label>
                    <a class="text-[14px] text-corp-50" href="{{ route('web.recover_password') }}">¿Olvidaste la contraseña?</a>

                </div>
                <div class="mb-2 text-[14px]">

                    <button type="submit"
                        class="w-full rounded-[3px]  text-white bg-corp-50 h-[33px] hover:bg-corp-70 ">Iniciar
                        sesión</button>
                    <div class="flex mt-1">
                        <eco style="margin-right:5px">¿No tienes cuenta?</eco>
                        <a class="text-corp-50" href="{{ route('web.login_register') }}">Registrate</a>
                    </div>
                </div>

            </form>
        @else
            <div class="space-y-[10px] py-4 px-6 ">
                <li class="md:hidden">
                    <a href="{{ route('web.shop.cart.index') }}" class=" flex items-center hover:text-corp-50 relative ">
                        <x-icons.cart class="h-4"></x-icons.cart>
                        <x-elements.notification-icon number="{{ $cart }}" class="{{ $cart == 0 ? 'hidden' : '!right-[80px]' }}"/>
                        <span class="ml-3 ">Carrito</span>
                    </a>
                </li>
                @auth
                <li class="md:hidden">
                    <a href="{{ route('web.shop.webdashboard.wishlist') }}" class=" flex items-center hover:text-corp-50 relative">
                        <x-icons.heart class="h-4"></x-icons.heart>
                        <x-elements.notification-icon number="{{ $wishlist }}" class="{{ $wishlist == 0 ? 'hidden' : '!right-[80px]' }}"/>

                        <span class="ml-3 ">Wishlist</span>
                    </a>
                </li>
                @endauth
                <li class="!mt-0">
                    <a  href="{{ route('web.shop.webdashboard.profile') }}" class="flex items-center hover:text-corp-50">
                        <x-icons.user class="h-4"></x-icons.user>
                        <span class="ml-3 ">Mi cuenta </span>
                    </a>
                </li>
                @can('home')
                    <li >
                        <a href="{{ route('dashboard') }}" class="flex items-center hover:text-corp-50">
                            <x-icons.home class="h-4"></x-icons.home>
                            <span class="ml-3 ">Dashboard</span>
                        </a>
                    </li>
                @endcan


                <li>
                    <a href="#" class=" flex items-center hover:text-corp-50 md:hidden">
                        <x-icons.setting class="h-4"></x-icons.setting>
                        <span class="ml-3 ">Settings</span>
                    </a>
                </li>

                <li>
                    <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        type="submit" class="flex items-center hover:text-corp-50">
                        <x-icons.poweroff class="h-4"></x-icons.poweroff>
                        <span class="ml-3 w-max">Cerrar sesión</span>
                    </a>
                </li>


                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> @csrf

                </form>


            @endguest
    </ul>
</div>
