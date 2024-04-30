<div>
    <section >
        <div class="w-full">
            <!-- Start coding here -->
            <div class="relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="flex items-center justify-between">
                    <div class="flex w-full m-[20px]">

                        <button class="h-[30px] text-white px-1 bg-corp-50 hover:bg-corp-70 rounded-lg overflow-hidden flex items-center justify-center mx-[5px]" wire:click='showCreateModal()'>
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
                        <div class="relative w-[260px] ml-auto">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <x-icons.search class="w-[14px] h-[14px] text-gris-300 dark:text-gris-40" />
                            </div>
                            <input
                                wire:model.live.debounce.300ms="search"
                                type="text"
                                class="dark:bg-gris-90  border-none h-[30px] dark:text-gris-40 text-[12px] rounded-[20px] focus:ring-gris-50 focus:border-gris-50 block w-full pl-10 p-2 "
                                placeholder="Buscar" required="">
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-center   dark:text-gris-30">
                        <thead class="text-[16px] text-gris-20  bg-gris-70 ">
                            <tr>
                                <th scope="col" class="px-4 py-[13px] font-normal" >N°</th>
                                <th scope="col" class="px-4 py-[13px] font-normal w-[100px]" >Imagen</th>
                                <th scope="col" class="px-4 py-[13px] font-normal cursor-pointer" wire:click="setSortBy('name')">
                                    Nombre
                                    </th>
                                <th scope="col" class="px-4 py-[13px] font-normal cursor-pointer" wire:click="setSortBy('sell_price')">Precio</th>
                                <th scope="col" class="px-4 py-[13px] font-normal cursor-pointer" wire:click="setSortBy('stock')">Stock</th>
                                <th scope="col" class="px-4 py-[13px] font-normal cursor-pointer" wire:click="setSortBy('status')">Estado</th>
                                <th scope="col" class="px-4 py-[13px] font-normal text-center">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-[14px] ">
                            @foreach ($products as $key0 => $product)
                            <tr wire:key="{{$product->id}}" class="border-b dark:border-gris-70 dark:hover:bg-gris-70 dark:hover:bg-opacity-[25%] px-[140px]">
                                <th scope="row"
                                    class="px-4 py-[13px] font-medium text-gray-900 whitespace-nowrap dark:text-gris-30">
                                    {{$product->id}}</th>
                                    @php
                                    $colorSelect = $product->colors()->select('name', 'hex', 'colors.id')->get()->map(function ($color) {
                                        return (object) ['name' => $color->name, 'hex' => $color->hex, 'id' => $color->id];
                                    }); $imagenes = [];
                                    foreach ($colorSelect as $key => $color) {
                                        $imagenes2 = $product->images()->where('color_id',$color->id)->join('row_image', 'images.id', '=', 'row_image.image_id')
                                        ->join('rows', 'rows.id', '=', 'row_image.row_id')
                                        ->orderBy('rows.order', 'asc')->get();
                                    $imagenes[$key]= $imagenes2;     }
                                    if($imagenes) {
                                        $firstImage[$key0] = $imagenes[0]->first();
                                    }
                                    @endphp
                                    <th scope="row" class="px-4 py-[13px] font-medium text-gray-900 whitespace-nowrap dark:text-gris-30">
                                        <img src="{{ asset('storage/'.($firstImage[$key0]->url ?? ''))}}" class="border-[2px] border-corp-50 rounded-[3px] h-[40px] w-[40px] flex mx-auto" alt="">
                                      </th>
                                <td class="px-4 py-[13px] ">
                                    {{$product->name}}</td>
                                <td class="px-4 py-[13px]">S/. {{$product->sell_price}}</td>
                                <td class="px-4 py-[13px]">{{$product->stock}}
                                </td>
                                <td class="px-4 py-[13px]"><x-button.success class="mx-auto">{{$product->status}}</x-button.success>
                                </td>
                                <td class="px-4 py-[13px] flex items-center justify-center space-x-5">
                                    <a class="text-azul-50 hover:text-azul-30" href="{{route('inventory.products.edit',$product->slug)}}">
                                        <x-icons.edit></x-icons.edit>
                                    </a>
                                    <button  class="text-rojo-50 hover:text-rojo-30" wire:click="showDeleteModal('{{ $product->slug }}','{{$product->name}}')" >
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
                        <div class="flex space-x-2 items-center">
                            <div class="text-[#7A7A7A] text-[12.07px] font-inter font-normal leading-20.12">
                                Mostrar
                            </div>
                            <div class="flex items-center gap-7">
                                <select
                                wire:model.live='perPage'
                                class="bg-gris-90 border border-gris-70 text-gris-20 text-[12px] rounded-lg focus:ring-gris-50 focus:border-gris-50 block w-[44px] pl-[3px] pr-[2px] py-[2px] ">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            </div>
                            <div class="text-[#7A7A7A] text-[12.07px] font-inter font-normal leading-20.12">
                                entradas
                            </div>
                        </div>
                        {{$products->links('vendor.livewire.nubesita')}}
                    </div>
                </div>
            </div>
        </div>
        <x-dialog-modal wire:model="showModal">
            <x-slot name="title">
                Confirmar Eliminación
            </x-slot>

            <x-slot name="content">
                ¿Estás seguro de que deseas eliminar el producto "<b>{{$itemName}}</b>"?
            </x-slot>

            <x-slot name="footer">
                <x-button.corp_secundary wire:click="$toggle('showModal')" wire:loading.attr="disabled">Cancelar</x-button.corp_secundary>
                <x-button.corp1 wire:click="delete('{{$itemIdToDelete}}')" wire:loading.attr="disabled">Eliminar</x-button.corp1>

            </x-slot>
        </x-dialog-modal>
        <x-dialog-modal wire:model="showModalCreate">
            <x-slot name="title">
                Crear Producto
            </x-slot>

            <x-slot name="content">
                <div class="grid grid-cols-2 gap-4">
                <div class="my-3 flex space-x-5">
                    <div>
                    <x-label class="mb-2">Nombre</x-label>
                    <x-input name="name" wire:model="name" placeholder="Nombre del producto "></x-input>
                    @error('name')
                        <div class="text-corp-10 ml-2"> {{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <x-label class="mb-2">Código</x-label>
                    <x-input name="code" wire:model="code" placeholder="Código del producto "></x-input>
                    @error('code')
                        <div class="text-corp-10 ml-2"> {{ $message }}</div>
                    @enderror
                </div>
                </div>
                <div class="my-3">
                    <x-label class="mb-2">Categoría</x-label>
                    <x-select-search2 placeholder="Selecciona la categoría"
                        message="Ninguna categoría coincide con la búsqueda" name="category_id"
                        :data="$categories" selected="">
                    </x-select-search2>
                    @error('category_id')
                        <div class="text-corp-10 ml-2"> {{ $message }}</div>
                    @enderror
                </div>
            </div>
            </x-slot>

            <x-slot name="footer">
                <x-button.corp_secundary  wire:click="$toggle('showModalCreate')" wire:loading.attr="disabled">Cancelar</x-button.corp_secundary>
                <x-button.corp1 wire:click="create('{{$name}}')" wire:loading.attr="disabled">Crear</x-button.corp1>

            </x-slot>
        </x-dialog-modal>
    </section>

</div>
