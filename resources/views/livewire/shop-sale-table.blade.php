<div class="bg-gris-80 overflow-hidden shadow-xl sm:rounded-lg h-fit" x-data="{ pen:false }">
   {{--  {{ dd($sales) }} --}}
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
                                    <th scope="col" class="px-4 py-[13px] font-normal select-none">N°</th>
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

                                <tr wire:key="{{$sale['id']}}" class="border-b border-gris-70 hover:bg-gris-70 hover:bg-opacity-[25%] px-[140px] @if($sale['status'] == 'cancelado') text-rojo-50 @endif">
                                    <th scope="row" class="px-4 py-[13px] font-medium  whitespace-nowrap">
                                        {{$sale['id']}}</th>
                                    <td class="px-4 py-[13px]">
                                        {{ now()->parse($sale['created_at'])->format('d/m/Y h:ia') }}
                                    </td>
                                    <td class="px-4 py-[13px] ">
                                        {{$sale['name']}}</td>
                                    <td class="px-4 py-[13px] ">
                                        {{($sale['currency'] == 'PEN' ? 'S/.' :'$ ').$sale['total']}}</td>
                                     <td class="px-4 py-[13px] ">
                                            {{$sale['user']['name']}}</td>
                                    <td class="px-4 py-[13px] ">
                                        {{ now()->parse($sale['updated_at'])->format('d/m/Y h:ia') }} </td>

                                    <td class="px-4 py-[13px]">
                            @if($sale['status'] === 'entregado')
                            <button class="hover:bg-verde-30/10  hover:text-verde-10 text-verde-30  border-verde-30 hover:border-verde-10 py-[2px] rounded-full transition duration-150 border-[1px]  whitespace-nowrap w-[100px] h-[24px] text-[12px] capitalize">
                               {{ $sale['status'] }}
                            </button>
                            @else
                            <button class="hover:bg-rojo-30/10  hover:text-rojo-10 text-rojo-30  border-rojo-30 hover:border-rojo-10 py-[2px] rounded-full transition duration-150 border-[1px]  whitespace-nowrap w-[100px] h-[24px] text-[12px] capitalize">
                                {{ $sale['status'] }}
                            </button>
                            @endif
                                    </td>
                                    <td class="px-4 py-[13px] flex justify-around">
                                        @if($sale['sale_notes'])
                                        <button class="flex space-x-1 text-azul-50 hover:text-azul-30" title="crear o ver nota"
                                        wire:click="SendNote('{{$sale['sale_notes']['name']}}','{{$sale['sale_notes']['description']}}','{{$sale['user']['name']}}')"
                                        >
                                        <x-icons.edit></x-icons.edit>
                                        </button>
                                        @endif

                                        <a href="{{ route('store.show',[$sale['id'],1]) }}" wire:navigate class="text-verde-50 hover:text-verde-30 cursor-pointer flex justify-center">
                                            <x-icons.eye class="h-5 w-5"></x-icons.eye>
                                        </a>
                                        {{-- <button  class="text-rojo-50 hover:text-rojo-30" wire:click="showDeleteModal('{{ $sale['id'] }}',' {{$sale['name']}}','{{ $sale->hex }}','{{ $sale->code }}','{{ asset('storage/'.($sale->images->url ?? '')) }}')" >
                                        <x-icons.trash class="h-5 w-5"></x-icons.trash>
                                        </button> --}}
                                    </td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="py-[20px] mx-[20px]">
                        <div class="flex">
                                        <div class="flex space-x-2 items-center">
        <div class="text-gris-30 text-[12.07px] font-inter font-normal leading-20.12">
            Mostrar
        </div>
        <div x-data="{ page: '{{ $perPage }}' }" class="flex items-center gap-7">
        <select wire:ignore
            x-model="page" @change="$wire.holabb(page)"
            :class="page == 5 ? 'pl-[11px]' : (page == 100 ? 'pl-[5px]' : 'pl-[8px]')"
            class="bg-gris-90 border-[0.5px] border-gris-70 text-gris-20 text-[12px] rounded-lg focus:ring-gris-70 focus:border-gris-70 block w-[44px] pr-[2px] py-[2px] mx-auto focus:ring-0">
            <option  value="5">5</option>
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>

        </div>
        <div class="text-gris-30 text-[12.07px] font-inter font-normal leading-20.12">
            entradas
        </div>

    </div>
                            {{-- <x-specials.select perPage="{{ $perPage }}" /> --}}
                            {{-- {{$sales->links('vendor.livewire.nubesita')}} --}}
{{-- Paginación --}}
    <x-pagination.php :links="$links" />

{{-- Fin de Paginación --}}
                        </div>
                    </div>
                </div>
            </div>

        </section>


    </div>


    <x-dialog-modal wire:model="showModal3" maxWidth="md">
        <x-slot name="title">
            Nota de cancelación de <b>"{{ $salesperson }}"</b>
        </x-slot>

        <x-slot name="content">
            <div class="m-4 flex space-x-5">
                <div class="w-full">
                <x-label class="my-2">Título</x-label>

                <p class="w-full">{{$name_note}}</p>

                </div>
            </div>
            <div class="m-4">
                <x-label class="my-2">Descripción</x-label>
                <p class="w-full">
                    {{$description_note}}
                </p>

            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex space-x-2 justify-center ">
                <x-button.corp_secundary wire:click="$toggle('showModal3')" wire:loading.attr="disabled">Cancelar</x-button.corp_secundary>
            </div>
        </x-slot>
    </x-dialog-modal>
    <x-preloader.spin />
</div>
