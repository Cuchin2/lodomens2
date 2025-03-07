<div class="bg-gris-80 overflow-hidden shadow-xl sm:rounded-lg h-fit" x-data="{ pen:false }">
    <div>
        <section>
            <div class="w-full">
                <!-- Start coding here -->
                <div class="relative shadow-md sm:rounded-lg overflow-auto bar">
                    <div class="flex my-[20px] ">
                        <div class="mx-auto space-x-2">

                            <button class="hover:bg-verde-30/10  hover:text-verde-10 text-verde-30  hover:border-verde-10 py-[2px] rounded-full transition duration-150 border-[1px] border-verde-30 whitespace-nowrap w-[100px] h-[24px] text-[12px]" wire:click="setStatus('entregado')">
                                Entregado
                            </button>
                            <button class="hover:bg-rojo-30/10  hover:text-rojo-10 text-rojo-30  hover:border-rojo-10 py-[2px] rounded-full transition duration-150 border-[1px] border-rojo-30 whitespace-nowrap w-[100px] h-[24px] text-[12px]" wire:click="setStatus('cancelado')">
                                Cancelado
                            </button>
                            <button class="bg-primary hover:bg-gris-70 text-gris-10 hover:text-white hover:border-white py-[2px] rounded-full transition duration-150 border-[1px] border-gris-10 whitespace-nowrap w-[100px] h-[24px] text-[12px]" wire:click="clearFilters()">
                                Todo
                            </button>
                        </div>
                        <x-specials.search class="!w-[200px] !mx-auto" />
                    </div>

                    <div class="">
                        <table class="w-full text-center   text-gris-30">
                            <thead class="text-[16px] text-gris-20  bg-gris-70 ">
                                <tr>
                                    <th scope="col" class="px-4 py-[13px] font-normal select-none">N° de venta</th>
                                    <th scope="col" class="px-4 py-[13px] font-normal cursor-pointer" wire:click="setSortBy('created_at')">
                                        <div class="flex justify-center items-center">
                                            <p class="flex items-center select-none hover:text-white">Fecha de venta</p>

                                            <div class="flex items-center flex-col ml-2 mt-1">
                                                <div @if($sortBy=='created_at' && $sortDir=='ASC' ) class="text-white" @endif>
                                                    <x-icons.chevron-down class="h-2 rotate-180" />
                                                </div>
                                                <div @if($sortBy=='created_at' && $sortDir=='DESC' ) class="text-white" @endif>
                                                    <x-icons.chevron-down class="h-2" @endif />
                                                </div>
                                            </div>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-4 py-[13px] font-normal cursor-pointer" wire:click="setSortBy('name')">
                                        <div class="flex justify-center items-center">
                                            <p class="flex items-center select-none hover:text-white">Cliente</p>

                                            <div class="flex items-center flex-col ml-2 mt-1">
                                                <div @if($sortBy=='name' && $sortDir=='ASC' ) class="text-white" @endif>
                                                    <x-icons.chevron-down class="h-2 rotate-180" />
                                                </div>
                                                <div @if($sortBy=='name' && $sortDir=='DESC' ) class="text-white" @endif>
                                                    <x-icons.chevron-down class="h-2" @endif />
                                                </div>
                                            </div>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-4 py-[13px] font-normal cursor-pointer" wire:click="setSortBy('total')">
                                        <div class="flex justify-center items-center">
                                            <p class="flex items-center select-none hover:text-white">Total</p>

                                            <div class="flex items-center flex-col ml-2 mt-1">
                                                <div @if($sortBy=='total' && $sortDir=='ASC' ) class="text-white" @endif>
                                                    <x-icons.chevron-down class="h-2 rotate-180" />
                                                </div>
                                                <div @if($sortBy=='total' && $sortDir=='DESC' ) class="text-white" @endif>
                                                    <x-icons.chevron-down class="h-2" @endif />
                                                </div>
                                            </div>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-4 py-[13px] font-normal select-none">Vendedor</th>
                                    <th scope="col" class="px-4 py-[13px] font-normal cursor-pointer" wire:click="setSortBy('updated_at')">
                                        <div class="flex justify-center items-center">
                                            <p class="flex items-center select-none hover:text-white">Fecha de actualización</p>

                                            <div class="flex items-center flex-col ml-2 mt-1">
                                                <div @if($sortBy=='updated_at' && $sortDir=='ASC' ) class="text-white" @endif>
                                                    <x-icons.chevron-down class="h-2 rotate-180" />
                                                </div>
                                                <div @if($sortBy=='updated_at' && $sortDir=='DESC' ) class="text-white" @endif>
                                                    <x-icons.chevron-down class="h-2" @endif />
                                                </div>
                                            </div>
                                        </div>
                                    </th>
                                    <th scope="col" class="w-[123px] py-[13px] font-normal select-none" wire:click="setSortBy('state')">Estados</th>
                                    <th scope="col" class="px-4 py-[13px] font-normal text-center">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-[14px] ">
                                @foreach ($sales as $sale)

                                <tr wire:key="{{$sale->id}}" class="border-b border-gris-70 hover:bg-gris-70 hover:bg-opacity-[25%] px-[140px]">
                                    <th scope="row" class="px-4 py-[13px] font-medium  whitespace-nowrap text-gris-30">
                                        {{$sale->id}}</th>
                                    <td class="px-4 py-[13px]">
                                        {{ now()->parse($sale->created_at)->format('d/m/Y h:ia') }}
                                    </td>
                                    <td class="px-4 py-[13px] ">
                                        {{$sale->name}}</td>
                                    <td class="px-4 py-[13px] ">
                                        {{($sale->currency == 'PEN' ? 'S/.' :'$ ').$sale->total}}</td>
                                     <td class="px-4 py-[13px] ">
                                            {{$sale->user->name}}</td>
                                    <td class="px-4 py-[13px] ">
                                        {{ now()->parse($sale->updated_at)->format('d/m/Y h:ia') }} </td>

                                    <td class="px-4 py-[13px]" wire:ignore>

                                        <x-dropdown.dropdown status="{{ $sale->status }}" id="{{ $sale->id }}" />
                                    </td>
                                    <td class="px-4 py-[13px] ">
                                        <a href="{{ route('sale.dash.show',$sale->id) }}" wire:navigate class="text-verde-50 hover:text-verde-30 cursor-pointer flex justify-center">
                                            <x-icons.eye class="h-5 w-5"></x-icons.eye>
                                        </a>
                                        {{-- <button  class="text-rojo-50 hover:text-rojo-30" wire:click="showDeleteModal('{{ $sale->id }}',' {{$sale->name}}','{{ $sale->hex }}','{{ $sale->code }}','{{ asset('storage/'.($sale->images->url ?? '')) }}')" >
                                        <x-icons.trash class="h-5 w-5"></x-icons.trash>
                                        </button> --}}
                                    </td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="py-[20px] mx-[20px]">
                        <div class="flex ">
                            <x-specials.select perPage="{{ $perPage }}" />
                            {{$sales->links('vendor.livewire.nubesita')}}
                        </div>
                    </div>
                </div>
            </div>

        </section>


    </div>
    <x-dialog-modal wire:model="showModal">
        <x-slot name="title">
            Actualización de proceso de venta
        </x-slot>

        <x-slot name="content">
            <p>Estas seguro de actualizar el proceso de <b>"{{ $state_name }}"</b> </p>

            <x-elements.progress-bar step="{{ $step }}" />
        </x-slot>

        <x-slot name="footer">
            <x-button.corp_secundary wire:click="$toggle('showModal')" wire:loading.attr="disabled">Cancelar</x-button.corp_secundary>
            <x-button.corp1 wire:click="update_state()" wire:loading.attr="disabled" @click="pen=true;">Aceptar</x-button.corp1>

        </x-slot>
    </x-dialog-modal>
    <x-dialog-modal wire:model="showModal2" maxWidth="sm">
        <x-slot name="title">
            <x-elements.success scale="0.75" />
        </x-slot>

        <x-slot name="content">
            <div class="text-center">
                <p>Se actualizó satisfactoriamente el estado a: </p>
                <p><b>"{{ $state_name }}"</b></p>
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="w-fit mx-auto">
                <x-button.corp1 wire:click="$toggle('showModal2')" wire:loading.attr="disabled">Aceptar</x-button.corp1>
            </div>
        </x-slot>
    </x-dialog-modal>
    <x-preloader.spin />
</div>
