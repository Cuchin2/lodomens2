<div>
    <section>
        <div class="w-full">
            <!-- Start coding here -->
            <div class="relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="flex items-center justify-between">
                    <div class="flex w-full m-[20px]">

                        <button class="h-[30px] text-white px-1 bg-corp-50 hover:bg-corp-70 rounded-lg overflow-hidden flex items-center justify-center mx-[5px]" wire:click="new()">
                            <div class="flex items-center justify-center mx-[10px]">
                            <x-icons.plus class="h-[12px] w-[12px] fill-white mx-[3px]" grosor="1"></x-icons.plus>

                            <div class="text-center text-[12px] font-inter font-normal leading-4 whitespace-normal my-[4px] mx-[10px]">
                                NUEVO
                            </div>
                          </div>
                        </button>
                        <h1 class="text-gris-20 mx-auto">Envíos Nacionales</h1>
                    </div>
                </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-center text-gris-30">
                            <thead class="text-[16px] text-gris-20  bg-gris-70 ">
                                <tr>
                                    <th scope="col" class="px-4 py-[13px] font-normal" wire:click="setSortBy('order')">
                                        N°</th>
                                    <th scope="col" class="px-4 py-[13px] font-normal" wire:click="setSortBy('name')">
                                        Nombre</th>
                                    <th scope="col" class="px-4 py-[13px] font-normal" >Imagen</th>
                                    <th scope="col" class="px-4 py-[13px] font-normal w-36">Descripción</th>

                                    <th scope="col" class="px-4 py-[13px] font-normal w-[100px]">Precio</th>
                                    <th scope="col" class="px-4 py-[13px] font-normal text-center">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-[14px] " x-sort="$wire.sort($item, $position)">
                                @foreach ($districts as $district)
                                <tr wire:key="{{$district->id}}"
                                    class="border-b border-gris-70 hover:bg-gris-70 hover:bg-opacity-[25%] px-[140px] h-full"
                                    x-sort:item="{{ $district->id }}">
                                    <td scope="row"
                                        class="px-4 py-[13px] font-medium  whitespace-nowrap text-gris-30">
                                        {{$district->order}}</td>
                                    <td class="px-4 py-[13px]">
                                            {{$district->name}}</td>

                                    <td class="px-4 py-[13px]">
                                        <img src="{{ asset('storage/'.($district->url ?? 'image/dashboard/No_image_dark.png')) }}" class="border-[1px] border-gris-50 rounded-[3px] h-[40px] flex mx-auto" alt="">
                                    </td>
                                    <td class="px-4 py-[13px]">
                                        <p class="truncate w-36 cursor-pointer" title="{{$district->description}}">{{$district->description}}</p>
                                    </td>
                                    </td>
                                    <td class="px-4 py-[13px]">
                                       S/. {{$district->price}}</td>
                                    </td>

                                    <td class="px-4 py-[13px] space-x-2">

                                        <button type="button" class="text-azul-50 hover:text-azul-30"
                                            wire:click="showEditModal('{{ $district->id }}')">
                                            <x-icons.edit></x-icons.edit>
                                        </button>
                                        <button class="text-rojo-50 hover:text-rojo-30"
                                            wire:click="showDelete('{{ $district->id }}')">
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
                            <x-specials.select perPage="{{--  {{ $perPage }}  --}} 5" />
                            {{$districts->links('vendor.livewire.nubesita')}}
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <x-dialog-modal wire:model="showModal" maxWidth="2xl">
        <x-slot name="title">
                {{ $name ? 'Editar Tipo de Envíos Nacionales' : 'Crear Tipo de Envíos Nacionales' }}
        </x-slot>
        <x-slot name="content">

            <div class="grid grid-cols-2">
                <div class="m-4">

                    <x-label class="my-2">Nombre</x-label>
                    <x-input placeholder="Nombre" wire:model="name" class="w-full"></x-imput>
                        @error('name')
                        <div class="text-corp-10 ml-2"> {{ $message }}</div>
                        @enderror
                        <x-label class="my-2">Precios en soles</x-label>
                        <x-input placeholder="Enlace" wire:model="price" type="number"  class="w-full"></x-imput>
                            @error('price')
                            <div class="text-corp-10 ml-2"> {{ $message }}</div>
                            @enderror
                        <x-label class="my-2">Descripción</x-label>
                        <x-input-textarea placeholder="Descripción" wire:model="description" name="description" col="4">

                        </x-imput-textarea>
                </div>
                <div class="m-4">

                        <x-label class="my-2">Imagen</x-label>

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

                    <x-button.corp1 class="ml-3" wire:click="createOrUpdate('{{$itemId}}')"  @click="$dispatch('contentsaved')" wire:loading.attr="disabled">
                            <p>Aceptar</p>
                    </x-button.corp1>
                </template>
                <template x-if="open == false">
                    <x-button.corp1 class="ml-3" wire:loading.attr="disabled">
                        <div class="w-5 h-5 rounded-full animate-spin
                        border-2 border-solid border-white border-t-transparent"></div>
                </x-button.corp1>

                </template>
            </div>
{{--              <x-button.corp1 class="ml-3" wire:click="createOrUpdate('{{$itemId}}')" @click="$dispatch('contentsaved')" wire:loading.attr="disabled">
                Aceptar
            </x-button.corp1>  --}}
        </x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model="showModal2">
        <x-slot name="title">
                Confirmación de eliminación
        </x-slot>
        <x-slot name="content">

            <div class="flex">
                <div class="m-4">
                        <p1>¿Estás seguro de elimniar <b>{{ $name }}</b> de los envios Nacionales?</p1>
                </div>

            </div>

        </x-slot>

        <x-slot name="footer">
            <x-button.corp_secundary  wire:click="$toggle('showModal2')" wire:loading.attr="disabled">
                {{ __('Cancelar') }}
            </x-button.corp_secundary>

            <x-button.corp1 class="ml-3" wire:click="erease('{{$itemId}}')" wire:loading.attr="disabled">
                Aceptar
            </x-button.corp1>
        </x-slot>
    </x-dialog-modal>

</div>


