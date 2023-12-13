{{--   Responsive  --}}
<footer class="bg-gris-90 md:hidden" aria-labelledby="footer-heading">
    <h2 id="footer-heading" class="sr-only">Footer</h2>
    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:py-16 lg:px-8">

        <div class=" grid md:grid-cols-3 gap-8  xl:col-span-2 md:text-center" x-data="{ openItem: null }">
            <div class="col-12 md:col-4">
                <h3 @click="openItem === 1 ? openItem = null : openItem = 1"
                    class="collapsible text-sm font-semibold text-gris-10 tracking-wider uppercase">
                    Solutions
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
                    <li>
                        <a target="_blank" href="https://codepen.io/jettaz"
                            class="text-base text-gris-10 hover:text-gray-900">
                            Marketing
                        </a>
                    </li>

                    <li>
                        <a target="_blank" href="https://codepen.io/jettaz"
                            class="text-base text-gris-10 hover:text-gray-900">
                            Analytics
                        </a>
                    </li>

                    <li>
                        <a target="_blank" href="https://codepen.io/jettaz"
                            class="text-base text-gris-10 hover:text-gray-900">
                            Commerce
                        </a>
                    </li>

                    <li>
                        <a target="_blank" href="https://codepen.io/jettaz"
                            class="text-base text-gris-10 hover:text-gray-900">
                            Insights
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-12 md:col-4">
                <h3 @click="openItem === 2 ? openItem = null : openItem = 2"
                    class="collapsible text-sm font-semibold text-gris-10 tracking-wider uppercase">
                    Support
                    <span class="float-right text-gris-10 hover:text-gris-30 md:hidden cursor-pointer">
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
                    class="content space-y-4">
                    <li>
                        <a target="_blank" href="https://codepen.io/jettaz"
                            class="text-base text-gris-10 hover:text-gray-900">
                            Pricing
                        </a>
                    </li>

                    <li>
                        <a target="_blank" href="https://codepen.io/jettaz"
                            class="text-base text-gris-10 hover:text-gray-900">
                            Documentation
                        </a>
                    </li>

                    <li>
                        <a target="_blank" href="https://codepen.io/jettaz"
                            class="text-base text-gris-10 hover:text-gray-900">
                            Guides
                        </a>
                    </li>

                    <li>
                        <a target="_blank" href="https://codepen.io/jettaz"
                            class="text-base text-gris-10 hover:text-gray-900">
                            API Status
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-12 md:col-4">
                <h3 @click="openItem === 3 ? openItem = null : openItem = 3"
                    class="collapsible text-sm font-semibold text-gris-10 tracking-wider uppercase">
                    Company
                    <span class="float-right text-gris-10 hover:text-gris-30 md:hidden cursor-pointer">
                        <svg :class="openItem === 3 ? 'hidden' : 'block'" xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                        <svg :class="openItem === 3 ? 'block' : 'hidden'" x-cloak="mobile"
                            xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                        </svg>
                    </span>
                </h3>
                <ul x-show="openItem === 3" x-collapse.duration.400ms x-cloak="mobile" role="list"
                    class="content space-y-4 cola">
                    <li>
                        <a target="_blank" href="https://codepen.io/jettaz" x-cloak="mobile"
                            class="text-base text-gris-30 hover:text-gray-900">
                            About
                        </a>
                    </li>

                    <li>
                        <a target="_blank" href="https://codepen.io/jettaz"
                            class="text-base text-gris-30 hover:text-gray-900">
                            Blog
                        </a>
                    </li>

                    <li>
                        <a target="_blank" href="https://codepen.io/jettaz"
                            class="text-base text-gris-30 hover:text-gray-900">
                            Jobs
                        </a>
                    </li>

                    <li>
                        <a target="_blank" href="https://codepen.io/jettaz"
                            class="text-base text-gris-30 hover:text-gray-900">
                            Press
                        </a>
                    </li>

                    <li>
                        <a target="_blank" href="https://codepen.io/jettaz"
                            class="text-base text-gris-30 hover:text-gray-900">
                            Partners
                        </a>
                    </li>
                </ul>
            </div>

        </div>


    </div>
</footer>
 {{--  normal  --}}
<footer class="bg-gris-90 hidden md:flex" aria-labelledby="footer-heading">

    <div class=" mx-auto py-4 px-4 mt-[30px] lg:px-8">

        <div class=" grid md:grid-cols-3 gap-[250px]  xl:col-span-2 ">
            <div class="col-12 md:col-4">
                <h3
                    class="collapsible text-sm font-semibold text-gris-10 tracking-wider uppercase mb-[20px]">
                    ¿Quiénes Somos?


                </h3>
                <ul role="list"
                    class="content space-y-2">
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

                <div class="mt-[20px] flex space-x-[27px]">
                    <x-icons.socialmedia.instagram class="h-[15.5px] fill-gris-10 hover:fill-corp-50"/>
                    <x-icons.socialmedia.tiktok class="h-[15.5px] fill-gris-10 hover:fill-corp-50"/>
                    <x-icons.socialmedia.facebook class="h-[15.5px] fill-gris-10 hover:fill-corp-50"/>
                    <x-icons.socialmedia.youtube class="h-[15.5px] fill-gris-10 hover:fill-corp-50"/>
                </div>

            </div>
            <div class="col-12 md:col-4">
                <h3
                    class="collapsible text-sm font-semibold text-gris-10 tracking-wider uppercase">
                    Company

                </h3>
                <ul  role="list"
                    class="content space-y-4 cola">
                    <li>
                        <a target="_blank" href="https://codepen.io/jettaz" x-cloak="mobile"
                            class="text-base text-gris-30 hover:text-gray-900">
                            About
                        </a>
                    </li>

                    <li>
                        <a target="_blank" href="https://codepen.io/jettaz"
                            class="text-base text-gris-30 hover:text-gray-900">
                            Blog
                        </a>
                    </li>

                    <li>
                        <a target="_blank" href="https://codepen.io/jettaz"
                            class="text-base text-gris-30 hover:text-gray-900">
                            Jobs
                        </a>
                    </li>

                    <li>
                        <a target="_blank" href="https://codepen.io/jettaz"
                            class="text-base text-gris-30 hover:text-gray-900">
                            Press
                        </a>
                    </li>


                </ul>
            </div>

        </div>


    </div>
</footer>

