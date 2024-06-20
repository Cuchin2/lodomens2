<div>
    <section >
        <div class="w-full">
            <!-- Start coding here -->
            <div class="relative shadow-md sm:rounded-lg overflow-auto bar">
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
                        <x-specials.search />
                    </div>
                </div>
                <div>
                    <table class="w-full text-center   dark:text-gris-30">
                        <thead class="text-[16px] text-gris-20  bg-gris-70 ">
                            <tr>
                                <th scope="col" class="px-4 py-[13px] font-normal" >N°</th>
                                <th scope="col" class="px-4 py-[13px] font-normal w-[100px]" >Imagen</th>
                                <th scope="col" class="px-4 py-[13px] font-normal cursor-pointer" wire:click="setSortBy('name')">
                                    Nombre
                                    </th>

                                <th scope="col" class="px-4 w-[123px] py-[13px] font-normal cursor-pointer" wire:click="setSortBy('status')">Estado</th>
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
                                        <img src="{{ asset('storage/'.($firstImage[$key0]->url ?? 'image/dashboard/No_image_dark.png'))}}" class="{{ isset($firstImage[$key0]->url) ? 'border-[1px] border-gris-50' : 'border-[1px] border-gris-50'}} rounded-[3px] h-[40px] w-[40px] flex mx-auto" alt="">
                                      </th>
                                <td class="px-4 py-[13px] ">
                                    {{$product->name}}</td>
                                    <td class="px-4 py-[13px]" wire:ignore>

                                        <x-dropdown.dropdownproduct status="{{ $product->status() }}" id="{{ $product->id }}" name="{{$product->name}}"/>
                                     </td>
                                </td>
                                <td class="px-4 py-[13px] flex items-center justify-center space-x-5 h-[63px]">

                                    <a class="text-azul-50 hover:text-azul-30" href="{{route('inventory.products.edit',$product->slug)}}">
                                        <x-icons.edit></x-icons.edit>
                                    </a>
                                    <button  class="text-rojo-50 hover:text-rojo-30" wire:click="showDeleteModal('{{ $product->id }}','{{$product->name}}')" >
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
                        {{$products->links('vendor.livewire.nubesita')}}
                    </div>
                </div>
            </div>
        </div>
        <x-dialog-modal wire:model="showModal">
            <x-slot name="title">
                {{ $change2 == 'STATUS' ? 'Confirmar cambio de estado': ( $change2 == 'STOP'? 'Advertencia' : 'Confirmar Eliminación')  }}
            </x-slot>

            <x-slot name="content">

               @if($change2 == 'STATUS')
               ¿Estás seguto de cambiar el estado del producto "<b>{{$itemName}}</b>" <br>
               <div class="flex space-x-1 mt-2"><p>De</p> <p class="text-{{ $color1 }}-10">{{ $status }}</p> <p>a</p> <p class='text-{{ $color2 }}'>{{ $status2 }}</p></div>
               @elseif ($change2 == 'STOP')
               No es posible cambiar al estado <b class="text-verde-10">Publicado</b> un producto que no tenga definido sus parámetos.
               @else ¿Estás seguro de que deseas eliminar el producto "<b>{{$itemName}}</b>"? @endif


            </x-slot>

            <x-slot name="footer">
                <x-button.corp_secundary wire:click="$toggle('showModal')" wire:loading.attr="disabled">{{ $change2 == 'STOP' ? 'Ok' : 'Cancelar'}}</x-button.corp_secundary>
                @if($change2 !== 'STOP')
                <x-button.corp1 wire:click="delete('{{$itemIdToDelete}}')" wire:loading.attr="disabled">Aceptar</x-button.corp1>
                @endif
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
