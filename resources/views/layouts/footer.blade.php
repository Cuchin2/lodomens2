{{--   Responsive  --}}
<footer class=" bg-gris-90 md:hidden border-t-[1px] border-t-gris-70 z-20" aria-labelledby="footer-heading">
    <h2 id="footer-heading" class="sr-only">Footer</h2>
    <div class="max-w-7xl mx-auto">

        <div class=" grid md:grid-cols-3  xl:col-span-2 text-center" x-data="{ openItem: null }">
            <div class="col-12  border-b-[1px] border-b-gris-70 py-[9.4px] cursor-pointer">
                <h3 @click="openItem === 1 ? openItem = null : openItem = 1"
                    class="collapsible text-sm font-semibold text-gris-10 tracking-wider uppercase">
                    ¿Quiénes Somos?
                    <!-- :class="open ? 'fa-chevron-down' : 'fa-chevron-up'" -->
                    <span class="float-right text-gris-10 hover:text-gris-30 md:hidden cursor-pointer">
                        <svg :class="openItem === 1 ? 'hidden' : 'block'" xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 mr-[14px]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                        <svg :class="openItem === 1 ? 'block' : 'hidden'" x-cloak="mobile"
                            xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-[14px]" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                        </svg>
                    </span>

                </h3>
                <ul x-show="openItem === 1" x-collapse.duration.400ms x-cloak="mobile" role="list"
                    class="content space-y-0 text-[13px] mb-1 text-gris-10 cursor-default">
                    <li class="mt-2">
                            Joyería y moda masculina
                    </li>
                    <li>
                            Potencia tu imagen y tu estilo
                    </li>
                    <li>
                            La perfección está en los detalles
                    </li>
                </ul>
            </div>
            <div class="col-12  border-b-[1px] border-b-gris-70 py-[9.4px] cursor-pointer">
                <h3 @click="openItem === 2 ? openItem = null : openItem = 2"
                    class="collapsible text-sm font-semibold text-gris-10 tracking-wider uppercase">
                    Contacto
                    <span class="float-right text-gris-10 hover:text-gris-30 md:hidden ">
                        <svg :class="openItem === 2 ? 'hidden' : 'block'" xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 mr-[14px]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                        <svg :class="openItem === 2 ? 'block' : 'hidden'" x-cloak="mobile"
                            xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-[14px]" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                        </svg>
                    </span>
                </h3>
                <ul x-show="openItem === 2" x-collapse.duration.400ms x-cloak="mobile" role="list"
                    class="content space-y-1 text-[13px] mx-[20px] mb-1 cursor-default">
                    <li class="mt-[10px]">
                        <div
                            class=" text-gris-10 flex">
                            <x-icons.address class="h-[15px] mr-4 mt-1"/> <p>Lima, Perú</p>
                        </div>
                    </li>

                    <li>
                        <div
                            class=" text-gris-10 flex">
                            <x-icons.phone class="h-[15px] mr-4 mt-1"/> <p>+51 927 093 258</p>
                        </div>
                    </li>

                    <li>
                        <div
                            class=" text-gris-10 flex">
                            <x-icons.mail class="h-[15px] mr-4 mt-1"/> <p>contacto@lodomens.com</p>
                        </div>
                    </li>

                    <li>
                        <div
                            class=" text-gris-10 flex">
                            <x-icons.pedidos class="h-[15px] mr-4 mt-1"/> <p class="text-left">Envios Nacionales e Internacionales</p>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-12  py-[13.4px]  mx-auto">
                <div class="flex space-x-[37px]">
                    <a href="https://www.instagram.com/lodo.mens" target="_blank"><x-icons.socialmedia.instagram class="h-[15.5px] fill-gris-10 hover:fill-corp-50"/></a>
                    <a href="https://www.tiktok.com/@lodo.mens" target="_blank"><x-icons.socialmedia.tiktok class="h-[15.5px] fill-gris-10 hover:fill-corp-50"/></a>
                    <a href="https://www.facebook.com/profile.php?id=100077757468220" target="_blank"><x-icons.socialmedia.facebook class="h-[15.5px] fill-gris-10 hover:fill-corp-50"/></a>
                    <a href="https://www.youtube.com/@Lodomens" target="_blank"><x-icons.socialmedia.youtube class="h-[15.5px] fill-gris-10 hover:fill-corp-50"/></a>
                </div>
            </div>

        </div>


    </div>
</footer>
 {{--  normal  --}}
<footer class="bg-gris-90 hidden md:flex h-[182px]  border-t-[1px] border-t-gris-70 " aria-labelledby="footer-heading">

    <div class=" mx-auto mt-[20px] px-4  lg:px-8">

        <div class="grid lg:grid-cols-3 gap-[120px] md:grid-cols-2 xl:col-span-2 ">
            <div class="col-12 md:col-4 text-gris-10 ">
                <h3
                    class="collapsible font-semibold tracking-wider mb-[20px] uppercase">
                    ¿Quiénes Somos?


                </h3>
                <ul role="list h-[81px] w-[256px]"
                    class="content space-y-1">
                    <li>

                            Joyería y moda masculina

                    </li>

                    <li>

                            Potencia tu imagen y tu estilo

                    </li>

                    <li>

                            La perfección está en los detalles

                    </li>

                </ul>
            </div>
            <div class="hidden lg:block col-12 md:col-4 mx-auto">
                    <x-lodomens.icons.logo_principal class="w-[183px] " />

                <div class="mt-[25px] flex space-x-[27px]">
                    <a href="https://www.instagram.com/lodo.mens" target="_blank"><x-icons.socialmedia.instagram class="h-[15.5px] fill-gris-10 hover:fill-corp-50"/></a>
                    <a href="https://www.tiktok.com/@lodo.mens" target="_blank"><x-icons.socialmedia.tiktok class="h-[15.5px] fill-gris-10 hover:fill-corp-50"/></a>
                    <a href="https://www.facebook.com/profile.php?id=100077757468220" target="_blank"><x-icons.socialmedia.facebook class="h-[15.5px] fill-gris-10 hover:fill-corp-50"/></a>
                    <a href="https://www.youtube.com/@Lodomens" target="_blank"><x-icons.socialmedia.youtube class="h-[15.5px] fill-gris-10 hover:fill-corp-50"/></a>
                </div>

            </div>
            <div class="col-12 md:col-4">

                <ul  role="list"
                    class="content space-y-3 cola">
                    <li>
                        <div
                            class="text-base text-gris-10 flex">
                            <x-icons.address class="h-[20px] mr-4"/> <p>Lima, Perú</p>
                    </div>
                    </li>

                    <li>
                        <div
                            class="text-base text-gris-10 flex">
                            <x-icons.phone class="h-[20px] mr-4"/> <p>+51 927 093 258</p>
                    </div>
                    </li>

                    <li>
                        <div
                            class="text-base text-gris-10 flex">
                            <x-icons.mail class="h-[20px] mr-4"/> <p>contacto@lodomens.com</p>
                    </div>
                    </li>

                    <li>
                        <div
                            class="text-base text-gris-10 flex">
                            <x-icons.pedidos class="h-[20px] mr-4"/> <p>Envios Nacionales e Internacionales</p>
                    </div>
                    </li>


                </ul>
            </div>

        </div>


    </div>
</footer>

<div class="items-center hidden lg:h-[35px] md:h-[50px] md:text-[14px] text-[12px] bg-gris-90 text-gris-10 md:flex w-full border-t-[1px] border-t-gris-70">
    <div class="lg:mx-auto md:mr-auto flex md:ml-[140px]">

    <p class="mr-1 lg:block md:hidden">© 2023 </p> <p> Realizado por <a href="https://www.instagram.com/nubesita.estudio/" target="__blank" class="hover:text-corp-50 font-bold">Nubesita Estudio</a></p>
    </div>
    <div class="md:flex lg:hidden space-x-[57px] md:ml-auto md:mr-[140px]">
        <a href="https://www.instagram.com/lodo.mens" target="_blank"><x-icons.socialmedia.instagram class="h-[15.5px] fill-gris-10 hover:fill-corp-50"/></a>
        <a href="https://www.tiktok.com/@lodo.mens" target="_blank"><x-icons.socialmedia.tiktok class="h-[15.5px] fill-gris-10 hover:fill-corp-50"/></a>
        <a href="https://www.facebook.com/profile.php?id=100077757468220" target="_blank"><x-icons.socialmedia.facebook class="h-[15.5px] fill-gris-10 hover:fill-corp-50"/></a>
        <a href="https://www.youtube.com/@Lodomens" target="_blank"><x-icons.socialmedia.youtube class="h-[15.5px] fill-gris-10 hover:fill-corp-50"/></a>
    </div>
</div>
