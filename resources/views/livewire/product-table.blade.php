<div>
    <section>
        <div class="w-full">
            <!-- Start coding here -->
            <div class="relative shadow-md sm:rounded-lg overflow-auto bar">
                <div class="flex items-center justify-between">
                    <div class="flex w-full m-[20px]">
                        <div class="">
                            <button
                                class="h-[30px] text-white px-1 bg-corp-50 hover:bg-corp-70 rounded-lg overflow-hidden flex items-center justify-center mx-[5px]"
                                wire:click='showCreateModal()'>
                                <div class="flex items-center justify-center mx-[10px]">
                                    <x-icons.plus class="h-[12px] w-[12px] fill-white mx-[3px]" grosor="1">
                                    </x-icons.plus>

                                    <div
                                        class="text-center text-[12px] font-inter font-normal leading-4 whitespace-normal my-[4px] mx-[10px]">
                                        NUEVO
                                    </div>
                                </div>
                            </button>

                            <x-button.corp_secundary wire:click="resetSelectors" class="rounded-lg mt-2 mx-2">Reiniciar
                            </x-button.corp_secundary>
                        </div>
                        <div class="text-gris-20 flex space-x-2">
                            <div>
                                <x-label class="ml-2 mb-2"> Categorias</x-label>
                                <x-select-search placeholder="Selecciona un categoría" altura="250px" set="1"
                                    livewire="true" message="Ninguna categoría coincide con la búsqueda" name="status"
                                    :data="$categories" selected="">
                                </x-select-search>
                            </div>
                            <div>
                                <x-label class="ml-2 mb-2"> Materiales</x-label>
                                <x-select-search placeholder="Selecciona un material" altura="250px" set="2"
                                    livewire="true" message="Ningun material coincide con la búsqueda" name="status"
                                    :data="$materials" selected="" />
                            </div>
                            <div>
                                <x-label class="ml-2 mb-2"> Tipo</x-label>
                                <x-select-search placeholder="Selecciona un tipo" altura="250px" set="4"
                                    livewire="true" message="Ningun tipo coincide con la búsqueda" name="status"
                                    :data="$typess" selected="" />
                            </div>
                            <div>
                                <x-label class="ml-2 mb-2">Estados</x-label>
                                <x-select-search placeholder="Selecciona un estado" altura="250px" set="3"
                                    livewire="true" message="Ningun estado coincide con la búsqueda" name="status"
                                    :data="$product_states" selected="">
                            </div>

                            </x-select-search>




                        </div>
                    </div>

                    <div class="ml-auto">
                        <x-specials.search class="!w-[150px]" />
                    </div>
                </div>
            </div>
            <div>
                <table class="w-full text-center text-gris-30">
                    <thead class="text-[16px] text-gris-20  bg-gris-70 ">
                        <tr>
                            <th scope="col" class="px-4 py-[13px] font-normal">N°</th>
                            <th scope="col" class="px-4 py-[13px] font-normal w-[100px]">Imagen</th>
                            <th scope="col" class="px-4 py-[13px] font-normal cursor-pointer"
                                wire:click="setSortBy('name')">
                                Nombre
                            </th>
                            <th scope="col" class="px-4 py-[13px] font-normal">Categoría</th>
                            <th scope="col" class="px-4 py-[13px] font-normal">Material</th>
                            <th scope="col" class="px-4 w-[123px] py-[13px] font-normal cursor-pointer"
                                wire:click="setSortBy('status')">Estado</th>
                            <th scope="col" class="px-4 py-[13px] font-normal cursor-pointer"
                                wire:click="setSortBy('type_id')">
                                Tipo
                            </th>
                            <th scope="col" class="px-4 py-[13px] font-normal text-center">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-[14px] ">
                        @foreach ($products as $key0 => $product)
                        <tr wire:key="{{$product->id}}"
                            class="border-b border-gris-70 hover:bg-gris-70 hover:bg-opacity-[25%] px-[140px]">
                            <th scope="row" class="px-4 py-[13px] font-medium  whitespace-nowrap text-gris-30">
                                {{$product->id}}</th>
                            @php
                            $colorSelect = $product->colors()->select('name', 'hex',
                            'colors.id')->get()->map(function ($color) {
                            return (object) ['name' => $color->name, 'hex' => $color->hex, 'id' => $color->id];
                            }); $imagenes = [];
                            foreach ($colorSelect as $key => $color) {
                            $imagenes2 = $product->images()->where('color_id',$color->id)->join('row_image',
                            'images.id', '=', 'row_image.image_id')
                            ->join('rows', 'rows.id', '=', 'row_image.row_id')
                            ->orderBy('rows.order', 'asc')->get();
                            $imagenes[$key]= $imagenes2; }
                            if($imagenes) {
                            $firstImage[$key0] = $imagenes[0]->first();
                            }
                            @endphp
                            <th scope="row" class="px-4 py-[13px] font-medium  whitespace-nowrap text-gris-30" x-data="{
                                        imageUrl: '{{ asset('storage/'.($firstImage[$key0]->url ?? 'image/dashboard/No_image_dark.png'))}}',
                                        isVideo: false,
                                        checkextension() {
                                        const extension = this.imageUrl.split('.').pop().toLowerCase();
                                        const videoExtensions = ['mp4', 'webm', 'mov','avi'];
                                        this.isVideo = videoExtensions.includes(extension);
                                           },
                                           }


                                        " x-init="checkextension()">
                                <template x-if="isVideo">
                                    <video
                                        src="{{ asset('storage/'.($firstImage[$key0]->url ?? 'image/dashboard/No_image_dark.png'))}}"
                                        class="{{ isset($firstImage[$key0]->url) ? 'border-[1px] border-gris-50' : 'border-[1px] border-gris-50'}} rounded-[3px] h-[40px] w-[40px] flex mx-auto"
                                        controls>
                                </template>
                                <template x-if="!isVideo">
                                    <img src="{{ asset('storage/'.($firstImage[$key0]->url ?? 'image/dashboard/No_image_dark.png'))}}"
                                        class="{{ isset($firstImage[$key0]->url) ? 'border-[1px] border-gris-50' : 'border-[1px] border-gris-50'}} rounded-[3px] h-[40px] w-[40px] flex mx-auto"
                                        alt="">
                                </template>
                            </th>
                            <td class="px-4 py-[13px] ">
                                {{$product->name}}</td>
                            <td class="px-4 py-[13px] ">
                                {{$product->category->name}}</td>
                            <td class="px-4 py-[13px] ">
                                {{$product->material->name ?? 'N/A'}}</td>
                            <td class="px-4 py-[13px]" wire:ignore>

                                <x-dropdown.dropdownproduct status="{{ $product->status() }}" id="{{ $product->id }}"
                                    name="{{$product->name}}" />
                            </td>
                            </td>
                            <td class="px-4 py-[13px]" wire:ignore>
                                <x-dropdown.dropdowntype :type="$product->type" :types="$types" :id="$product->id"
                                    :nameproduct="$product->name" />
                            </td>
                            <td class="px-4 py-[13px] flex items-center justify-center space-x-5 h-[63px]">

                                <a class="text-azul-50 hover:text-azul-30"
                                    href="{{route('inventory.products.edit',$product->slug)}}">
                                    <x-icons.edit></x-icons.edit>
                                </a>
                                <button class="text-rojo-50 hover:text-rojo-30"
                                    wire:click="showDeleteModal('{{ $product->id }}','{{$product->name}}')">
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
                    <x-specials.select perPage="{{ $perPage }}" />
                    {{$products->links('vendor.livewire.nubesita')}}
                </div>
            </div>
        </div>
</div>
<x-dialog-modal wire:model="showModal">
    <x-slot name="title">
        {{ $change2 == 'STATUS' ? 'Confirmar cambio de estado': ( $change2 == 'STOP'? 'Advertencia' : 'Confirmar
        Eliminación') }}
    </x-slot>

    <x-slot name="content">

        @if($change2 == 'STATUS')
        ¿Estás seguto de cambiar el estado del producto"<b>{{$itemName}}</b>" <br>
        <div class="flex space-x-1 mt-2">
            <p>De</p>
            <p class="text-{{ $color1 }}-10">{{ $status }}</p>
            <p>a</p>
            <p class='text-{{ $color2 }}'>{{ $status2 }}</p>
        </div>
        @elseif ($change2 == 'STOP')
        No es posible cambiar al estado <b class="text-verde-10">Publicado</b> un producto que no tenga definido
        sus parámetos.
        @else ¿Estás seguro de que deseas eliminar el producto "<b>{{$itemName}}</b>"? @endif



    </x-slot>

    <x-slot name="footer">
        <x-button.corp_secundary wire:click="$toggle('showModal')" wire:loading.attr="disabled">{{ $change2 ==
            'STOP' ? 'Ok' : 'Cancelar'}}</x-button.corp_secundary>
        @if($change2 !== 'STOP')
        <x-button.corp1 wire:click="delete('{{$itemIdToDelete}}')" wire:loading.attr="disabled">Aceptar
        </x-button.corp1>
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
                    message="Ninguna categoría coincide con la búsqueda" name="category_id" :data="$categories"
                    selected="{{ $category_nuevo ?? ''}}">
                </x-select-search2>
                @error('category_id')
                <div class="text-corp-10 ml-2"> {{ $message }}</div>
                @enderror
            </div>
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-button.corp_secundary wire:click="$toggle('showModalCreate')" wire:loading.attr="disabled">Cancelar
        </x-button.corp_secundary>
        <x-button.corp1 wire:click="create('{{$name}}')" wire:loading.attr="disabled">Crear</x-button.corp1>

    </x-slot>
</x-dialog-modal>
<x-dialog-modal wire:model="showModalTipo">
    <x-slot name="title">
        Cambiar Tipo de producto
    </x-slot>

    <x-slot name="content">

        ¿Estás seguto de cambiar el estado del producto <b>{{ $product_name }}</b> de </br> <b
            style="color:{{ $tipo_old_hex}}">"{{$tipo_name}}"</b> a <b
            style="color:{{ $tipo_hex }}">"{{$tipo_new_name}}"</b> <br>

    </x-slot>

    <x-slot name="footer">
        <x-button.corp_secundary wire:click="$toggle('showModalTipo')" wire:loading.attr="disabled">Cancelar
        </x-button.corp_secundary>
        @if($change2 !== 'STOP')
        <x-button.corp1 wire:click="change_tipo()" wire:loading.attr="disabled">Aceptar</x-button.corp1>
        @endif
    </x-slot>
</x-dialog-modal>
</section>

</div>
