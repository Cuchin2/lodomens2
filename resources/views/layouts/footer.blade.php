{{--   Responsive  --}}
<footer class="bg-gris-90 md:hidden border-t-[1px] border-t-gris-70" aria-labelledby="footer-heading">
    <h2 id="footer-heading" class="sr-only">Footer</h2>
    <div class="max-w-7xl mx-auto">

        <div class=" grid md:grid-cols-3  xl:col-span-2 text-center" x-data="{ openItem: null }">
            <div class="col-12  border-b-[1px] border-b-gris-70 py-[9.4px] cursor-pointer">
                <h3 @click="openItem === 1 ? openItem = null : openItem = 1"
                    class="collapsible text-sm font-semibold text-gris-10 tracking-wider">
                    ¿Quiénes Somos?
                    <!-- :class="open ? 'fa-chevron-down' : 'fa-chevron-up'" -->
                    <span class="float-right text-gris-10 hover:text-gris-30 md:hidden cursor-pointer">
                        <svg :class="openItem === 1 ? 'hidden' : 'block'" xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                        <svg :class="openItem === 1 ? 'block' : 'hidden'" x-cloak="mobile"
                            xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                        </svg>
                    </span>

                </h3>
                <ul x-show="openItem === 1" x-collapse.duration.400ms x-cloak="mobile" role="list"
                    class="content space-y-4">
                    <li class="mt-2">
                        <a target="_blank" href="https://codepen.io/jettaz"
                            class="text-base text-gris-10 hover:text-gris-30">
                            Joyería y moda masculina
                        </a>
                    </li>

                    <li>
                        <a target="_blank" href="https://codepen.io/jettaz"
                            class="text-base text-gris-10 hover:text-gris-30">
                            Potencia tu imagen y tu estilo
                        </a>
                    </li>

                    <li>
                        <a target="_blank" href="https://codepen.io/jettaz"
                            class="text-base text-gris-10 hover:text-gris-30">
                            La perfección está en los detalles
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-12  border-b-[1px] border-b-gris-70 py-[9.4px] cursor-pointer">
                <h3 @click="openItem === 2 ? openItem = null : openItem = 2"
                    class="collapsible text-sm font-semibold text-gris-10 tracking-wider">
                    Contacto
                    <span class="float-right text-gris-10 hover:text-gris-30 md:hidden ">
                        <svg :class="openItem === 2 ? 'hidden' : 'block'" xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                        <svg :class="openItem === 2 ? 'block' : 'hidden'" x-cloak="mobile"
                            xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                        </svg>
                    </span>
                </h3>
                <ul x-show="openItem === 2" x-collapse.duration.400ms x-cloak="mobile" role="list"
                    class="content space-y-4 mx-[20px] ">
                    <li class="mt-[10px]">
                        <a target="_blank" href="https://codepen.io/jettaz"
                            class="text-base text-gris-10 flex">
                            <x-icons.address class="h-[20px] mr-4"/> <p>Lima, Perú</p>
                        </a>
                    </li>

                    <li>
                        <a target="_blank" href="https://codepen.io/jettaz"
                            class="text-base text-gris-10 flex">
                            <x-icons.phone class="h-[20px] mr-4"/> <p>+51 927 093 258</p>
                        </a>
                    </li>

                    <li>
                        <a target="_blank" href="https://codepen.io/jettaz"
                            class="text-base text-gris-10 flex">
                            <x-icons.mail class="h-[20px] mr-4"/> <p>contacto@lodomens.com</p>
                        </a>
                    </li>

                    <li>
                        <a target="_blank" href="https://codepen.io/jettaz"
                            class="text-base text-gris-10 flex">
                            <x-icons.pedidos class="h-[20px] mr-4"/> <p>Envios Nacionales e Internacionales</p>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-12  py-[9.4px]  mx-auto">
                <div class="flex space-x-[37px]">
                    <x-icons.socialmedia.instagram class="h-[15.5px] fill-gris-10 hover:fill-corp-50"/>
                    <x-icons.socialmedia.tiktok class="h-[15.5px] fill-gris-10 hover:fill-corp-50"/>
                    <x-icons.socialmedia.facebook class="h-[15.5px] fill-gris-10 hover:fill-corp-50"/>
                    <x-icons.socialmedia.youtube class="h-[15.5px] fill-gris-10 hover:fill-corp-50"/>
                </div>
            </div>

        </div>


    </div>
</footer>
 {{--  normal  --}}
<footer class="bg-gris-90 hidden md:flex h-[182px]" aria-labelledby="footer-heading">

    <div class=" mx-auto mt-[30px] px-4  lg:px-8">

        <div class="grid md:grid-cols-3 gap-[120px]  xl:col-span-2 ">
            <div class="col-12 md:col-4">
                <h3
                    class="collapsible font-semibold text-gris-10 tracking-wider mb-[20px] ">
                    ¿Quiénes Somos?


                </h3>
                <ul role="list h-[81px] w-[256px]"
                    class="content space-y-1">
                    <li>
                        <a target="_blank" href="https://codepen.io/jettaz"
                            class="text-base text-gris-10 hover:text-gris-30">
                            Joyería y moda masculina
                        </a>
                    </li>

                    <li>
                        <a target="_blank" href="https://codepen.io/jettaz"
                            class="text-base text-gris-10 hover:text-gris-30">
                            Potencia tu imagen y tu estilo
                        </a>
                    </li>

                    <li>
                        <a target="_blank" href="https://codepen.io/jettaz"
                            class="text-base text-gris-10 hover:text-gris-30">
                            La perfección está en los detalles
                        </a>
                    </li>

                </ul>
            </div>
            <div class="col-12 md:col-4 mx-auto">


                    <x-lodomens.icons.logo_principal class="w-[183px] " />

                <div class="mt-[25px] flex space-x-[27px]">
                    <x-icons.socialmedia.instagram class="h-[15.5px] fill-gris-10 hover:fill-corp-50"/>
                    <x-icons.socialmedia.tiktok class="h-[15.5px] fill-gris-10 hover:fill-corp-50"/>
                    <x-icons.socialmedia.facebook class="h-[15.5px] fill-gris-10 hover:fill-corp-50"/>
                    <x-icons.socialmedia.youtube class="h-[15.5px] fill-gris-10 hover:fill-corp-50"/>
                </div>

            </div>
            <div class="col-12 md:col-4">

                <ul  role="list"
                    class="content space-y-3 cola">
                    <li>
                        <a target="_blank" href="https://codepen.io/jettaz"
                            class="text-base text-gris-10 flex">
                            <x-icons.address class="h-[20px] mr-4"/> <p>Lima, Perú</p>
                        </a>
                    </li>

                    <li>
                        <a target="_blank" href="https://codepen.io/jettaz"
                            class="text-base text-gris-10 flex">
                            <x-icons.phone class="h-[20px] mr-4"/> <p>+51 927 093 258</p>
                        </a>
                    </li>

                    <li>
                        <a target="_blank" href="https://codepen.io/jettaz"
                            class="text-base text-gris-10 flex">
                            <x-icons.mail class="h-[20px] mr-4"/> <p>contacto@lodomens.com</p>
                        </a>
                    </li>

                    <li>
                        <a target="_blank" href="https://codepen.io/jettaz"
                            class="text-base text-gris-10 flex">
                            <x-icons.pedidos class="h-[20px] mr-4"/> <p>Envios Nacionales e Internacionales</p>
                        </a>
                    </li>


                </ul>
            </div>

        </div>


    </div>
</footer>

