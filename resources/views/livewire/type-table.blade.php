<div>
    <section>
        <div class="w-full">
            <!-- Start coding here -->
            <div class="relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="flex items-center justify-between">
                    <div class="flex w-full m-[20px]">

                        <button class="h-[30px] text-white px-1 bg-corp-50 hover:bg-corp-70 rounded-lg overflow-hidden flex items-center justify-center mx-[5px]" wire:click="showDeleteModal('','','CREATE','','','','')">
                            <div class="flex items-center justify-center mx-[10px]">
                            <x-icons.plus class="h-[12px] w-[12px] fill-white mx-[3px]" grosor="1"></x-icons.plus>

                            <div class="text-center text-[12px] font-inter font-normal leading-4 whitespace-normal my-[4px] mx-[10px]">
                                Nueva
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
                                    <th scope="col" class="px-4 py-[13px] font-normal" >ID</th>
                                    <th scope="col" class="px-4 py-[13px] font-normal w-[100px]" >Imagen</th>
                                    <th scope="col" class="px-4 py-[13px] font-normal" wire:click="setSortBy('name')">
                                        Nombre
                                        </th>
                                        <th scope="col" class="px-4 py-[13px] font-normal" wire:click="setSortBy('hex')">
                                            Color
                                            </th>
                                        <th scope="col" class="px-4 py-[13px] font-normal" wire:click="setSortBy('slug')">
                                            Codígo
                                            </th>
                                    <th scope="col" class="px-4 py-[13px] font-normal" wire:click="setSortBy('created_at')">Descripción</th>
                                    <th scope="col" class="px-4 py-[13px] font-normal text-center">
                                        Por defecto
                                    </th>
                                    <th scope="col" class="px-4 py-[13px] font-normal text-center">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-[14px]">
                                @foreach ($brands as $brand)
                                <tr wire:key="{{$brand->id}}" class="border-b dark:border-gris-70 dark:hover:bg-gris-70 dark:hover:bg-opacity-[25%] px-[140px]">
                                    <td scope="row"
                                        class="px-4 py-[13px] font-medium text-gray-900 whitespace-nowrap dark:text-gris-30">
                                        {{$brand->id}}</td>

                                    <td class="px-4 py-[13px]"> 
                                        <img src="{{ asset('storage/'.($brand->images->url ?? 'profile-photos/9chhwiACz6DcVlLIZ5vy8hJNU0C2vXOoaNLCswUH.png')) }}" class="border-[2px] border-corp-50 rounded-[3px] h-[40px] w-[40px] flex mx-auto" alt="">
                                    </td><td class="px-4 py-[13px]">
                                        {{$brand->name}}</td>
                                    </td>
                                    <td class="px-4 py-[13px]"> <div class="w-10 h-10 rounded-full mx-auto" style="background: {{ $brand->hex }};"></div></td>
                                        <td class="px-4 py-[13px]">
                                            {{$brand->slug}}</td>
                                    <td class="px-4 py-[13px]">{{$brand->description}}</td>
                                    <td class="px-4 py-[13px] ">
                                        <input wire:change="change('{{ $brand->id }}')"
                                         id="radio{{ $brand->id }}" type="radio" name="radio" class="hidden" {{ $brand->is_default == 1 ? 'checked' :''}}/>
                                        <label for="radio{{ $brand->id }}" class="flex items-center cursor-pointer justify-center">
                                        <span class="w-4 h-4 inline-block mr-2 rounded-full border flex-no-shrink"></span>
                                        </label>
                                    </td>

                                    <td class="px-4 py-[13px] flex items-center justify-center space-x-5">
                                        <button type="button" class="text-azul-50 hover:text-azul-30" wire:click="showDeleteModal('{{ $brand->id }}','{{$brand->name}}','DESCRIPTION','{{$brand->description}}','{{ $brand->slug }}','{{ asset('storage/'.($brand->images->url ?? '')) }}','{{ $brand->hex }}')">
                                            <x-icons.edit></x-icons.edit>
                                        </button>
                                        <button  class="text-rojo-50 hover:text-rojo-30" wire:click="showDeleteModal2('{{ $brand->id }}','{{$brand->name}}','DELETE','','','{{ asset('storage/'.($brand->images->url ?? '')) }}','')" >
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
                        {{$brands->links('vendor.livewire.nubesita')}}
                    </div>
                </div>
            </div>

        <x-dialog-modal wire:model="showModal">
            <x-slot name="title">
                {{  $which == 'CREATE' ? 'Crear tipo de producto' : 'Editar tipo de producto' }}
            </x-slot>
            <x-slot name="content">

                <div class="grid grid-cols-2">
                    <div class="m-4">
                        <x-label class="my-2">Nombre</x-label>
                        <x-input placeholder="Nombre" wire:model="name" name="name" value="{{$name}}" class="w-full"></x-imput>
                            @error('name')
                            <div class="text-corp-10 ml-2"> {{ $message }}</div>
                            @enderror
                            <x-label class="my-2">Descripción</x-label>
                    <x-input-textarea placeholder="Descripción" wire:model="description" name="description" col="4">
                        {{$description}}
                    </x-imput-textarea>
                    </div>
                    <div class="m-4">
                        <x-label class="my-2">Slug</x-label>
                        <x-input placeholder="Nombre" wire:model="slug" name="name" value="{{$slug}}" class="w-full" wire:change='codeComplete'></x-imput>
                            @error('slug')
                            <div class="text-corp-10 ml-2"> {{ $message }}</div>
                            @enderror

                            <div class=" mx-auto my-2">
                                <x-label class="mb-2">Color</x-label>
                                <input type="color" wire:model="color" id="input_choose_color" class="w-16 h-10">
                            </div>
                            @error('color')
                            <div class="text-corp-10 ml-2"> {{ $message }}</div>
                            @enderror
                            <x-label class="my-2">Logo:</x-label>
                            {{--  pruebas  --}}
                            <div class="py-3">

                            <!-- If you wish to reference an existing file (i.e. from your database), pass the url into imageData() -->
                            <div x-data="imageData('')"  class="file-input items-center">

                            <!-- Preview Image -->
                            <div class=" bg-gray-100 w-fit mx-auto">
                                <!-- Placeholder image -->
                                <div x-show="!previewPhoto" >

                                </div>
                                <!-- Show a preview of the photo -->
                                <div x-show="previewPhoto" class=" overflow-hidden bg-gris-80">
                                    <img :src="previewPhoto"
                                        alt=""
                                        class=" object-cover">
                                </div>
                                </div>

                                <div class="items-center ">
                                <!-- File Input -->
                                <div class="rounded-md shadow-sm my-4 flex">
                                    <!-- Replace the file input styles with our own via the label -->
                                    <input @change="updatePreview($refs)" x-ref="input"
                                        type="file" wire:model='logo'
                                        accept="image/*,capture=camera"
                                        name="photo" id="photo"
                                        class="custom">
                                    <label for="photo"
                                            class="mx-auto py-2 px-3 border border-gris-40 rounded-md text-sm leading-4 font-medium text-gris-20 hover:text-corp-50 hover:border-corp-50 focus:outline-none focus:border-corp-30 focus:shadow-outline-indigo active:bg-gray-50 active:text-indigo-800 transition duration-150 ease-in-out cursor-pointer">
                                        subir foto
                                    </label>
                                    </div>

                                    <div class="items-center text-sm text-gray-500 mx-auto"   @notify.window="previewPhoto=$event.detail.url" @notify2.window="clearPreview($refs)">
                                    <!-- Display the file name when available -->
                                    <div class=" w-fit mx-auto flex items-center">
                                    <span x-text="fileName || emptyText"></span>
                                    <!-- Removes the selected file -->
                                    <button x-show="fileName"
                                            @click="clearPreview($refs)"
                                            type="button"
                                            aria-label="Remove image"
                                            class="mx-3 mt-1">
                                        <svg viewBox="0 0 20 20" fill="currentColor" class="x-circle w-7 h-7"
                                            aria-hidden="true" focusable="false"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                                    </button>
                                        </div>
                                    </div>

                                </div>

                                </div>
                            </div>

                            {{--  fin de pruebas  --}}
                    </div>
                </div>

            </x-slot>

            <x-slot name="footer">
                <x-button.corp_secundary  wire:click="$toggle('showModal')" wire:loading.attr="disabled">
                    {{ __('Cancelar') }}
                </x-button.corp_secundary>

                <x-button.corp1 class="ml-3" wire:click="delete('{{$itemIdToDelete}}')" wire:loading.attr="disabled">
                    {{ $which == 'CREATE' ? 'Crear' : 'Actualizar' }}
                </x-button.corp1>
            </x-slot>
        </x-dialog-modal>
        <x-dialog-modal wire:model="showModalDelete">
            <x-slot name="title">
                Confirmar Eliminación
            </x-slot>
            <x-slot name="content">
                <div class="flex justify-between ">
                ¿Estás seguro de que deseas eliminar la etiqueta "<b>{{$name}}</b>"?
                <img src="{{ asset(($logo ?? '')) }}" alt="{{$name}}" class="mx-auto h-[70px]">
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-button.corp_secundary  wire:click="$toggle('showModalDelete')" wire:loading.attr="disabled">
                    {{ __('Cancelar') }}
                </x-button.corp_secundary>

                <x-button.corp1 class="ml-3" wire:click="delete('{{$itemIdToDelete}}')" wire:loading.attr="disabled">
                    Eliminar
                </x-button.corp1>
            </x-slot>
        </x-dialog-modal>
    </section>
    <style>
        input[type="file"].custom {
            border: 0;
            clip: rect(0, 0, 0, 0);
            height: 1px;
            overflow: hidden;
            padding: 0;
            position: absolute !important;
            white-space: nowrap;
            width: 1px;
          }
    </style>
    @push('scripts')
    <script>
        function imageData(url) {
            const originalUrl = url || '';
            return {
              previewPhoto: originalUrl,
              fileName: null,
              emptyText: originalUrl ? 'No se ha elegido ningún archivo nuevo' : 'Ningún archivo elegido',

              updatePreview($refs) {
                console.log('hola');
                var reader,
                    files = $refs.input.files;
                reader = new FileReader();
                reader.onload = (e) => {
                  this.previewPhoto = e.target.result;
                  this.fileName = files[0].name;
                };
                reader.readAsDataURL(files[0]);
              },
              clearPreview($refs) {
                $refs.input.value = null;
                this.previewPhoto = originalUrl;
                this.fileName = false;
              },
            };
          }

    </script>
    @endpush
</div>
