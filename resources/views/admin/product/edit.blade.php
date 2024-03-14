<x-app-layout>

    <x-slot name="slot1">
        <x-breadcrumb.title title='Editar producto "{{$product->name}}"' />
        <x-breadcrumb.breadcrumb>
            <x-breadcrumb.breadcrumb2 href="{{route('products.index')}}" name='Productos' />
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
        <form method="POST" action="{{ route('products.update', $product) }}" name="formulario"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-12 gap-6 sm:gap-6 lg:gap-6" id="miDiv">

                <div class="col-span-12 lg:col-span-8 bg-white dark:bg-gris-80 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="mx-auto max-w-screen-xl px-4 py-4 lg: ">

                        <div class="my-3">
                            <x-label class="mb-2">Nombre:</x-label>
                            <x-input name="name" value="{{ $product->name }}" placeholder="Primer nombre "></x-input>
                        </div>
                        <div class="my-1 flex">
                            <div class="flex items-center space-x-2">
                                <x-label class="my-2">URL:</x-label>
                                <p class="text-gris-10 underline">ecowaste.nubesita.com/blog/</p>
                            </div>
                            <x-input-editable name="slug" value="{{$product->slug}}"></x-input-editable>
                        </div>
                        <div class="my-3">
                            <x-label class="my-2">Descripción corta:</x-label>
                            <x-input-textarea placeholder="Descripción corta" name="short_description" col="3">
                                {{ $product->short_description }}
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
                            <x-label class="mb-2">Nivel de stock</x-label>
                            <x-input name="stock" value="{{ $product->stock}}" placeholder="Nivel de stock "></x-input>
                        </div>
                        <div class="my-3">
                            <x-label class="mb-2">Precio de venta</x-label>
                            <x-input name="sell_price" value="{{ $product->sell_price }}"
                                placeholder="Precio de venta "></x-input>
                        </div>
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
                            <div class="msa-wrapper border-gray-700 border-[1px] dark:border-gray-700 dark:bg-gris-90 dark:text-gray-300 w-full focus:border-corp-50 dark:focus:border-corp-50 focus:ring-corp-50 dark:focus:ring-corp-50 rounded-lg shadow-sm"
                                x-data="multiselectComponent2()" x-init="
                                selectedString = selected.map(item => item.name);
                                $watch('selected', value => selectedString = value.map(item => item.name)); init();"
                                @send.window="selected = send"
                                >
                                <input x-model="selectedString" name="colors" type="text" id="msa-input2"
                                    aria-hidden="true" x-bind:aria-expanded="listActive.toString()"
                                    aria-haspopup="tag-list" hidden>
                                <div class="input-presentation" @click="listActive = !listActive"
                                    @click.away="listActive = false" x-bind:class="{ 'active': listActive }">
                                    <span class="placeholder" x-show="selected.length == 0">Selecciona los
                                        colores</span>
                                    <div id="gallery"
                                        class="flex flex-wrap gap-[6px] items-center relative cursor-pointer">
                                        <template x-for="(tag, index) in selected">
                                            <div class="tag-badge" :data-id="index"
                                                x-bind:style="`background: ${tag.hex};`">
                                                <span x-text="tag.name"></span>
                                                <button type="button" x-bind:data-index="index"
                                                    @click.stop="removeMe($event)">x</button>
                                            </div>
                                        </template>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4 dark:text-gray-500  rotate-90 ml-auto " fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                                <ul id="tag-list" x-show.transition="listActive" role="listbox">
                                    <template x-for="(tag, index, collection) in unselected">
                                        <li x-show="!selected.includes(tag.name)" x-bind:value="tag.name"
                                            x-text="tag.name" aria-role="button" @click.stop="addMe($event)"
                                            x-bind:data-index="index" role="option"></li>
                                    </template>
                                </ul>
                            </div>
                        </div>
                        <div class="my-3">
                            <x-label class="mb-2">Categoría:</x-label>
                            <div class="mt-3">
                                <x-select-search placeholder="Selecciona la categoría"
                                    message="Ninguna categoría coincide con la búsqueda" name="category_id"
                                    :data="$categories" selected="{{ $product->category->id }}">
                                </x-select-search>
                            </div>
                            {{-- <x-input name="ruc" placeholder="RUC " value="{{ optional($product->profile)->ruc }}">
                            </x-input>
                            <span class="dark:text-gris-50 text-[12px] flex m-1">Este campo es opcional</span> --}}
                        </div>
                        <div class="my-3">
                            <x-label class="mb-2">Etiquetas:</x-label>
                        </div>

                        <div class=" mb-4">
                            <div class="msa-wrapper border-gray-700 border-[1px] dark:border-gray-700 dark:bg-gris-90 dark:text-gray-300 w-full focus:border-corp-50 dark:focus:border-corp-50 focus:ring-corp-50 dark:focus:ring-corp-50 rounded-lg shadow-sm"
                                x-data="multiselectComponent()"
                                x-init="$watch('selected', value => selectedString = value.join(','))">

                                <input x-model="selectedString" name="tags" type="text" id="msa-input"
                                    aria-hidden="true" x-bind:aria-expanded="listActive.toString()"
                                    aria-haspopup="tag-list" hidden>
                                <div class="input-presentation" @click="listActive = !listActive"
                                    @click.away="listActive = false" x-bind:class="{ 'active': listActive }">
                                    <span class="placeholder" x-show="selected.length == 0">Selecciona las
                                        etiquetas</span>
                                    <template x-for="(tag, index) in selected">
                                        <div class="tag-badge" x-bind:class="{
                                                'bg-teal-600': index % 4 === 0,
                                                'bg-gray-600': index % 4 ===1,
                                                'bg-green-600': index % 4 === 2,
                                                'bg-sky-600': index % 4 === 3
                                            }">
                                            <span x-text="tag"></span>
                                            <button type="button" x-bind:data-index="index"
                                                @click.stop="removeMe($event)">x</button>
                                        </div>
                                    </template>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4 dark:text-gray-500  rotate-90 ml-auto " fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                                <ul id="tag-list" x-show.transition="listActive" role="listbox">
                                    <template x-for="(tag, index, collection) in unselected">
                                        <li x-show="!selected.includes(tag)" x-bind:value="tag" x-text="tag"
                                            aria-role="button" @click.stop="addMe($event)" x-bind:data-index="index"
                                            role="option"></li>
                                    </template>
                                </ul>
                            </div>
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
            function multiselectComponent() {

                return {
                    listActive: false,
                    selectedString: @json($tagSelect),
                    selected: @json($tagSelect),
                    unselected: @json($tagNames),
                    addMe(e) {
                        const index = e.target.dataset.index;
                        const extracted = this.unselected.splice(index, 1);
                        this.selected.push(extracted[0]);
                    },
                    removeMe(e) {
                        const index = e.target.dataset.index;
                        const extracted = this.selected.splice(index, 1);
                        this.unselected.push(extracted[0]);
                    }

                };
            }
            function multiselectComponent2() {
                return {
                    sortableList:  document.getElementById('gallery'),
                    listActive: false,
                    selectedString: @json($colorSelect),
                    selected: @json($colorSelect),
                    unselected: @json($colorUnSelect),
                    order: [],
                    send: '',
                    addMe(e) {
                        const index = e.target.dataset.index;
                        const extracted = this.unselected.splice(index, 1);
                        this.selected.push(extracted[0]);
                    },
                    removeMe(e) {
                        const index = e.target.dataset.index;
                        const extracted = this.selected.splice(index, 1);
                        this.unselected.push(extracted[0]);
                    },
                    init(){
                        Sortable.create(this.sortableList, {
                        animation: 150,
                        store:{
                            set: (sortable) => {
                            this.order = sortable.toArray().slice(1);
                                const elementos = this.selected;
                                this.send = this.order.map(index => elementos[index]);
                            }
                        }
                    });
                    },
                };
            }


                CKEDITOR.replace('body', {
                    language: 'es',
                    height: 300,
                    resize_dir: 'vertical',
                    resize_minHeight: 300,
                    skin: 'prestige',
                });

                CKEDITOR.addCss('.cke_editable { background-color: #161616; color: white;  }');


        </script>
        @endpush

        <style>
            .cke_chrome {
                border: 1px solid rgb(55 65 81);
            }

            [hidden] {
                display: none !important;
            }

            .msa-wrapper {


                &:focus-within {
                    .input-presentation {
                        border-bottom-right-radius: 0;
                        border-bottom-left-radius: 0;
                    }
                }

                &>* {
                    display: block;
                    width: 100%;
                }

                .input-presentation {
                    display: flex;
                    flex-wrap: wrap;
                    gap: 6px;
                    align-items: center;
                    min-height: 40px;
                    padding: 6px 10px 6px 12px;
                    border-radius: 10px;
                    position: relative;
                    cursor: pointer;


                    &.active {
                        border-bottom-left-radius: 0;
                        border-bottom-right-radius: 0;
                        border-color: #16AC9F;
                    }

                    .tag-badge {

                        padding-left: 14px;
                        padding-right: 28px;
                        color: white;
                        border-radius: 14px;
                        position: relative;

                        span {
                            font-size: 16px;
                            line-height: 27px;
                        }

                        button {
                            display: inline-block;
                            padding: 0;
                            -webkit-appearance: none;
                            appearance: none;
                            background: transparent;
                            border: none;
                            color: rgba(255, 255, 255, .8);
                            font-size: 12px;
                            position: absolute;
                            right: 0px;
                            padding-right: 10px;
                            padding-left: 5px;
                            cursor: pointer;
                            line-height: 26px;
                            height: 26px;
                            font-weight: 600;

                            &:hover {
                                background-color: rgba(255, 255, 255, .2);
                                color: white;
                            }
                        }
                    }
                }

                ul {
                    border: 1px solid rgba(0, 0, 0, 0.3);
                    font-size: 1rem;
                    margin: 0;
                    padding: 0;
                    border-top: none;
                    list-style: none;
                    border-bottom-right-radius: 10px;
                    border-bottom-left-radius: 10px;

                    li {
                        padding: 6px 12px;
                        text-transform: capitalize;
                        cursor: pointer;

                        &:hover {
                            background: #16AC9F;
                            color: white;
                        }
                    }
                }
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
