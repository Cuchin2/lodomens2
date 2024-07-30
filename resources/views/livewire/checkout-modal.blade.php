<div>
    <x-dialog-modal-web wire:model="showModal" maxWidth="sm">
        <x-slot name="title">
            <h5>{{ $select == 'SELECT' ? 'Seleccione dirección' : 'Agregar dirección' }}</h5>
        </x-slot>

        <x-slot name="content">
            @php
            $get= App\Models\Address::where('user_id',auth()->user()->id)->get() ?? '';
            $get2= App\Models\Address::where(['user_id'=>auth()->user()->id,'current'=>1])->first()->name ?? '';
            @endphp
            <div> @if($select == 'SELECT')
                @if($get->isNotEmpty())
                <p1 class="mb-2">Mis Direcciones</p1>

                <div class="rounded-[3px] border-gris-50 border-[1px] px-3 pb-3">

                    <div x-data="{check:'{{ $get2 }}', open:'', address: {{ $get }}, getdata(){
                        axios.get('/get/prueba/')
                    .then(response => {
                        this.address= response.data.get;
                        this.check=response.data.get2;
                    })
                    .catch(error => {
                        console.error(error);
                    });
                    } }" class="space-y-3"
                    @ad.window="getdata()" x-init="$wire.cambio(address[0].id);">
                        <template x-for="item in address" :key="item.id">
                            <div class="w-full rounded-[3px]">
                                <div class="flex items-center cursor-pointer" @click="open = (open === item.id) ? '' : item.id">
                                    <input x-model="check" :id="item.id" :value="item.name" type="radio" class="hidden" @change="$wire.cambio(item.id)"/>
                                        <label :for="item.id" class="flex items-center cursor-pointer">
                                        <span class="w-4 h-4 inline-block mr-2 rounded-full border flex-no-shrink"></span>
                                        <p1 x-text="item.name" class="text-white"></p1>
                                        </label>
                                </div>

                            </div>
                        </template>
                    </div>
                </div>
                @endif
                <div class="flex space-x-3 items-center mt-2 cursor-pointer hover:text-white" @click="$wire.type('CREATE')">
                    <x-icons.plus  class="h-[12px] w-[12px]  hover:fill-white"/>
                    <p1>Crear una dirección nueva</p1>
                </div>
                @else
                    <p1 class="mb-2">Crear nueva dirección</p1>
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
                @endif
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-button.corp_secundary wire:click="$toggle('showModal'); $wire.reloadd()" wire:loading.attr="disabled">Cancelar</x-button.corp_secundary>
            <x-button.corp1 wire:click="hola()" wire:loading.attr="disabled">
                    Enviar
            </x-button.corp1>
        </x-slot>
    </x-dialog-modal-web>
</div>
