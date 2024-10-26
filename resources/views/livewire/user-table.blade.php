<div>
    <section >
        <div class="w-full">
            <!-- Start coding here -->
            <div class="relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="flex items-center justify-between">
                    <div class="flex w-full m-[20px]">

                        <button class="h-[30px] text-white px-1 bg-corp-50 hover:bg-corp-70 rounded-lg overflow-hidden flex items-center justify-center mx-[5px]" href="{{route('users.create')}}" wire:navigate>
                            <div class="flex items-center justify-center mx-[10px]">
                            <x-icons.plus class="h-[12px] w-[12px] fill-white mx-[3px]" grosor="1"></x-icons.plus>

                            <div class="text-center text-[12px] font-inter font-normal leading-4 whitespace-normal my-[4px] mx-[10px]">
                                NUEVO
                            </div>
                          </div>
                        </button>
{{--                          <button class="h-[30px] text-gris-20  px-4 bg-gris-70 hover:bg-gris-60 rounded-lg overflow-hidden flex items-center justify-center mx-[5px]">

                            <div class="text-center  text-gray-300 text-[12px] px-1 font-inter font-normal leading-4 whitespace-normal">
                                Columnas
                            </div>

                        </button>
                        <button class="h-[30px] text-gris-20 mx-[5px] px-4 bg-gris-70 hover:bg-gris-60 rounded-lg overflow-hidden flex items-center justify-center">
                            <x-icons.cart class="h-[12px] w-[12px] fill-gris-20 mx-[3px]" grosor="1"></x-icons.cart>
                            <div class="text-center  text-gray-300 text-[12px] px-1 font-inter font-normal leading-4 whitespace-normal">
                                Columnas
                            </div>

                        </button>




                        <div class="flex justify-center">
                            <div
                                x-data="{
                                    open: false,
                                    toggle() {
                                        if (this.open) {
                                            return this.close()
                                        }

                                        this.$refs.button.focus()

                                        this.open = true
                                    },
                                    close(focusAfter) {
                                        if (! this.open) return

                                        this.open = false

                                        focusAfter && focusAfter.focus()
                                    }
                                }"
                                x-on:keydown.escape.prevent.stop="close($refs.button)"
                                x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
                                x-id="['dropdown-button']"
                                class="relative"
                            >
                                <!-- Button -->
                                <button
                                    x-ref="button"
                                    x-on:click="toggle()"
                                    :aria-expanded="open"
                                    :aria-controls="$id('dropdown-button')"
                                    type="button"
                                    class="h-[30px] text-gris-20 mx-1 px-4 bg-gris-70 hover:bg-gris-60 rounded-lg overflow-hidden flex items-center justify-center"
                                >
                                <x-icons.setting class="h-[12px] w-[12px] fill-gris-20 mx-[3px]" grosor="1"></x-icons.setting>
                                <div class="text-center  text-gray-300 text-[12px] px-1 font-inter font-normal leading-4 whitespace-normal">
                                    Columnas
                                </div>

                                    <!-- Heroicon: chevron-down -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <!-- Panel -->
                                <div
                                    x-ref="panel"
                                    x-show="open"
                                    x-transition.origin.top.left
                                    x-on:click.outside="close($refs.button)"
                                    :id="$id('dropdown-button')"
                                    style="display: none;"
                                    class="absolute left-0 mt-2 w-40 rounded-md bg-gris-70 shadow-md text-gris-20"
                                >
                                    <a href="#" class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-1.5 text-left text-[12px] hover:bg-gris-60 disabled:text-gray-500">
                                        New Task
                                    </a>

                                    <a href="#" class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-1.5 text-left text-[12px] hover:bg-gris-60 disabled:text-gray-500">
                                        Edit Task
                                    </a>

                                    <a href="#" class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-1.5 text-left text-[12px] hover:bg-gris-60 disabled:text-gray-500">
                                        Delete Task
                                    </a>
                                </div>
                            </div>
                        </div>  --}}
                        <x-specials.search />
                    </div>

                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-center   text-gris-30">
                        <thead class="text-[16px] text-gris-20  bg-gris-70 ">
                            <tr>
                                <th scope="col" class="px-4 py-[13px] font-normal" >N°</th>
                                <th scope="col" class="px-4 py-[13px] font-normal" wire:click="setSortBy('name')">
                                    Nombre
                                    </th>
                                <th scope="col" class="px-4 py-[13px] font-normal" wire:click="setSortBy('email')">Correo Eléctronico</th>
                                <th scope="col" class="px-4 py-[13px] font-normal">Roles</th>
                                <th scope="col" class="px-4 py-[13px] font-normal text-center">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-[14px] ">
                            @foreach ($users as $user)

                            <tr wire:key="{{$user->id}}" class="border-b border-gris-70 hover:bg-gris-70 hover:bg-opacity-[25%] px-[140px]">
                                <th scope="row"
                                    class="px-4 py-[13px] font-medium whitespace-nowrap text-gris-30">
                                    {{$user->id}}</th>

                                <td class="px-4 py-[13px] ">
                                    {{$user->name}}</td>
                                <td class="px-4 py-[13px]">{{$user->email}}</td>
                                <td class="px-4 py-[13px]">
                                    @foreach ($user->getRoleNames() as $rol )
                                            {{ $rol }}{{ $loop->last ? '' : ', ' }}
                                    @endforeach
                                </td>
                                <td class="px-4 py-[13px] flex items-center justify-center space-x-5">

                                    <a class="text-azul-50 hover:text-azul-30" href="{{route('users.edit',$user->id)}}">
                                        <x-icons.edit></x-icons.edit>
                                    </a>

                                    @if($rol !== 'admin')
                                    <button  class="text-rojo-50 hover:text-rojo-30" wire:click="showDeleteModal({{ $user->id }},'{{$user->name}}')" >
                                        <x-icons.trash class="h-5 w-5"></x-icons.trash>
                                    </button>
                                    @else
                                    <div>
                                        <div class="h-5 w-5"></div>
                                    </div>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="py-[20px] mx-[20px]">
                    <div class="flex ">
                    <x-specials.select perPage="{{ $perPage }}"/>

                        {{$users->links('vendor.livewire.nubesita')}}
                    </div>


                </div>
            </div>
        </div>
        <x-dialog-modal wire:model="showModal">
            <x-slot name="title">
                Confirmar Eliminación
            </x-slot>

            <x-slot name="content">
                ¿Estás seguro de que deseas eliminar el usuario de "<b>{{$itemName}}</b>"?
            </x-slot>

            <x-slot name="footer">
                <x-button.corp_secundary wire:click="$toggle('showModal')" wire:loading.attr="disabled">Cancelar</x-button.corp_secundary>
                <x-button.corp1 wire:click="delete({{$itemIdToDelete}})" wire:loading.attr="disabled">Eliminar</x-button.corp1>

            </x-slot>
        </x-dialog-modal>

    </section>

</div>
