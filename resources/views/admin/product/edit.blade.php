<x-app-layout>

    <x-slot name="slot1">
        <x-breadcrumb.title title='Editar producto "{{$product->name}}"' />
        <x-breadcrumb.breadcrumb>
            <x-breadcrumb.breadcrumb2 href="{{route('inventory.products.index')}}" name='Productos' />
            <x-breadcrumb.breadcrumb2 name='{{$product->name}}' />
        </x-breadcrumb.breadcrumb>
    </x-slot>
    <x-slot name="slot2"> @if (session()->has('info'))
        <div x-data="{ open: true }" x-show="open" x-init="setTimeout(() => open = false, 2000)" :class="!open"
            x-collapse class="mb-[20px]">
            <div
                class="items-center flex rounded-lg border border-green-600 bg-green-900 bg-opacity-20 py-2 px-2 text-green-600 sm:px-5 text-[12px]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                        clip-rule="evenodd" />
                </svg>
                <p class="mx-1 ">{{session()->get('info')}}</p>
            </div>

        </div>

        @endif
        <form method="POST" action="{{ route('inventory.products.update', $product) }}" name="formulario"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-12 gap-6 sm:gap-6 lg:gap-6" id="miDiv">

                <div class="col-span-12 lg:col-span-8 bg-white dark:bg-gris-80 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="mx-auto max-w-screen-xl px-4 py-4 lg: ">

                        <div class="my-3">
                            <x-label class="mb-2">Nombre:</x-label>
                            <x-input name="name" value="{{ old('name',$product->name) }}" placeholder="Primer nombre "></x-input>
                        </div>
                        <div class="my-1 flex">
                            <div class="flex items-center space-x-2 mr-1">
                                <x-label class="my-2">URL:</x-label>
                                <p class="text-gris-40 text-[14px]">ecowaste.nubesita.com/blog/</p>
                            </div>
                            <x-input-editable name="slug" value="{{old('slug',$product->slug)}}"></x-input-editable>
                        </div>
                        <div class="my-3">
                            <x-label class="my-2">Descripción corta:</x-label>
                            <x-input-textarea placeholder="Descripción corta" name="short_description" col="3">
                                {{ old('short_description', $product->short_description) }}
                                </x-imput-textarea>
                        </div>
                        <div class="my-3">
                            <x-label class="my-2">Contenido:</x-label>
                            <textarea class="form-control" name="body" id="body" rows="10">
                            {{ old('body', $product->body) }}
                            </textarea>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 lg:col-span-4 bg-white dark:bg-gris-80 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="mx-auto max-w-screen-xl px-4 py-4 lg: ">
                        <div class="my-3">
                            <x-label class="mb-2">Estados:</x-label>
                            <div class="mt-3">
                                <x-select-search placeholder="Selecciona un estado"
                                    message="Ningun tipo coincide con la búsqueda" name="status"
                                    :data="$status" selected="{{ $product->status ?? ''}}">
                                </x-select-search>
                            </div>
                        </div>
                        <div class="my-3">
                            <x-label class="mb-2">Tipos:</x-label>
                            <div class="mt-3">
                                <x-select-search placeholder="Selecciona un tipo"
                                    message="Ningun tipo coincide con la búsqueda" name="type_id"
                                    :data="$types" selected="{{ $product->type->id ?? ''}}">
                                </x-select-search>
                            </div>
                        </div>
                        <div class="my-3">
                            <x-label class="mb-2">Marca:</x-label>
                            <div class="mt-3">
                                <x-select-search placeholder="Selecciona la marca"
                                    message="Ninguna marca coincide con la búsqueda" name="brand_id"
                                    :data="$brands" selected="{{ $product->brand->id ?? ''}}">
                                </x-select-search>
                                @error('brand_id')
                                <div class="text-corp-10 ml-2"> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="my-3" x-data="{ code: '{{ $product->code }}' }">
                            <x-label class="mb-2">Código del producto</x-label>
                            <x-input name="code" maxlength="4" x-model="code" @change="addLeadingZeros" value="{{ old('code', $product->code) }}" placeholder="Código del producto "></x-input>
                            @error('code')
                            <div class="text-corp-10 ml-2"> {{ $message }}</div>
                            @enderror
                        </div>
                        <div class="my-3">
                            {{--  <x-label class="mb-2">{{ $product->skus->count() > 1 ? 'Códigos' : 'Código' }} SKU</x-label>  --}}
                        <div class="">
                          @foreach ($product->skus->load('color') as $index =>$sku)
                          <div class="mb-4">
                            <div class="flex justify-between"><p style="color: {{ $sku->color->hex }};">{{ $sku->color->name }}</p>
                                <x-label class="mb-2 ">SKU: {{ $sku->code }}</x-label>
                            </div>
                            
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="">
                                        <x-label class="mb-2 " >Nivel de stock</x-label>
                                        <x-input name="stock[]" value="{{ old('stock.'.$index, $sku['stock']) }}" placeholder="Nivel de stock "></x-input>
                                    </div>
                                    <div class="">
                                        <x-label class="mb-2">Precio de venta</x-label>
                                        <x-input name="sell_price[]" value="{{ old('sell_price.'.$index, $sku['sell_price']) }}"
                                            placeholder="Precio de venta "></x-input>
                                    </div>
                                </div>
                         </div>
                          @endforeach
                        </div>


                        </div>
                        @if(Session::has('mensaje2'))
                        <div class="text-corp-10 ml-2"> 
                                {{ Session::get('mensaje2') }}
                            </div>
                        @endif
{{--                          <div class="my-3">
                            <x-label class="mb-2">Precio de venta</x-label>
                            <x-input name="" value="{{ $product->sell_price }}"
                                placeholder="Precio de venta "></x-input>
                        </div>  --}}
                        <div class="flex space-x-4 my-3">
                            <x-label class="mb-2">Reseñas:</x-label>
                            <x-label>{{ $product->reviews->count() }}</x-label>
                        </div>
                        <div class="flex space-x-4 my-3">
                            <x-label class="mb-2">Calificación:</x-label>
                            <p class="text-gris-30 text-[18px] font-bold">{{ $average}}</p>
                            <x-star class="w-6 h-6" star="{{ $average/5*100 }}" />
                        </div>
                        <div class="flex space-x-4 my-3">
                            <x-label class="mb-2">Visualizaciones:</x-label>
                            <x-label>{{ $product->withTotalVisitCount()->first()->visit_count_total }}</x-label>
                        </div>
                        <div class="my-3">
                            <x-label class="mb-2">Colores:</x-label>
                        </div>
                        <div class=" mb-4">
                            <x-dashboard.multipleselect
                            id="1"
                            name="colors"    
                            placeholder="Selccione los colores" 
                            :colorSelect="$colorSelect" 
                            :colorUnSelect="$colorUnSelect" />

                            @if(Session::has('mensaje'))
                            <div class="text-corp-10 ml-2"> 
                                    {{ Session::get('mensaje') }}
                                </div>
                            @endif
                             </div>
                        <div class="my-3">
                            <x-label class="mb-2">Categoría:</x-label>
                            <div class="mt-3">
                                <x-select-search placeholder="Selecciona la categoría"
                                    message="Ninguna categoría coincide con la búsqueda" name="category_id"
                                    :data="$categories" selected="{{ $product->category->id }}">
                                </x-select-search>
                            </div>
                          
                        </div>
                        <div class="my-3">
                            <x-label class="mb-2">Etiquetas:</x-label>
                        </div>

                        <div class=" mb-4">
                            <x-dashboard.multipleselectsimple 
                            id="2"
                            name="tags"
                            placeholder="Seleccione las etiquetas" 
                            :selected="$tagSelect" 
                            :unselected="$tagNames"
                             param="0"
                            />
                           
                        </div>


                    </div>



                </div>
                
                @include('admin.product.colorimage',['colors'=> $colorSelect,'id'=>$product->id,'numberArray'=>$numberArray])
                {{-- @include('admin.product.image') --}}

            </div>
            <div class="flex">
                <x-button.corp1 type="submit" class="mx-auto" @click="$dispatch('send')">Actualizar</x-button.corp1>
            </div>
        </form>

        @push('scripts')
        <script src="https://raw.githack.com/SortableJS/Sortable/master/Sortable.js"></script>
        <script data-navigate-once>


                CKEDITOR.replace('body', {
                    language: 'es',
                    height: 300,
                    resize_dir: 'vertical',
                    resize_minHeight: 300,
                    skin: 'prestige',
                });

                CKEDITOR.addCss('.cke_editable { background-color: #0E0E0E; color: white;  }');

                function addLeadingZeros() {
                    // Verificar si el valor tiene menos de 4 dígitos
                    if (this.code.length < 4) {
                      // Calcular la cantidad de ceros necesarios
                      var leadingZeros = 4 - this.code.length;

                      // Agregar los ceros a la izquierda del valor
                      this.code = '0'.repeat(leadingZeros) + this.code;
                    }
                  }
        </script>
        @endpush

        <style>
            .cke_chrome {
                border: 1px solid rgb(55 65 81);
            }

            [hidden] {
                display: none !important;
            }

            .CodeMirror {
                min-height: 30px;
                height: 100%;
            }

            .CodeMirror-line {
                min-height: 30px;
            }

            .filepond--item {
                width: calc(50% - 0.5em);
            }

            @media (min-width: 30em) {
                .filepond--item {
                    width: calc(50% - 0.5em);
                }
            }

            @media (min-width: 50em) {
                .filepond--item {
                    width: calc(33.33% - 0.5em);
                }
            }

            .filepond--drop-label {
                background: #111827 !important;
                color: #d1d5db;
            }

            .filepond--panel-root {
                background-color: #111827;
            }
        </style>

    </x-slot>

</x-app-layout>
