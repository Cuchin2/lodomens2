<div class="col-span-12 lg:col-span-12 bg-white dark:bg-gris-80 overflow-hidden shadow-xl sm:rounded-lg mb-4">
    <div x-data="colorComponent()" x-init="init()">
      <div class="flex flex-col" id="lista">
        <template x-for="(line, index) in lines" :key="line.id">
          <div class="flex items-center p-2" :data-id="line.id">
            <div class="handle cursor-move text-gris-20 p-2" x-text="line.id"></div>
            <template x-for="color in colors" :key="color.name">
              <div x-data="{
                imageUrl: '',
                fileChosen(event,index) {
                    this.fileToDataUrl(event, (src) => (this.imageUrl = src));
                    this.sendImageDataToBackend(event.target.files[0],index);
                },
                getImage(order,color){
                    axios.get('{{ route('getimage.product.color') }}', {
                        params: {
                          row: line.id,
                          colorid: color,
                          // Agrega más parámetros según sea necesario
                        }
                      })
                      .then(response => {
                        // Manejar la respuesta del backend
                        if(response.data.url[0]){
                        this.imageUrl = '{{ asset('storage') }}/'+response.data.url;}
                      })
                      .catch(error => {
                        // Manejar cualquier error que ocurra durante la solicitud
                        console.error('Error al enviar la imagen al backend:', error);
                      });
                },
                fileToDataUrl(event, callback) {
                    if (!event.target.files.length) return;

                    let file = event.target.files[0],
                        reader = new FileReader();

                    reader.readAsDataURL(file);
                    reader.onload = (e) => callback(e.target.result);
                },
                sendImageDataToBackend(file,index) {
                    let formData = new FormData();
                    formData.append('file', file);
                    formData.append('row', index);
                    formData.append('colorid', color.id); // Agregar el color.id al formData
                    axios.post('{{ route('upload.product.color',$id) }}', formData)
                      .then(response => {
                        // Manejar la respuesta del backend
                       // Puedes ajustar esto según la respuesta del backend
                      })
                      .catch(error => {
                        // Manejar cualquier error que ocurra durante la solicitud
                        console.error('Error al enviar la imagen al backend:', error);
                      });
                  }
                  }" class="mr-4 " x-init="getImage(index,color.id)">
                <div class="p-2 border-2 h-full w-full text-gris-30 rounded-[6px]" x-bind:style="`border-color: ${color.hex};  border-style:dotted;`">
                  {{--  <span x-text="color.name"></span>
                  <span x-text='index'></span>  --}}
                  <label :for="color.name + index" class="cursor-pointer">
                    <div class="w-[150px] h-[150px] rounded  border border-gris-50 flex items-center justify-center overflow-hidden">

                      <img x-show="imageUrl" :src="imageUrl" class="w-full object-cover">
                      <div x-show="!imageUrl" class="text-gray-300 flex flex-col items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 " fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                        <div>Subir imagen</div>

                      </div>

                    </div>
                  </label>

                  <input class="w-full cursor-pointer hidden" type="file" :name="color.name + index" :id="color.name + index" @change="fileChosen($event, line.id)">
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
@push('scripts')

  <script>
    function colorComponent() {
      return {
        sortableList:  document.getElementById('lista'),
        order: '',
        colors: @json($colors),
        lines: @json($numberArray), // Inicialmente, hay una línea de cuadrados de colores
        addLine() {

          let formData = new FormData();
          formData.append('order', this.lines.length);
          axios.post('{{ route('row.product.image',$id) }}', formData)
          .then(response => {
            this.lines.push({
                id: response.data.row_id,
                order: response.data.order
              });
          })
          .catch(error => {
            // Manejar cualquier error que ocurra durante la solicitud
            console.error('Error al enviar la imagen al backend:', error);
          });
        },
        init(){
            console.log(this.lines);
            this.lines = @json($numberArray);
            const sortableConfig = {
            animation: 150,
            handle: '.handle',
            store:{
                set: (sortable) => {
                this.order = sortable.toArray().slice(1);
                console.log(this.order);
                let formData = new FormData();
                formData.append('order', this.order);
                axios.post('{{ route('sorting.image',$id) }}', formData)
                  .then(response => {

                  })
                  .catch(error => {
                    // Manejar cualquier error que ocurra durante la solicitud
                    console.error('Error al enviar la imagen al backend:', error);
                  });
                }
            }
        };
        let sortableInstance = Sortable.create(this.sortableList,sortableConfig);
        }
      };
    }
  </script>

  @endpush
