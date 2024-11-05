<div
    class="mx-0 md:mx-5 lg:mx-auto lg:w-[987px] bg-black/75 sm:px-5 px-2 pb-1 flex items-center 2xl:min-h-[374px] lg:min-h-[278px]">

    <div class="w-full">
        <div class="mt-5">
            <x-web.special.success-span-alpine message="Se actualizó la foto de perfil"/>
        </div>

        <div class="bg-gris-100 px-6 py-3 w-full mt-4 flex justify-between rounded-[3px]">

            <div class="flex space-x-3 items-center"
                x-data="{name:'{{ auth()->user()->name }} {{ auth()->user()->last_name }}'}">
{{--                  <div class="relative">
                    <img class="h-12 w-12 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                        alt="{{ Auth::user()->name }}" />
                    <div class="absolute w-6 h-6 rounded-full bg-gris-50 border-[3px] border-black ml-[47px] md:ml-[33px]  mt-[-18px] hover:bg-gris-40 cursor-pointer"
                        style="display: flex; align-items: center">
                        <x-icons.camera fill="white" class="w-2.5 h-2.5 mx-auto" />
                    </div>
                </div>  --}}

                <x-specials.uploadCrop img="w-16 h-16" pos="ml-[42px] mt-[-29px] w-7 h-7 hover:bg-gris-10 !bg-corp-50 hover:!bg-corp-30" axios="si"/>
                <div>
                    <p> Hola</p>
                    <h6 x-text="name" @name.window="name = $event.detail[0].name"> </h6>

                </div>
            </div>
        </div>




        <div class="grid lg:grid-cols-4 grid-cols-1 w-full lg:gap-5 my-4">
            <div class="col-span-1 bg-gris-100 rounded-[3px] mb-4 lg:mb-0">
                <div class="py-3 ">
                    <ul>
                        <a href="{{ route('web.shop.webdashboard.profile') }}"
                            class="flex items-center pl-6 pr-3 py-2 {{ request()->routeIs('web.shop.webdashboard.profile') ? 'text-white bg-gris-100' : '' }}"
                            wire:navigate>
                            <p>Datos personales</p>
                            <x-icons.chevron-right height="10px" width="10px" grosor="1" class="ml-auto" />
                        </a>
                        <a href="{{ route('web.shop.webdashboard.account') }}"
                            class="flex items-center pl-6 pr-3 py-2 {{ request()->routeIs('web.shop.webdashboard.account') ? 'text-white bg-gris-100' : '' }}"
                            wire:navigate>
                            <p>Configurar mi cuenta</p>
                            <x-icons.chevron-right height="10px" width="10px" grosor="1" class="ml-auto" />
                        </a>
                        <a href="{{ route('web.shop.webdashboard.purchase') }}"
                            class="flex items-center pl-6 pr-3 py-2 {{ request()->routeIs('web.shop.webdashboard.purchase') ? 'text-white bg-gris-100' : '' }}"
                            wire:navigate>
                            <p>Mis compras</p>
                            <x-icons.chevron-right height="10px" width="10px" grosor="1" class="ml-auto" />
                        </a>
                        <a href="{{ route('web.shop.webdashboard.address') }}"
                            class="flex items-center pl-6 pr-3 py-2 {{ request()->routeIs('web.shop.webdashboard.address') ? 'text-white bg-gris-100' : '' }}"
                            wire:navigate>
                            <p>Direcciones</p>
                            <x-icons.chevron-right height="10px" width="10px" grosor="1" class="ml-auto" />
                        </a>

                        <a href="{{ route('web.shop.webdashboard.wishlist') }}"
                            class="flex items-center pl-6 pr-3 py-2 {{ request()->routeIs('web.shop.webdashboard.wishlist') ? 'text-white bg-gris-100' : '' }}"
                            wire:navigate>
                            <p>Wishlist</p>
                            <x-icons.chevron-right height="10px" width="10px" grosor="1" class="ml-auto" />
                        </a>

                        <li class="pl-6 pr-3 py-2">
                            <a @click="$dispatch('fire')" {{--
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();" --}}
                                type="submit" class="hover:text-white cursor-pointer">Cerrar Sesión</a>
                        </li>
                    </ul>

                </div>


            </div>

            {{ $slot }}

        </div>

        {{-- modal.js --}}
        <x-web.modal.modal maxWidth="sm">
            <x-slot name="title">
                Confirmación
            </x-slot>
            <p>Estás seguro de cerrar sesión</p>
            <x-slot name="footer">
                <x-button.corp_secundary @click="show = false" wire:loading.attr="disabled">Cancelar
                </x-button.corp_secundary>
                <x-button.corp1 onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Aceptar</x-button.corp1>
            </x-slot>
        </x-web.modal.modal>

    </div>
</div>
