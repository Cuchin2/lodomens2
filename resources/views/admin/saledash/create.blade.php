<x-app-layout>

    <x-slot name="slot1">
        <x-breadcrumb.title title='Registro de venta' />
        <x-breadcrumb.breadcrumb>

            <x-breadcrumb.breadcrumb2 name='Registro de venta' />
        </x-breadcrumb.breadcrumb>
    </x-slot>


    <x-slot name="slot2">


        <div class="container mx-auto p-4" x-data="pos()">


            <div class="flex ">
                <div class="w-2/3 p-2 ">
                    {{-- Filtro de Productos --}}
                    <div class="mb-4  bg-gris-80 shadow-xl rounded-lg p-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">


                            <div>
                                <x-label class="my-2">Nombre</x-label>
                                <x-input x-model="searchQuery" placeholder="Buscar productos ... " />
                                <x-label class="my-2">Código SKU</x-label>
                                <x-input x-model="searchSKU" placeholder="Buscar SKU ... " />
                                <x-label class="yb-2">Tipo</x-label>
                                <x-select x-model="selectedType">
                                    <template x-for="type in types" :key="type">
                                        <option :value="type" x-text="type"></option>
                                    </template>
                                </x-select>
                            </div>
                            <div>
                                <x-label class="my-2">Colores</x-label>
                                <x-select x-model="searchColor">
                                    <template x-for="color in colors" :key="color">
                                        <option :value="color" x-text="color"></option>
                                    </template>
                                </x-select>
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
                                <x-label class="my-2">Materiales</x-label>
                                <x-select x-model="selectedMaterial">
                                    <template x-for="material in materials" :key="material">
                                        <option :value="material" x-text="material"></option>
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
                        <x-button.corp_secundary @click="resetFilters">
                            Limpiar filtros
                        </x-button.corp_secundary>
                    </div>
                    {{-- Lista de Productos --}}
                    <div class="bg-gris-80 shadow-xl rounded-lg p-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mb-4 ">
                            <template x-for="product in displayedProducts" :key="product.id">
                                <div class=" text-gris-20 bg-gris-90 rounded-lg shadow-md p-4 cursor-pointer  relative overflow-hidden"
                                    :class="{ 'add-to-cart-animation': product.animation }">
                                    <div class="product-content">
                                        <h3 class="text-lg font-semibold" x-text="product.name"></h3>
                                        <img :src="'{{ asset('storage') }}/'+product.image" alt="" class="w-32 h-32">

                                        <p x-text="'S/.' + product.price"></p>
                                        <p x-text="'Stock:' + product.stock"></p>
                                        <p x-text="product.category"></p>
                                        <p x-text="'SKU: ' + product.sku"></p>
                                        <p x-text="'Color: ' + product.color"></p>
                                        <p x-text="'Material: ' + product.material"></p>
                                        <p x-text="'Brand: ' + product.brand"></p>
                                    </div>
                                    <button @click.stop="addToCartWithAnimation(product)"
                                        class="absolute top-0 left-0 w-full h-full flex items-center justify-center bg-black/30 text-white opacity-0 hover:opacity-100 transition-opacity duration-300">
                                        <img :src="'{{ asset('storage') }}/'+product.brandimg" alt=""
                                            class="w-32 h-32 rounded-full ">
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

                {{-- Carrito de Compras --}}
                <div class="w-1/3 p-2 text-gris-20">
                    <div class="mb-4  bg-gris-80 shadow-xl rounded-lg p-4">
                        <h3 class="mb-3">Datos del cliente</h3>
                        <x-label class="m-2">Nombre</x-label>
                        <x-input x-model="client.name" placeholder="Nombre del cliente ... " />

                            <p x-text="validations.name" class="text-corp-50 text-[12.07px] font-inter font-normal leading-20.12 ml-2"></p>


                        <x-label class="m-2">N° de Documento</x-label>
                        <x-input type="number" x-model="client.doc" placeholder="Número de doc del cliente ... " />
                        <x-label class="m-2">Teléfono</x-label>
                        <x-input type="number" x-model="client.phone" placeholder="Número del cliente ... " />
                        <x-label class="m-2">Correo</x-label>
                        <x-input type="email" x-model="client.email" placeholder="Correo del cliente ... " />
                    </div>
                    <div class="mb-4  bg-gris-80 shadow-xl rounded-lg p-4">
                        <h2 class="text-xl font-semibold mb-2">Detalles</h2>
                        <template x-for="item in cart" :key="item.id">
                            <div class="flex justify-between items-center mb-2 p-2 border-b border-gray-200">
                                <span x-text="item.name"></span>
                                <x-input type="number" x-model.number="item.quantity" @change="updateQuantity(item)"
                                    min="1" class="!w-10" />
                                <span x-text="'S/.' + (item.price * item.quantity).toFixed(2)"></span>
                                <x-button.danger @click="removeFromCart(item)">
                                    <x-icons.trash class="h-5 w-5 py-1"></x-icons.trash>
                                </x-button.danger>
                            </div>
                        </template>

                        <div class="text-right font-bold mb-4">
                            Total: <span x-text="'S/.' + total.toFixed(2)"></span>
                        </div>
                        <div class="flex">
                            <button @click="checkout" :disabled="cart.length === 0"
                                class="h-[30px] text-white px-1 bg-corp-50 hover:bg-corp-70 rounded-[3px] overflow-hidden flex items-center justify-center mx-[5px]">
                                <div class="flex items-center justify-center mx-[10px]">
                                    <div
                                        class="text-center text-[12px] font-inter font-normal leading-4 whitespace-normal my-[4px] mx-[10px]">
                                        Registrar
                                    </div>
                                </div>
                            </button>

                            <button @click="resetCart" :disabled="cart.length === 0"
                                class="'h-[30px] text-white px-1 bg-gris-60 hover:bg-gris-90 rounded-[3px] border-[1px] border-gris-50 focus:border-gris-70 focus:outline-none overflow-hidden flex items-center justify-center">
                                <div class="flex items-center justify-center mx-[10px]">
                                    <div
                                        class="text-center text-[12px] font-inter font-normal leading-4 whitespace-normal my-[4px] mx-[10px]">
                                        Cancelar
                                    </div>
                                </div>
                            </button>
                        </div>

                        <div x-show="checkoutComplete"
                            class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white p-4 rounded-lg shadow-lg text-center">
                            <h2 class="text-xl font-semibold mb-2">Checkout Complete!</h2>
                            <p>Thank you for your purchase!</p>
                            <button @click="reset"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2">New
                                Order</button>
                        </div>
                    </div>
                </div>


                <script>

  Alpine.data('pos', () => ({
    searchQuery: '',
    selectedCategory: 'All',
    products: @json($skus),
    cart: [], client: {}, validations:{},
    total: 0,
    checkoutComplete: false,
    searchSKU: '',
    searchColor: '',
    selectedMaterial: 'All',
    selectedBrand: 'All',
    selectedType: 'All',
    itemsPerPage: 6,
    currentPage: 1,

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

    addToCart(product) {
      const existingItem = this.cart.find(item => item.id === product.id);
      if (existingItem) {
        if(existingItem.quantity < product.stock ) {
        existingItem.quantity++;}
      } else {
        this.cart.push({ ...product, quantity: 1 });
      }
      this.updateTotal();
    },

    removeFromCart(itemToRemove) {
      this.cart = this.cart.filter(item => item.id !== itemToRemove.id);
      this.updateTotal();
    },

    updateQuantity(item) {
      if (item.quantity <= 0) {
        item.quantity = 1;
      }
      if(item.quantity > item.stock)
      item.quantity = item.stock;

      this.updateTotal();
    },

    updateTotal() {
      this.total = this.cart.reduce((acc, item) => acc + (item.price * item.quantity), 0);
    },

    checkout() {

    this.client.total= this.total.toFixed(2);
    if(!this.client.name) { this.validations.name="El Nombre es requerido"} else { this.validations.name=null}
    if(this.client.name){
        const datos = {
        'detalles':this.cart,
        'cliente':this.client,
    };
    console.log(datos);
    axios.post('{{ route('sale.dash.store') }}',datos) // Reemplaza '/api/datos' con tu URL
                    .then(response => {
                        this.datos = response.data;
                        this.cargando = false;
                    })
                    .catch(error => {
                        this.error = true;
                        this.mensajeError = error.message;
                        this.cargando = false;
                    });
                    this.checkoutComplete = true;
                }
},

    reset() {
      this.cart = [];
      this.total = 0;
      this.checkoutComplete = false;
      this.currentPage = 1;
    },

    resetCart() {
      this.cart = [];
      this.updateTotal();
    },

    init() {
      this.$watch('itemsPerPage', (value) => {
        this.currentPage = 1;
      });
    },

    addToCartWithAnimation(product) {
      product.animation = true;
      product.moveToCart = true;
      this.addToCart(product);
      setTimeout(() => {
        product.animation = false;
        setTimeout(() => {
          product.moveToCart = false;
        }, 1000);
      }, 500);
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
    </x-slot>

</x-app-layout>
