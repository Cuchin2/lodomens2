<div>
    <section>
        <div class="w-full">
            <!-- Start coding here -->
            <div class="relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="flex items-center justify-between">
                    <div class="flex w-full m-[20px]">

                        <button class="h-[30px] text-white px-1 bg-corp-50 hover:bg-corp-70 rounded-lg overflow-hidden flex items-center justify-center mx-[5px]" wire:click="showDeleteModal('0','','CREATE')">
                            <div class="flex items-center justify-center mx-[10px]">
                            <x-icons.plus class="h-[12px] w-[12px] fill-white mx-[3px]" grosor="1"></x-icons.plus>

                            <div class="text-center text-[12px] font-inter font-normal leading-4 whitespace-normal my-[4px] mx-[10px]">
                                NUEVO
                            </div>
                            </div>
                        </button>
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
                                    <th scope="col" class="px-4 py-[13px] font-normal" wire:click="setSortBy('created_at')">Descripción</th>

                                    <th scope="col" class="px-4 py-[13px] font-normal text-center">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-[14px] ">
                                @foreach ($tags as $tag)

                                <tr wire:key="{{$tag->id}}" class="border-b border-gris-70 hover:bg-gris-70 hover:bg-opacity-[25%] px-[140px]">
                                    <th scope="row"
                                        class="px-4 py-[13px] font-medium  whitespace-nowrap text-gris-30">
                                        {{$tag->id}}</th>

                                    <td class="px-4 py-[13px]">
                                        {{$tag->name}}</td>
                                    <td class="px-4 py-[13px]">{{$tag->description}}</td>

                                    <td class="px-4 py-[13px] flex items-center justify-center space-x-5">
                                        <button type="button" class="text-azul-50 hover:text-azul-30" wire:click="showDeleteModal({{ $tag->id }},'{{$tag->name}}','{{$tag->description}}')">
                                            <x-icons.edit></x-icons.edit>
                                        </button>
                                        <button  class="text-rojo-50 hover:text-rojo-30" wire:click="showDeleteModal({{ $tag->id }},'{{$tag->name}}','DELETE')" >
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
                        {{$tags->links('vendor.livewire.nubesita')}}
                    </div>
                </div>
            </div>

        <x-dialog-modal wire:model="showModal">
            <x-slot name="title">
              {{$which == 'DELETE' ? 'Confirmar Eliminación' :  ($which == 'CREATE' ? 'Crear Etiqueta' : 'Editar Etiqueta') }}
            </x-slot>
            <x-slot name="content">
            @if ($which == 'DELETE')
            ¿Estás seguro de que deseas eliminar la etiqueta "<b>{{$name}}</b>"?
            @else

                <div class="m-4">
                    <x-label class="my-2">Nombre</x-label>
                    <x-input placeholder="Nombre" wire:model="name" name="name" value="{{$name}}" class="w-full"></x-imput>
                        @error('name')
                        <div class="text-corp-10 ml-2"> {{ $message }}</div>
                    @enderror
                </div>
                <div class="m-4">
                    <x-label class="my-2">Descripción</x-label>
                    <x-input-textarea placeholder="Descripción" wire:model="which" name="description" col="4">
                        {{$which}}
                    </x-imput-textarea>

                </div>

            @endif
            </x-slot>

            <x-slot name="footer">
                <x-button.corp_secundary  wire:click="$toggle('showModal')" wire:loading.attr="disabled">
                    {{ __('Cancelar') }}
                </x-button.corp_secundary>

                <x-button.corp1 class="ml-3" wire:click="delete({{$itemIdToDelete}})" wire:loading.attr="disabled">
                    {{ $which == 'DELETE' ? 'Eliminar' : 'Actualizar'}}
                </x-button.corp1>
            </x-slot>
        </x-dialog-modal>

    </section>

</div>
