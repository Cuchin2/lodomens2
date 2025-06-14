<x-app-layout>

    <x-slot name="slot1">
        <x-breadcrumb.title title='Productos por tienda' />
        <x-breadcrumb.breadcrumb>

            <x-breadcrumb.breadcrumb2 name='Productos por tienda' />
        </x-breadcrumb.breadcrumb>
    </x-slot>


    <x-slot name="slot2">


        <div class="mx-auto p-4" x-data="pos()">


            <div class="grid grid-cols-1">
                <div class="p-2 col-span-1">
                    {{-- Filtro de Productos --}}
                    <div class="mb-4  bg-gris-80 shadow-xl rounded-lg p-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3  lg:grid-cols-4 gap-4">


                            <div>
                                <x-label class="my-2">Tiendas</x-label>
                                <x-select x-model="selectedStore" @change="handleStoreChange()">
                                    <option :value="-1" x-text="'Todas las tiendas'"></option>
                                    <template x-for="store in stores" :key="store.index">
                                        <option :value="store.id" x-text="store.name"></option>
                                    </template>
                                </x-select>
                                <x-label class="my-2">Nombre</x-label>
                                <x-input x-model="searchQuery" placeholder="Buscar productos ... " />


                            </div>
                            <div>
                                <x-label class="my-2">Código SKU</x-label>
                                <x-input x-model="searchSKU" placeholder="Buscar SKU ... " />
                                <x-label class="my-2">Categorias</x-label>
                                <x-select x-model="selectedCategory">
                                    <template x-for="category in categories" :key="category">
                                        <option :value="category" x-text="category"></option>
                                    </template>
                                </x-select>

                            </div>
                            <div>
                                <x-label class="my-2">Marcas</x-label>
                                <x-select x-model="selectedBrand">
                                    <template x-for="brand in brands" :key="brand">
                                        <option :value="brand" x-text="brand"></option>
                                    </template>
                                </x-select>
                                <x-label class="my-2">Colores</x-label>
                                <x-select x-model="searchColor">
                                    <template x-for="color in colors" :key="color">
                                        <option :value="color" x-text="color"></option>
                                    </template>
                                </x-select>
                            </div>
                            <div>
                                <x-label class="my-2">Materiales</x-label>
                                <x-select x-model="selectedMaterial">
                                    <template x-for="material in materials" :key="material">
                                        <option :value="material" x-text="material"></option>
                                    </template>
                                </x-select>
                                <x-label class="my-2">Tipo</x-label>
                                <x-select x-model="selectedType">
                                    <template x-for="type in types" :key="type">
                                        <option :value="type" x-text="type"></option>
                                    </template>
                                </x-select>
                            </div>
                        </div>

                        <div class="flex items-center mt-2 mb-4">
                            <label for="itemsPerPage"
                                class="mr-2 text-gris-30 text-[12.07px] font-inter font-normal leading-20.12">Items
                                por página:</label>
                            <x-select id="itemsPerPage" x-model="itemsPerPage" class="!w-10">
                                <option value="6">6</option>
                                <option value="9">9</option>
                                <option value="12">12</option>
                                <option value="16">16</option>
                                <option value="32">32</option>
                            </x-select>
                            <span class="ml-4 text-gris-30 text-[12.07px] font-inter font-normal leading-20.12">
                                Mostrando <span x-text="displayedProducts.length"></span> items de un, total de
                                <span x-text="filteredProducts.length"></span> items.
                            </span>
                        </div>
                        <!-- Reset Filters Button -->
                        <div class="flex space-x-2">
                            <x-button.corp_secundary @click="resetFilters">
                                Limpiar filtros
                            </x-button.corp_secundary>
                            <x-button.corp_secundary @click="showAllProducts">
                                <template x-if="paginar">
                                    <p>Con Paginación</p>
                                </template>
                                <template x-if="!paginar">
                                    <p>Sin Paginación</p>
                                </template>
                            </x-button.corp_secundary>

                            <x-button.corp_secundary @click="exportar">
                                Exportar Excel
                            </x-button.corp_secundary>
<div
    class="msa-wrapper border-gris-70 border bg-gris-90 text-gray-300 w-full rounded-lg shadow-sm"
    x-data="{
        listActive: false,
        options: [
            { value: 'sku', label: 'SKU' },
            { value: 'name', label: 'Nombre' },
            { value: 'stock', label: 'Stock' },
            { value: 'price', label: 'Precio' },
            { value: 'color', label: 'Color' },
            { value: 'brand', label: 'Marca' },
            { value: 'material', label: 'Material' },
            { value: 'category', label: 'Categoría' },
            { value: 'type', label: 'Tipo' }
        ],
        toggleOption(val) {
            const i = selectedColumns.indexOf(val);
            if (i > -1) selectedColumns.splice(i, 1);
            else selectedColumns.push(val);
        },
        isSelected(val) {
            return selectedColumns.includes(val);
        }
    }"
    @click.away="listActive = false"
>
    <input type="hidden" name="columns" :value="selectedColumns.join(',')" />

    <!-- Presentación de selección -->
    <div
        class="input-presentation flex flex-wrap gap-2 items-center px-3 py-2 rounded-lg cursor-pointer"
        @click="listActive = !listActive"
        :class="{'border-b border-corp-50 rounded-b-none': listActive}"
    >
        <template x-if="selectedColumns.length === 0">
            <span class="text-gris-30 text-xs">Selecciona columnas</span>
        </template>

        <template x-for="(val, idx) in selectedColumns" :key="val">
            <div class="tag-badge bg-gris-60 text-white rounded-full px-3 py-1 text-xs flex items-center relative">
                <span x-text="options.find(o => o.value === val)?.label || val"></span>
                <button
                    type="button"
                    class="ml-2 text-white/80 hover:bg-white/20 hover:text-white rounded-full px-1 py-0.5 text-xs font-semibold absolute right-0 pr-2 pl-1"
                    @click.stop="selectedColumns.splice(idx, 1)"
                >×</button>
            </div>
        </template>

        <div class="text-gris-30 ml-auto">
            <x-icons.chevron-down />
        </div>
    </div>

    <!-- Lista desplegable -->
    <ul
        class="border-t border-gris-70 bg-gris-90 rounded-b-lg text-[12px] text-gris-30"
        x-show="listActive"
        x-transition
        role="listbox"
    >
        <template x-for="option in options" :key="option.value">
            <li
                role="option"
                class="px-3 py-2 cursor-pointer capitalize hover:bg-corp-50 hover:text-white"
                :class="{ 'bg-corp-50 text-white': isSelected(option.value) }"
                @click.stop="toggleOption(option.value)"
            >
                <span x-text="option.label"></span>
            </li>
        </template>
    </ul>
</div>



{{--                             <select multiple x-model="selectedColumns" class="border rounded p-2">
                                <option value="sku">SKU</option>
                                <option value="name">Nombre</option>
                                <option value="stock">Stock</option>
                                <option value="price">Price</option>
                                <option value="color">Color</option>
                                <option value="brand">Marca</option>
                                <option value="material">Material</option>
                                <option value="category">Categoría</option>
                                <option value="type">Tipo</option>
                            </select> --}}
                        </div>
                    </div>
                    {{-- Lista de Productos --}}
                    <div class="bg-gris-80 shadow-xl rounded-lg p-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mb-4 ">
                            <template x-for="product in displayedProducts" :key="product.id">
                                <div class=" text-gris-20 bg-gris-90 rounded-lg shadow-md p-4 cursor-pointer  relative overflow-hidden"
                                    :class="{ 'add-to-cart-animation': product.animation }">
                                    <div class="product-content">
                                        <h3 class="text-lg font-semibold text-center"
                                            :class="{'line-through':product.stock == 0}" x-text="product.name"></h3>
                                        <template x-if="product.stock > 0">
                                            <div class="container rounded-[3px] border-[2px] my-2 mx-auto w-fit relative"
                                                :style="'border-color:'+product.hex">
                                                <img :src="'{{ asset('storage') }}/'+product.image" alt=""
                                                    class="w-32 h-32  ">
                                                <img class="absolute z-10 top-[7px] left-[6px]"
                                                    :src="'{{ asset('storage') }}/'+product.img" alt="">
                                            </div>
                                        </template>
                                        <template x-if="product.stock == 0">
                                            <div class="rounded-[3px] border-[2px] my-2 mx-auto w-fit relative opacity-50"
                                                :style="'border-color:'+product.hex">
                                                <img :src="'{{ asset('storage') }}/'+product.image" alt=""
                                                    class="w-32 h-32">
                                                <span
                                                    class="text-gris-20 text-[10px] absolute bg-gris-90 p-2 border-[2px]   rounded-[3px] top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-center"
                                                    :style="'border-color:'+product.hex">SIN STOCK</span>
                                            </div>
                                        </template>
                                        <p x-text="'Precio: S/.' + product.price" class="font-bold"></p>
                                        <p x-text="'Stock: ' + product.stock" class="font-bold"
                                            :class="{'text-red-500':product.stock == 0}"></p>
                                        <p x-text="'Categoría: ' + product.category"></p>
                                        <p x-text="'SKU: ' + product.sku"></p>
                                        <p x-text="'Color: ' + product.color"></p>
                                        <p x-text="'Material: ' + product.material"></p>
                                        <p x-text="'Brand: ' + product.brand"></p>
                                    </div>
                                    <button @click.stop="addToCartWithAnimation(product,$event)"
                                        class="absolute top-0 left-0 w-full h-full flex items-center justify-center bg-black/30 text-white opacity-0 hover:opacity-100 transition-opacity duration-300">
                                        <img :src="'{{ asset('storage') }}/'+product.brandimg" alt=""
                                            class="w-16 h-16 rounded-full ">
                                    </button>

                                    <div x-show="product.moveToCart"
                                        class="absolute top-0 left-0 w-full h-full pointer-events-none"
                                        style="z-index: 10;">
                                        <div
                                            class="cart-animation absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-corp-50 text-white rounded-full w-12 h-12 flex items-center justify-center">
                                            +1
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                        <div class="flex justify-center mt-4">
                            <button @click="previousPage" :disabled="currentPage === 1"
                                class="px-4 py-2 -ml-px text-[12px] font-medium text-gris-30 darK:bg-gris-70 border border-gris-80 leading-5 hover:text-gris-10">Anterior</button>

                            <!-- Display first page number -->
                            <button @click="goToPage(1)"
                                :class="{ 'active px-4 py-2 -ml-px text-[12px] font-medium text-gris-10 rounded-[10px] bg-gris-70 border border-gris-80': currentPage === 1, 'px-4 py-2 -ml-px text-[12px] font-medium text-gris-30 darK:bg-gris-70 border border-gris-80 leading-5 hover:text-gris-10': currentPage !== 1 }"
                                x-text="1" x-show="totalPages > 1"></button>

                            <!-- Display "..." if there are pages before the current page -->
                            <span x-show="currentPage > 3 && totalPages > 4" class="text-gris-10 mx-2">...</span>

                            <!-- Display page numbers around the current page -->
                            <template x-for="page in visiblePages()" :key="page">
                                <button @click="goToPage(page)"
                                    :class="{ 'active px-4 py-2 -ml-px text-[12px] font-medium text-gris-10 rounded-[10px] bg-gris-70 border border-gris-80 ': currentPage === page, 'px-4 py-2 -ml-px text-[12px] font-medium text-gris-30 darK:bg-gris-70 border border-gris-80 leading-5 hover:text-gris-10': currentPage !== page }"
                                    x-text="page"></button>
                            </template>

                            <!-- Display "..." if there are pages after the current page -->
                            <span x-show="currentPage < totalPages - 2 && totalPages > 4"
                                class="text-gris-10 mx-2">...</span>

                            <!-- Display last page number -->
                            <button @click="goToPage(totalPages)"
                                :class="{ 'active px-4 py-2 -ml-px text-[12px] font-medium text-gris-10 rounded-[10px] bg-gris-70 border border-gris-80': currentPage === totalPages, 'px-4 py-2 -ml-px text-[12px] font-medium text-gris-30 darK:bg-gris-70 border border-gris-80 leading-5 hover:text-gris-10': currentPage !== totalPages }"
                                x-text="totalPages" x-show="totalPages > 1"></button>

                            <button @click="nextPage" :disabled="currentPage === totalPages"
                                class="px-4 py-2 -ml-px text-[12px] font-medium text-gris-30 darK:bg-gris-70 border border-gris-80 leading-5 hover:text-gris-10">Siguiente</button>
                        </div>
                        <div class="text-center mt-2  text-gris-30 text-[12.07px] font-inter font-normal leading-20.12">
                            <span>Página <span x-text="currentPage"></span> de <span x-text="totalPages"></span></span>
                        </div>
                    </div>

                </div>



                @push('scripts')
                <!-- SheetJS (xlsx) CDN -->
                <script src="https://cdn.sheetjs.com/xlsx-latest/package/dist/xlsx.full.min.js"></script>

                <script>
                    Alpine.data('pos', () => ({
    searchQuery: '', paginar: true,
    selectedCategory: 'All', selectedStore: 'All', stores : @json($stores),
    products: @json($skus), loading:false, allproducts: @json($skus),
    cart: [], validations:{}, order:'', totalmodal:'', productosDiponibles:[],
    checkoutComplete: false, selectedStoreValue:null,
    searchSKU: '', selectedColumns: ['sku', 'name', 'stock','price'],
    searchColor: '',
    selectedMaterial: 'All',
    selectedBrand: 'All',
    selectedType: 'All',
    itemsPerPage: 6,
    currentPage: 1,
    handleStoreChange(){
        if(this.selectedStore > 0) {
axios.get('/api/stores/'+this.selectedStore+'/skus') // Reemplaza '/api/datos' con tu URL
                    .then(response => {
                        this.products= response.data.skus;
                                    })
                    .catch(error => {

                    });}
                    else {
                        this.products=this.allproducts;
                    }
                    this.resetFilters();
    },
    get categories() {
      let cats = ['All', ...new Set(this.products.map(product => product.category))];

      if (this.searchQuery) {
        cats = ['All', ...new Set(this.products.filter(product => product.name.toLowerCase().includes(this.searchQuery.toLowerCase())).map(product => product.category))];
      }

      if (this.searchSKU) {
        cats = ['All', ...new Set(this.products.filter(product => product.sku.toLowerCase().includes(this.searchSKU.toLowerCase())).map(product => product.category))];
      }

      if (this.searchColor && this.searchColor !== 'All Colors') {
        cats = ['All', ...new Set(this.products.filter(product => product.color === this.searchColor).map(product => product.category))];
      }

      if (this.selectedMaterial && this.selectedMaterial !== 'All') {
        cats = ['All', ...new Set(this.products.filter(product => product.material === this.selectedMaterial).map(product => product.category))];
      }

      if (this.selectedBrand && this.selectedBrand !== 'All') {
        cats = ['All', ...new Set(this.products.filter(product => product.brand === this.selectedBrand).map(product => product.category))];
      }

      if (this.selectedType && this.selectedType !== 'All') {
        cats = ['All', ...new Set(this.products.filter(product => product.type === this.selectedType).map(product => product.category))];
      }
      return cats;
    },

    get materials() {
      let materials = ['All', ...new Set(this.products.map(product => product.material))];

      if (this.searchQuery) {
        materials = ['All', ...new Set(this.products.filter(product => product.name.toLowerCase().includes(this.searchQuery.toLowerCase())).map(product => product.material))];
      }

      if (this.searchSKU) {
        materials = ['All', ...new Set(this.products.filter(product => product.sku.toLowerCase().includes(this.searchSKU.toLowerCase())).map(product => product.material))];
      }

      if (this.searchColor && this.searchColor !== 'All Colors') {
        materials = ['All', ...new Set(this.products.filter(product => product.color === this.searchColor).map(product => product.material))];
      }

      if (this.selectedCategory && this.selectedCategory !== 'All') {
        materials = ['All', ...new Set(this.products.filter(product => product.category === this.selectedCategory).map(product => product.material))];
      }

      if (this.selectedBrand && this.selectedBrand !== 'All') {
        materials = ['All', ...new Set(this.products.filter(product => product.brand === this.selectedBrand).map(product => product.material))];
      }

      if (this.selectedType && this.selectedType !== 'All') {
        materials = ['All', ...new Set(this.products.filter(product => product.type === this.selectedType).map(product => product.material))];
      }
      return materials;
    },

    get brands() {
      let brands = ['All', ...new Set(this.products.map(product => product.brand))];

      if (this.searchQuery) {
        brands = ['All', ...new Set(this.products.filter(product => product.name.toLowerCase().includes(this.searchQuery.toLowerCase())).map(product => product.brand))];
      }

      if (this.searchSKU) {
        brands = ['All', ...new Set(this.products.filter(product => product.sku.toLowerCase().includes(this.searchSKU.toLowerCase())).map(product => product.brand))];
      }

      if (this.searchColor && this.searchColor !== 'All Colors') {
        brands = ['All', ...new Set(this.products.filter(product => product.color === this.searchColor).map(product => product.brand))];
      }

      if (this.selectedCategory && this.selectedCategory !== 'All') {
        brands = ['All', ...new Set(this.products.filter(product => product.category === this.selectedCategory).map(product => product.brand))];
      }

      if (this.selectedMaterial && this.selectedMaterial !== 'All') {
        brands = ['All', ...new Set(this.products.filter(product => product.material === this.selectedMaterial).map(product => product.brand))];
      }

      if (this.selectedType && this.selectedType !== 'All') {
        brands = ['All', ...new Set(this.products.filter(product => product.type === this.selectedType).map(product => product.brand))];
      }
      return brands;
    },

    get colors() {
      let colors = ['All Colors', ...new Set(this.products.map(product => product.color))];

      if (this.searchQuery) {
        colors = ['All Colors', ...new Set(this.products.filter(product => product.name.toLowerCase().includes(this.searchQuery.toLowerCase())).map(product => product.color))];
      }

      if (this.searchSKU) {
        colors = ['All Colors', ...new Set(this.products.filter(product => product.sku.toLowerCase().includes(this.searchSKU.toLowerCase())).map(product => product.color))];
      }

      if (this.selectedCategory && this.selectedCategory !== 'All') {
        colors = ['All Colors', ...new Set(this.products.filter(product => product.category === this.selectedCategory).map(product => product.color))];
      }

      if (this.selectedMaterial && this.selectedMaterial !== 'All') {
        colors = ['All Colors', ...new Set(this.products.filter(product => product.material === this.selectedMaterial).map(product => product.color))];
      }

      if (this.selectedBrand && this.selectedBrand !== 'All') {
        colors = ['All Colors', ...new Set(this.products.filter(product => product.brand === this.selectedBrand).map(product => product.color))];
      }

      if (this.selectedType && this.selectedType !== 'All') {
        colors = ['All Colors', ...new Set(this.products.filter(product => product.type === this.selectedType).map(product => product.color))];
      }

      return colors;
    },

    get types() {
      let types = ['All', ...new Set(this.products.map(product => product.type))];

      if (this.searchQuery) {
        types = ['All', ...new Set(this.products.filter(product => product.name.toLowerCase().includes(this.searchQuery.toLowerCase())).map(product => product.type))];
      }

      if (this.searchSKU) {
        types = ['All', ...new Set(this.products.filter(product => product.sku.toLowerCase().includes(this.searchSKU.toLowerCase())).map(product => product.type))];
      }

      return types;
    },
    get filteredProducts() {
      let products = this.products;

      if (this.searchQuery) {
        products = products.filter(product =>
          product.name.toLowerCase().includes(this.searchQuery.toLowerCase())
        );
      }

      if (this.searchSKU) {
        products = products.filter(product =>
          product.sku.toLowerCase().includes(this.searchSKU.toLowerCase())
        );
      }

      if (this.selectedCategory !== 'All') {
        products = products.filter(product => product.category === this.selectedCategory);
      }

      if (this.searchColor && this.searchColor !== 'All Colors') {
        products = products.filter(product =>
          product.color.toLowerCase().includes(this.searchColor.toLowerCase())
        );
      }

      if (this.selectedMaterial !== 'All') {
        products = products.filter(product => product.material === this.selectedMaterial);
      }

      if (this.selectedBrand !== 'All') {
        products = products.filter(product => product.brand === this.selectedBrand);
      }

      if (this.selectedType !== 'All') {
        products = products.filter(product => product.type === this.selectedType);
      }

      return products;
    },

    get totalPages() {
      return Math.ceil(this.filteredProducts.length / this.itemsPerPage);
    },

    get displayedProducts() {
      const startIndex = (this.currentPage - 1) * this.itemsPerPage;

      // Apply all filters first
      let filtered = this.filteredProducts;

      const endIndex = startIndex + parseInt(this.itemsPerPage, 10); // Ensure itemsPerPage is treated as a number
      return filtered.slice(startIndex, endIndex);
    },

    nextPage() {
      if (this.currentPage < this.totalPages) {
        this.currentPage++;
      }
    },

    previousPage() {
      if (this.currentPage > 1) {
        this.currentPage--;
      }
    },

    goToPage(page) {
      if (page >= 1 && page <= this.totalPages) {
        this.currentPage = page;
      }
    },

    visiblePages() {
      let pages = [];
      let startPage = Math.max(this.currentPage - 2, 2);
      let endPage = Math.min(this.currentPage + 2, this.totalPages - 1);

      if (this.totalPages <= 5) {
        for (let i = 2; i < this.totalPages; i++) {
          pages.push(i);
        }
      } else {
        if (this.currentPage <= 3) {
          endPage = 4;
        } else if (this.currentPage >= this.totalPages - 2) {
          startPage = this.totalPages - 3;
        }

        for (let i = startPage; i <= endPage; i++) {
          pages.push(i);
        }
      }

      return pages;
    },
exportar() {
    if (!this.selectedColumns.length) {
        alert('Debes seleccionar al menos una columna');
        return;
    }

    // Filtrar cada producto solo con las claves seleccionadas
    const filteredData = this.displayedProducts.map(producto => {
        const nuevoObjeto = {};
        this.selectedColumns.forEach(col => {
            nuevoObjeto[col] = producto[col];
        });
        return nuevoObjeto;
    });

    const ws = XLSX.utils.json_to_sheet(filteredData);
    const wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, 'Productos');
    XLSX.writeFile(wb, 'productos_filtrados.xlsx');
},
// Excel exportación

/*     reset() {
      this.cart = [];
      this.total = 0;
      this.checkoutComplete = false;
      this.currentPage = 1;
    }, */
showAllProducts() {
    this.paginar = !this.paginar;

    if (this.paginar) {
        // Volver a paginación normal
        this.itemsPerPage = "6";
    } else {
        // Mostrar todos los productos
        this.itemsPerPage = this.filteredProducts.length;
    }

    this.currentPage = 1;
},
    init() {
      this.$watch('itemsPerPage', (value) => {
        this.currentPage = 1;
      });
    },

    resetFilters() {
      this.searchQuery = '';
      this.searchSKU = '';
      this.searchColor = '';
      this.selectedCategory = 'All';
      this.selectedMaterial = 'All';
      this.selectedBrand = 'All';
      this.selectedType = 'All';
      this.currentPage = 1;
    }
  }))

                </script>
                @endpush

    </x-slot>
    @push('styles')
    <style>
        body {
            margin: 0;
            overflow-x: hidden;
            /* Hide scrollbars */
        }

        /*     .container {
      width: 200px;
      height: 200px;
      border: 1px solid #ccc;
      position: relative;
      overflow: hidden;

      margin: 20px;
    } */

        .image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Maintain aspect ratio and cover the container */
            cursor: pointer;
            position: relative;
            z-index: 1;
            transition: transform 0.3s ease;
        }

        .image:hover {
            transform: scale(1.05);
        }


        .moving-image {
            position: absolute;
            width: 200px;
            height: 200px;
            object-fit: cover;
            z-index: 1000;
            /* High z-index */
            pointer-events: none;
            /* Avoid interfering with clicks */
            border-radius: 5px;
            /* Rounded corners */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            /* Add a subtle shadow */
        }

        .image-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
    </style>
    <style>
    .msa-wrapper {
        &>* {
            display: block;
            width: 100%;
        }

        .input-presentation {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            align-items: center;
            min-height: 30px;
            padding: 0px 10px;
            border-radius: 10px;
            position: relative;
            cursor: pointer;

            &.active {
                border-bottom-left-radius: 0;
                border-bottom-right-radius: 0;
                border-color: #16AC9F;
            }

            .tag-badge {
                height: 20px;
                padding-left: 14px;
                padding-right: 28px;
                color: white;
                border-radius: 14px;
                position: relative;
                display: flex;
                align-items: center;
                justify-content: center;

                span {
                    font-size: 12px;
                    line-height: 20px;
                }

                button {
                    position: absolute;
                    right: 0px;
                    padding: 0 10px;
                    border: none;
                    background: transparent;
                    font-size: 12px;
                    color: white;
                    cursor: pointer;

                    &:hover {
                        background: rgba(255,255,255,0.2);
                    }
                }
            }
        }

        ul {
            border: 1px solid rgba(0,0,0,0.3);
            list-style: none;
            margin: 0;
            padding: 0;
            border-top: none;
            border-radius: 0 0 10px 10px;

            li {
                padding: 6px 12px;
                cursor: pointer;
                text-transform: capitalize;
            }
        }
    }
</style>
    @endpush

</x-app-layout>
