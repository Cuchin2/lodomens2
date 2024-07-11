<div class="col-span-3 space-y-3">
    <div class="bg-gris-100 w-full">
        <div class="flex justify-between px-4 py-2 rounded-[3px] items-center">
            <h6>Direcciones</h6>
            <x-button.webprimary wire:click="modal('CREATE','','')" class="ml-auto scale-[0.80]">Nueva dirección
            </x-button.webprimary>

        </div>
    </div>
    @php
    $get= App\Models\Address::where('user_id',auth()->user()->id)->get() ?? '';
    $get2= App\Models\Address::where(['user_id'=>auth()->user()->id,'current'=>1])->first()->name ?? '';
    @endphp
    <div x-data="{check:'{{ $get2 }}', open:'', address: {{ $get }}, getdata(){
        axios.get('/get/prueba/')
    .then(response => {
        this.address= response.data.get;
        this.check=response.data.get2;
    })
    .catch(error => {
        console.error(error);
    });
    }
    }" class="space-y-3" @ad.window="getdata()">
        <template x-for="item in address" :key="item.id">
            <div class="bg-gris-100 w-full px-4 py-2 rounded-[3px]">
                <div class="flex items-center cursor-pointer" @click="open = (open === item.id) ? '' : item.id">
                    <input x-model="check" :id="item.id" :value="item.name" type="radio" class="hidden"
                        @change="$wire.hola(item.id)" />
                    <label :for="item.id" class="flex items-center cursor-pointer">
                        <span class="w-4 h-4 inline-block mr-2 rounded-full border flex-no-shrink"></span>
                        <p x-text="item.name"></p>
                    </label>
                    <x-icons.chevron-down height="10px" width="10px" grosor="1" class="ml-auto"
                        ::class="{ 'rotate-180': open === item.id }" />
                </div>
                <div class="relative grid overflow-hidden transition-all duration-300 ease-in-out"
                    :class="open == item.id ? 'grid-rows-[1fr] opacity-100' : 'grid-rows-[0fr] opacity-0'">
                    <div class="overflow-hidden">
                        <hr class="border-gris-70 absolute left-[-16px] right-[-16px] mt-2">
                        <div class="p-8 flex justify-between items-center">
                            <div>
                                <p1>Dirección:</p1>
                                <p2 x-text="item.description"></p2>
                                <p2 x-text="item.reference"></p2>
                            </div>
                            <div>
                                <div class="flex space-x-3">
                                    <x-icons.edit class="dark:text-gris-10 hover:dark:text-white cursor-pointer"
                                        @click="$wire.modal('EDIT', item.name, item.id)"></x-icons.edit>
                                    <x-icons.trash
                                        class="h-[18px] w-[18px] text-corp-50 hover:text-corp-30 cursor-pointer"
                                        @click="$wire.modal('DELETE', item.name, item.id)"></x-icons.trash>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>

    <div>


        {{-- Modal --}}
        <x-dialog-modal-web wire:model="showModal">
            <x-slot name="title">
                @switch($choise)
                @case('CREATE')
                <p>Crear nueva dirección.</p>
                @break

                @case('EDIT')
                <p>Editar dirección.</p>
                @break

                @default
                <p>Eliminar dirección.</p>
                @endswitch

            </x-slot>

            <x-slot name="content">

                @if($choise == 'DELETE')
                <div class="flex"> ¿Estás seguro de que deseas eliminar la dirección '<b>{{ $name }}</b>'</div>
                @else
                <div>
                    <div class="mb-3">
                        <x-label class="mb-2">Nombre</x-label>
                        <x-input wire:model='name' placeholder="Nombre"></x-input>
                    </div>
                    <div class="mb-3">
                        <x-label class="mb-2">Dirección</x-label>
                        <x-input wire:model='description' placeholder="Dirección"></x-input>
                    </div>
                    <div class="mb-3">
                        <x-label class="mb-2">Referencia</x-label>
                        <x-input wire:model='reference' placeholder="Referencia"></x-input>
                    </div>
                </div>
                @endif
            </x-slot>

            <x-slot name="footer">
                <x-button.corp_secundary wire:click="$toggle('showModal')" wire:loading.attr="disabled">Cancelar
                </x-button.corp_secundary>
                <x-button.corp1 wire:click="send" wire:loading.attr="disabled">
                    @switch($choise)
                    @case('CREATE')
                    Crear
                    @break

                    @case('EDIT')
                    Editar
                    @break

                    @default
                    Eliminar
                    @endswitch
                </x-button.corp1>
            </x-slot>
        </x-dialog-modal-web>

    </div>
