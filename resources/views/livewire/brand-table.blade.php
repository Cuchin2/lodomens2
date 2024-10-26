<div>
    @if (session()->has('message'))
    <div class="alert alert-success">
        <x-dashboard.alert.succes> {{ session('message') }}</x-dashboard.alert.succes>

    </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger">
            <x-dashboard.alert.danger>{{ session('error') }} </x-dashboard.alert.danger>

        </div>
    @endif
    <section>
        <div class="w-full">
            <!-- Start coding here -->
            <div class="relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="flex items-center justify-between">
                    <div class="flex w-full m-[20px]">

                        <button class="h-[30px] text-white px-1 bg-corp-50 hover:bg-corp-70 rounded-lg overflow-hidden flex items-center justify-center mx-[5px]" wire:click="showDeleteModal('','','CREATE','','')">
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
                                    <th scope="col" class="px-4 py-[13px] font-normal w-[100px]" >Imagen</th>
                                    <th scope="col" class="px-4 py-[13px] font-normal" wire:click="setSortBy('name')">
                                        Nombre
                                        </th>
                                        <th scope="col" class="px-4 py-[13px] font-normal" wire:click="setSortBy('slug')">
                                            Código
                                            </th>
                                    <th scope="col" class="px-4 py-[13px] font-normal" wire:click="setSortBy('created_at')">Descripción</th>

                                    <th scope="col" class="px-4 py-[13px] font-normal text-center">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-[14px] ">
                                @foreach ($brands as $brand)
                                <tr wire:key="{{$brand->id}}" class="border-b border-gris-70 hover:bg-gris-70 hover:bg-opacity-[25%] px-[140px]">
                                    <td scope="row"
                                        class="px-4 py-[13px] font-medium  whitespace-nowrap text-gris-30">
                                        {{$brand->id}}</td>

                                    <td class="px-4 py-[13px]">
                                        <img src="{{ asset('storage/'.($brand->images->url ?? 'image/dashboard/No_image_dark.png')) }}" class="border-[1px] border-gris-50 rounded-[3px] h-[40px] w-[40px] flex mx-auto" alt="">
                                    </td>
                                    <td class="px-4 py-[13px]">
                                        {{$brand->name}}</td>
                                    </td>

                                        <td class="px-4 py-[13px]">
                                            {{$brand->slug}}</td>
                                    <td class="px-4 py-[13px]">{{$brand->description}}</td>

                                    <td class="px-4 py-[13px] flex items-center justify-center space-x-5">
                                        <button type="button" class="text-azul-50 hover:text-azul-30" wire:click="showDeleteModal('{{ $brand->id }}','{{$brand->name}}','DESCRIPTION','{{ $brand->slug }}','{{ isset($brand->images->url) ? asset('storage/'. $brand->images->url) : '' }}')">
                                            <x-icons.edit></x-icons.edit>
                                        </button>
                                        <button  class="text-rojo-50 hover:text-rojo-30" wire:click="showDeleteModal2('{{ $brand->id }}','{{$brand->name}}','DELETE','','{{ isset($brand->images->url) ? asset('storage/'. $brand->images->url) : '' }}')" >
                                            <x-icons.trash class="h-5 w-5"></x-icons.trash>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="py-[20px] mx-[20px]">
                        <div class="flex ">
                            <x-specials.select perPage="{{ $perPage }}"/>
                        {{$brands->links('vendor.livewire.nubesita')}}
                    </div>
                </div>
            </div>

        <x-dialog-modal wire:model="showModal">
            <x-slot name="title">
                {{  $which == 'CREATE' ? 'Crear Marca' : 'Editar Marca' }}
            </x-slot>
            <x-slot name="content">

                <div class="grid grid-cols-2">
                    <div class="m-4">
                        <x-label class="my-2">Nombre</x-label>
                        <x-input placeholder="Nombre" wire:model="name" name="name" value="{{$name}}" class="w-full"></x-imput>
                            @error('name')
                            <div class="text-corp-10 ml-2"> {{ $message }}</div>
                            @enderror
                            <x-label class="my-2">Descripción</x-label>
                    <x-input-textarea placeholder="Descripción" wire:model="description" name="description" col="4">
                        {{$description}}
                    </x-imput-textarea>
                    </div>
                    <div class="m-4">
                        <x-label class="my-2">Codígo</x-label>
                        <x-input placeholder="Nombre" wire:model="slug" name="name" value="{{$slug}}" class="w-full" wire:change='codeComplete'></x-imput>
                            @error('slug')
                            <div class="text-corp-10 ml-2"> {{ $message }}</div>
                            @enderror
                            <x-label class="my-2">Logo:</x-label>

                            <div class="py-3">
                                <x-specials.upload-file livewire="true"/>
                            </div>

                    </div>
                </div>

            </x-slot>

            <x-slot name="footer">

                <x-button.corp_secundary  wire:click="$toggle('showModal')" wire:loading.attr="disabled">
                    {{ __('Cancelar') }}
                </x-button.corp_secundary>
                <div x-data="{ open: true }" @clockimage.window="open=false" @revealbutton.window="open=true">
                    <template x-if="open == true">

                        <x-button.corp1 class="ml-3" wire:click="deleted('{{$itemIdToDelete}}')" wire:loading.attr="disabled">
                                <p>{{ $which == 'CREATE' ? 'Crear' : 'Actualizar' }}</p>
                        </x-button.corp1>
                    </template>
                    <template x-if="open == false">
                        <x-button.corp1 class="ml-3" wire:loading.attr="disabled">
                            <div class="w-5 h-5 rounded-full animate-spin
                            border-2 border-solid border-white border-t-transparent"></div>
                    </x-button.corp1>

                    </template>
                </div>



            </x-slot>
        </x-dialog-modal>
        <x-dialog-modal wire:model="showModalDelete">
            <x-slot name="title">
                Confirmar Eliminación
            </x-slot>
            <x-slot name="content">
                <div class="flex justify-between ">
                ¿Estás seguro de que deseas eliminar la etiqueta "<b>{{$name}}</b>"?
                <img src="{{$logo== '' ? asset('storage/image/dashboard/No_image_dark.png') :  $logo}}" alt="{{$name}}" class="mx-auto h-[70px]">
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-button.corp_secundary  wire:click="$toggle('showModalDelete')" wire:loading.attr="disabled">
                    {{ __('Cancelar') }}
                </x-button.corp_secundary>

                <x-button.corp1 class="ml-3" wire:click="kill('{{$itemIdToDelete}}')" wire:loading.attr="disabled">
                    Eliminar
                </x-button.corp1>
            </x-slot>
        </x-dialog-modal>
    </section>

</div>
