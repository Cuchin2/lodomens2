<div>
    <section>
        <div class="w-full">
            <div class="relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="flex items-center justify-between">
                    <div class="flex w-full m-[20px]">
                        <button class="h-[30px] text-white px-1 bg-corp-50 hover:bg-corp-70 rounded-lg overflow-hidden flex items-center justify-center mx-[5px]" wire:click="showDeleteModal('0','','CREATE')">
                            <div class="flex items-center justify-center mx-[10px]">
                                <x-icons.plus class="h-[12px] w-[12px] fill-white mx-[3px]" grosor="1"></x-icons.plus>
                                <div class="text-center text-[12px] font-inter font-normal leading-4 whitespace-normal my-[4px] mx-[10px]">
                                    NUEVA TALLA
                                </div>
                            </div>
                        </button>
                        <x-specials.search />
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-center text-gris-30">
                        <thead class="text-[16px] text-gris-20 bg-gris-70">
                            <tr>
                                <th scope="col" class="px-4 py-[13px] font-normal">N°</th>
                                <th scope="col" class="px-4 py-[13px] font-normal" wire:click="setSortBy('name')">
                                    Nombre
                                </th>
                                <th scope="col" class="px-4 py-[13px] font-normal" wire:click="setSortBy('type')">
                                    Tipo
                                </th>
                                <th scope="col" class="px-4 py-[13px] font-normal text-center">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-[14px]">
                            @foreach ($sizes as $size)
                            <tr wire:key="{{$size->id}}" class="border-b border-gris-70 hover:bg-gris-70 hover:bg-opacity-[25%] px-[140px]">
                                <th scope="row" class="px-4 py-[13px] font-medium whitespace-nowrap text-gris-30">
                                    {{$size->id}}
                                </th>
                                <td class="px-4 py-[13px]">
                                    {{$size->name}}
                                </td>
                                <td class="px-4 py-[13px]">
                                    {{$size->type ?? '—'}}
                                </td>
                                <td class="px-4 py-[13px] flex items-center justify-center space-x-5">
                                    <button type="button" class="text-azul-50 hover:text-azul-30" wire:click="showDeleteModal({{ $size->id }},'{{$size->name}}','EDIT','{{$size->type}}')">
                                        <x-icons.edit></x-icons.edit>
                                    </button>
                                    <button class="text-rojo-50 hover:text-rojo-30" wire:click="showDeleteModal({{ $size->id }},'{{$size->name}}','DELETE')">
                                        <x-icons.trash class="h-5 w-5"></x-icons.trash>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="py-[20px] mx-[20px]">
                    <div class="flex">
                        <x-specials.select perPage="{{ $perPage }}"/>
                        {{$sizes->links('vendor.livewire.nubesita')}}
                    </div>
                </div>
            </div>

            <!-- Modal de Crear/Editar/Eliminar -->
            <x-dialog-modal wire:model="showModal">
                <x-slot name="title">
                    {{$which == 'DELETE' ? 'Confirmar Eliminación' :  ($which == 'CREATE' ? 'Crear Talla' : 'Editar Talla') }}
                </x-slot>
                <x-slot name="content">
                    @if ($which == 'DELETE')
                        ¿Estás seguro de que deseas eliminar la talla "<b>{{$name}}</b>"?
                    @else
                        <div class="m-4">
                            <x-label class="my-2">Nombre de la Talla</x-label>
                            <x-input placeholder="Ej: S, M, L, 38, 40..." wire:model="name" name="name" value="{{$name}}" class="w-full"></x-input>
                            @error('name')
                                <div class="text-corp-10 ml-2"> {{ $message }}</div>
                            @enderror
                        </div>
                        <div class="m-4">
                            <x-label class="my-2">Tipo de Talla</x-label>
                            {{-- Puedes usar un select si prefieres opciones predefinidas, o un input libre como abajo --}}
                            <x-input placeholder="Ej: Letra, Número, Calzado..." wire:model="type" name="type" value="{{$type}}" class="w-full"></x-input>
                            @error('type')
                                <div class="text-corp-10 ml-2"> {{ $message }}</div>
                            @enderror
                           {{--  Ejemplo con select (comenta el input de arriba y descomenta esto si lo prefieres): --}}
{{--                             <select wire:model="type" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">Seleccione un tipo</option>
                                <option value="letter">Letra (S, M, L...)</option>
                                <option value="number">Número (38, 40...)</option>
                                <option value="shoe">Calzado (EU, US, UK)</option>
                                <option value="unique">Talla Única</option>
                                <option value="other">Otro</option>
                            </select> --}}
                    <div class="">
                    <x-label class="my-2">Opciones de Talla</x-label>
                    <x-select wire:model="type" class="w-full">
                        <option value="">Seleccione un tipo</option>
                        <option value="Letra">Letra (S, M, L...)</option>
                        <option value="Número">Número (38, 40...)</option>
                        <option value="Calzado">Calzado (EU, US, UK)</option>
                        <option value="Unico">Talla Única</option>
                        <option value="Otro">Otro</option>
                    </x-select>
                    @error('type')
                        <div class="text-corp-10 ml-2">{{ $message }}</div>
                    @enderror
                    </div>
                        </div>
                    @endif
                </x-slot>

                <x-slot name="footer">
                    <x-button.corp_secundary wire:click="$toggle('showModal')" wire:loading.attr="disabled">
                        {{ __('Cancelar') }}
                    </x-button.corp_secundary>

                    @if($which == 'DELETE')
                        <x-button.corp1 class="ml-3" wire:click="delete({{$itemIdToDelete}})" wire:loading.attr="disabled">
                            Eliminar
                        </x-button.corp1>
                    @else
                        <x-button.corp1 class="ml-3" wire:click="save" wire:loading.attr="disabled">
                            {{ $which == 'CREATE' ? 'Crear' : 'Actualizar'}}
                        </x-button.corp1>
                    @endif
                </x-slot>
            </x-dialog-modal>
        </div>
    </section>
</div>
