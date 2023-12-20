<?php
$msie = strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') ? true : false;
$firefox = strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') ? true : false;
$safari = strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') ? true : false;
$chrome = strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') ? true : false;
?>
<div x-data="{ isOpen: false }" style="cursor: pointer; display:inline-flex">
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

    @endguest

</div>
<ul x-show="isOpen" x-on:click.away="isOpen = false" x-collapse x-cloak class="absolute w-[235px] bg-gris-90 top-[40px] right-[10px] md:top-[70px] md:right-[20px] rounded-[10px] text-gris-10">

    @guest
        <div @if ($firefox == true) style="left: 200px" @endif
            @if ($chrome == true) style="left: 200px" @endif></div>
        <form class="p-4" action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3 text-gris-50" x-data="{ fly : false, inputValue: ''}">
                <label class="absolute  top-[25px] left-[25px] pointer-events-none transition-all duration-300" :class=" fly  ? 'text-[10px] top-[8px] px-[3px] bg-gris-90 text-gris-10' : 'text-[14px]'">Correo electrónico</label>
                <input type="email" name="email" @click=" fly=true" @input="inputValue = $event.target.value" @click.away="inputValue === null || inputValue === '' ? fly=false : null " class="bg-gris-90 rounded-[3px] w-[203px] border-gris-50"
                    autocomplete="off" placeholder=" " >
            </div>
            <div class="mb-2 text-center text-gris-50" x-data="{ fly : false, inputValue: ''}">
                {{-- <label for="exampleDropdownFormPassword1" class="form-label label-eco mb0">Contraseña</label> --}}
                <input type="password" name="password"  class=" bg-gris-90 rounded-[3px] w-[203px] border-gris-50 "
                    autocomplete="off" placeholder=" "  @click=" fly=true" @input="inputValue = $event.target.value" @click.away="inputValue === null || inputValue === '' ? fly=false : null ">
                <label class="absolute left-[25px] pointer-events-none transition-all"  :class=" fly  ? 'text-[10px] top-[61px] px-[3px] bg-gris-90 text-gris-10' : 'text-[14px] top-[78px]'">Contraseña</label>
                <a class="text-[14px] text-corp-50" href="{{ route('password.request') }}">¿Olvidaste la contraseña?</a>

            </div>
            <div class="mb-2 text-[14px]">

                <button type="submit" class="w-full rounded-[3px]  text-white bg-corp-50 h-[33px] hover:bg-corp-70 ">Iniciar sesión</button>
                <div class="flex mt-1">
                    <eco style="margin-right:5px">¿No tienes cuenta?</eco>
                    <a class="text-corp-50" href=""
                        >Registrate</a>
                </div>
            </div>

        </form>
    @else
        <div class="px-3 pt-3 pb-2 eco-top">


            <li class="">
                <a href="#" class="form-label label-eco mb0 flex items-center">
                    <x-icons.user class="h-7"></x-icons.user>
                    <span class="ml-3 italic">Mi cuenta </span>
                </a>
            </li>
            @can('home')
                <li class="">
                    <a href="{{ route('home') }}" class="form-label label-eco mb0 flex items-center ">
                        <x-icons.home class="h-7"></x-icons.home>
                        <span class="ml-3 italic">Dashboard</span>
                    </a>
                </li>
            @endcan
            <li class="">
                <a href="#" class="form-label label-eco mb0 flex items-center">
                    <x-icons.setting class="h-7"></x-icons.setting>
                    <span class="ml-3 italic">Settings</span>
                </a>
            </li>

            <li class="">
                <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    type="submit" class="form-label label-eco mb0 flex items-center">
                    <x-icons.poweroff class="h-7"></x-icons.poweroff>
                    <span class="ml-3 italic">Cerrar sesión</span>
                </a>
            </li>


            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> @csrf

            </form>


        @endguest
</ul>
</div>
