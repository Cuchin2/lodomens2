<div class="col-span-12 lg:col-span-12 bg-white dark:bg-gris-80 overflow-hidden shadow-xl sm:rounded-lg mb-4">
    <div x-data="colorComponent()" x-init="init()">
      <div class="flex flex-col" id="lista">
        <template x-for="(line, index) in lines" :key="index">
          <div class="flex items-center p-4" :data-id="index">
            <div class="handle cursor-move text-gris-20 p-2" x-text="index"></div>
            <template x-for="color in colors" :key="color.name">
              <div x-data="{
                imageUrl: '',
                fileChosen(event) {
                    this.fileToDataUrl(event, (src) => (this.imageUrl = src));
                },

                fileToDataUrl(event, callback) {
                    if (!event.target.files.length) return;

                    let file = event.target.files[0],
                        reader = new FileReader();

                    reader.readAsDataURL(file);
                    reader.onload = (e) => callback(e.target.result);
                },
                  }" class="mr-4">
                <div class="mr-2 p-5 border-2 h-full w-full text-gris-30" x-bind:style="`border-color: ${color.hex};  border-style:dotted;`">
                  {{--  <span x-text="color.name"></span>
                  <span x-text='index'></span>  --}}
                  <label :for="color.name + index">
                    <div class="w-full h-48 rounded  border border-gris-50 flex items-center justify-center overflow-hidden">

                      <img x-show="imageUrl" :src="imageUrl" class="w-full object-cover">
                      <div x-show="!imageUrl" class="text-gray-300 flex flex-col items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 " fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                        <div>Subir imagen</div>

                      </div>

                    </div>
                  </label>

                  <input class="w-full cursor-pointer hidden" type="file" :name="color.name + index" :id="color.name + index" @change="fileChosen">
                </div>
              </div>
            </template>
          </div>
        </template>
      </div>
      <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" @click="addLine" type="button">
        Agregar línea
      </button>
    </div>
  </div>

  <script>
    function colorComponent() {
      return {
        sortableList:  document.getElementById('lista'),
        order: '',
        colors: @json($colors),
        lines: [1], // Inicialmente, hay una línea de cuadrados de colores
        addLine() {
          this.lines.push(this.lines.length + 1);
        },
        init(){
            Sortable.create(this.sortableList, {
            animation: 150,
            handle: '.handle',
            store:{
                set: (sortable) => {
                this.order = sortable.toArray().slice(1);
                console.log(this.order);
                }
            }
        });
        }
      };
    }
  </script>
