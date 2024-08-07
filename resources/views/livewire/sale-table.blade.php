<div class="bg-white dark:bg-gris-80 overflow-hidden shadow-xl sm:rounded-lg h-fit">
<div>
    <section >
        <div class="w-full">
            <!-- Start coding here -->
            <div class="relative shadow-md sm:rounded-lg overflow-auto bar">
                <div class="flex mt-[20px] ">
                    <div class="mx-auto space-x-2">
                    <button class="bg-primary hover:bg-gris-70 text-gris-10 hover:text-white hover:border-white py-[2px] rounded-full transition duration-150 border-[1px] border-gris-10 whitespace-nowrap w-[100px] h-[24px] text-[12px]">
                       Sin pagar
                    </button>
                    <button class="dark:hover:bg-azul-30/10 hover:dark:text-azul-10 dark:text-azul-30  hover:dark:border-azul-10 py-[2px] rounded-full transition duration-150 border-[1px] border-azul-30 whitespace-nowrap w-[100px] h-[24px] text-[12px]">
                        Pagado
                    </button>
                    <button class="dark:hover:bg-morado-30/10  hover:dark:text-morado-10 dark:text-morado-30  hover:dark:border-morado-10 py-[2px] rounded-full transition duration-150 border-[1px] border-morado-30 whitespace-nowrap w-[100px] h-[24px] text-[12px]">
                        En proceso
                    </button>
                    <button class="dark:hover:bg-amarillo-30/10  hover:dark:text-amarillo-10 dark:text-amarillo-30  hover:dark:border-amarillo-10 py-[2px] rounded-full transition duration-150 border-[1px] border-amarillo-30 whitespace-nowrap w-[100px] h-[24px] text-[12px]">
                        En camino
                    </button>
                    <button class="dark:hover:bg-verde-30/10  hover:dark:text-verde-10 dark:text-verde-30  hover:dark:border-verde-10 py-[2px] rounded-full transition duration-150 border-[1px] border-verde-30 whitespace-nowrap w-[100px] h-[24px] text-[12px]">
                        Entregado
                    </button>
                    <button class="dark:hover:bg-rojo-30/10  hover:dark:text-rojo-10 dark:text-rojo-30  hover:dark:border-rojo-10 py-[2px] rounded-full transition duration-150 border-[1px] border-rojo-30 whitespace-nowrap w-[100px] h-[24px] text-[12px]">
                        Cancelado
                    </button>
                </div>
                </div>
                <div class="flex items-center justify-between">

                    <div class="flex w-full m-[20px]">

                        <button class="h-[30px] text-white px-1 bg-corp-50 hover:bg-corp-70 rounded-lg overflow-hidden flex items-center justify-center mx-[5px]" wire:click="showNewModal()">
                            <div class="flex items-center justify-center mx-[10px]">
                            <x-icons.plus class="h-[12px] w-[12px] fill-white mx-[3px]" grosor="1"></x-icons.plus>

                            <div class="text-center text-[12px] font-inter font-normal leading-4 whitespace-normal my-[4px] mx-[10px]">
                                NUEVO
                            </div>
                          </div>
                        </button>
                        <button class="h-[30px] text-gris-20  px-4 bg-gris-70 hover:bg-gris-60 rounded-lg overflow-hidden flex items-center justify-center mx-[5px]">

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
                                    class="absolute left-0 mt-2 w-40 rounded-md bg-gris-70 shadow-md dark:text-gris-20"
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
                        </div>
                        <x-specials.search />
                    </div>
                </div>
                <div class="">
                    <table class="w-full text-center   dark:text-gris-30">
                        <thead class="text-[16px] text-gris-20  bg-gris-70 ">
                            <tr>
                                <th scope="col" class="px-4 py-[13px] font-normal" >N° de venta</th>
                                <th scope="col" class="px-4 py-[13px] font-normal" wire:click="setSortBy('created_at')">Fecha de venta</th>
                                <th scope="col" class="px-4 py-[13px] font-normal cursor-pointer" wire:click="setSortBy('name')">
                                    Cliente
                                    </th>
                                <th scope="col" class="px-4 py-[13px] font-normal cursor-pointer" wire:click="setSortBy('total')">Total</th>
                                <th scope="col" class="px-4 py-[13px] font-normal cursor-pointer" wire:click="setSortBy('updated_at')">Fecha de actualización</th>
                                <th scope="col" class="w-[123px] py-[13px] font-normal cursor-pointer" wire:click="setSortBy('state')">Estados</th>
                                <th scope="col" class="px-4 py-[13px] font-normal text-center">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-[14px] ">
                            @foreach ($sales as $sale)

                            <tr wire:key="{{$sale->id}}" class="border-b dark:border-gris-70 dark:hover:bg-gris-70 dark:hover:bg-opacity-[25%] px-[140px]">
                                <th scope="row"
                                    class="px-4 py-[13px] font-medium text-gray-900 whitespace-nowrap dark:text-gris-30">
                                    {{$sale->id}}</th>
                                <td class="px-4 py-[13px]">
                                        {{ now()->parse($sale->created_at)->format('d/m/Y h:ia') }}
                                </td>
                                <td class="px-4 py-[13px] ">
                                    {{$sale->name.' '.$sale->last_name}}</td>
                                    <td class="px-4 py-[13px] ">
                                        {{$sale->total}}</td>
                                <td class="px-4 py-[13px] ">
                                    {{ now()->parse($sale->updated_at)->format('d/m/Y h:ia') }}  </td>

                                <td class="px-4 py-[13px]" wire:ignore>

                                   <x-dropdown.dropdown status="{{ $sale->convert() }}" id="{{ $sale->id }}"/>
                                </td>
                                <td class="px-4 py-[13px] ">
                                    <a href="{{ route('sale.show',$sale->id) }}" wire:navigate class="text-verde-50 hover:text-verde-30 cursor-pointer flex justify-center">
                                        <x-icons.eye class="h-5 w-5"></x-icons.eye>
                                    </a>
{{--                                      <button  class="text-rojo-50 hover:text-rojo-30" wire:click="showDeleteModal('{{ $sale->id }}','                                      {{$sale->name}}','{{ $sale->hex }}','{{ $sale->code }}','{{ asset('storage/'.($sale->images->url ?? '')) }}')" >
                                        <x-icons.trash class="h-5 w-5"></x-icons.trash>
                                    </button>  --}}
                                </td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="py-[20px] mx-[20px]">
                    <div class="flex ">
                        <x-specials.select perPage="{{ $perPage }}"/>
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
        <p>Estas seguro de actualizar el proceso a <b>"{{ $state_name }}"</b> </p>

        <x-elements.progress-bar step="{{ $step }}" />
    </x-slot>

    <x-slot name="footer">
        <x-button.corp_secundary wire:click="$toggle('showModal')" wire:loading.attr="disabled">Cancelar</x-button.corp_secundary>
        <x-button.corp1 wire:click="update_state()" wire:loading.attr="disabled">Aceptar</x-button.corp1>

    </x-slot>
</x-dialog-modal>
</div>
