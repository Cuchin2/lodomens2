<div class="col-span-12 lg:col-span-12 bg-gris-80 overflow-hidden shadow-xl sm:rounded-lg mb-4">
  <div x-data="colorComponent()" x-init="init()">
    <div class="p-4">
      <x-button.corp_secundary  @click="addLine" class="w-full mr-2">Agregar línea</x-button.corp_secundary>
    </div>
    <div class="flex flex-col" id="lista">
      <template x-for="(line, index) in lines" :key="line.id">
        <div class="flex items-center p-2" :data-id="line.id" x-data="{basicRowModal: false, files:[],
          deleterow(id){
              axios.delete('{{ route('deleterow',$id) }}', {
                  data: {
                      row_id: id
                  }
              })
              .then(response => {
                  // Manejar la respuesta exitosa aquí
                  this.lines=this.lines.filter(objeto => objeto.id !== response.data.id);
                  this.basicRowModal=false;
              })
              .catch(function (error) {
                  // Manejar el error aquí
                  console.error(error);
              });
          }
          }">
          <div class="handle cursor-move text-gris-20 p-2" x-text="index+1"></div>
          <template x-for="color in colors" :key="color.name">
            <div x-data="{
              imageUrl: '',
              basicInfoModal: false,
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
                      this.imageUrl = '{{ asset('storage') }}/'+response.data.url;
                      this.files.push(this.imageUrl);
                  }
                    })
                    .catch(error => {
                      // Manejar cualquier error que ocurra durante la solicitud
                      console.error('Error al enviar la imagen al backend:', error);
                    });
              },
              fileChosen(event, index) {
                  const file = event.target.files[0];
                  const reader = new FileReader();
                  reader.onload = (e) => {
                    const src = e.target.result;
                    const uniqueSrc = src + '?' + Date.now(); // Agregar un timestamp a la URL temporal
                    this.imageUrl = uniqueSrc;
                    this.sendImageDataToBackend(file, index);
                  };

                  reader.readAsDataURL(file);
                },
              sendImageDataToBackend(file,index) {
                  let formData = new FormData();
                  formData.append('file', file);
                  formData.append('row', index);
                  formData.append('colorid', color.id); // Agregar el color.id al formData
                  axios.post('{{ route('upload.product.color',$id) }}', formData)
                    .then(response => {
                      // Manejar la respuesta del backend
                      this.imageUrl= '{{ asset('storage') }}/'+response.data.url;
                      this.files.push(this.imageUrl);
                     // Puedes ajustar esto según la respuesta del backend
                    })
                    .catch(error => {
                      // Manejar cualquier error que ocurra durante la solicitud
                      console.error('Error al enviar la imagen al backend:', error);
                    });
                },
                deleteimage(url){
                  axios.delete('{{ route('deleteimage.color',$id) }}', {
                      data: {
                          url: url
                      }
                  })
                  .then(response => {
                      // Manejar la respuesta exitosa aquí
                      console.log(response);
                      this.basicInfoModal=false;
                      this.imageUrl='';
                      const index = this.files.indexOf(response.data.url);
                      if (index !== -1) {
                          this.files.splice(index, 1);
                        }
                  })
                  .catch(function (error) {
                      // Manejar el error aquí
                      console.error(error);
                  });
                }
                }" class="mr-4 " x-init="getImage(index,color.id)">
              <div  class="p-2 border-2 h-full w-full  text-transparent hover:text-gris-20 rounded-[6px] relative" x-bind:style="`border-color: ${color.hex};  border-style:dotted;`">

                <label :for="color.name + index" class="cursor-cell" >
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
                <div class="absolute bottom-4 left-4 hover:text-red-500 cursor-pointer" x-on:click="basicInfoModal=true"><x-icons.trash class="w-5 h-5"/></div>

                <input class="w-full cursor-pointer hidden" type="file" :name="color.name + index" :id="color.name + index" @change="fileChosen($event, line.id)">

              </div>

              {{--  modal interno --}}
                      <div x-show="basicInfoModal" x-transition.opacity="" x-transition:enter.duration.100ms="" x-transition:leave.duration.300ms="" class="fixed top-0 left-0 z-50 bg-black/40 h-screen w-full flex items-center justify-center ">
                          <div @click.away="basicInfoModal = false" class="relative sm:w-full sm:max-w-2xl sm:mx-auto bg-gris-70 rounded-lg shadow-xl text-gray-400 border-t-[3.5px] border-corp-50">
                              <span @click="basicInfoModal = false" class="absolute right-2 top-1 text-xl cursor-pointer hover:text-gray-600" title="Close">
                                  ✕
                              </span>
                              <div class="px-6 py-4">
                                  <div class="text-lg font-medium text-gris-10">
                                      Confirmación Eliminación
                                  </div>
                                  <div class="mt-4 text-[15px] text-gray-400 flex items-center">
                                      ¿Estás seguro de que deseas eliminar la imangen?  <img :src="imageUrl" alt="" class="w-[70px] ml-auto" >
                                  </div>
                              </div>

                              <div class="flex flex-row justify-end px-6 py-4 bg-gris-70 text-end rounded-lg">
                                  <x-button.corp_secundary  @click="basicInfoModal = false">Cancelar</x-button.corp_secundary>
                                  <x-button.corp1 @click="deleteimage(imageUrl)">Eliminar</x-button.corp1>
                              </div>
                          </div>
                      </div>

            </div>


          </template>
          <div class="flex text-gris-30 cursor-pointer" @click="basicRowModal=true">
              ✕
            </div>
             {{--  modal externo --}}
             <div x-show="basicRowModal" x-transition.opacity="" x-transition:enter.duration.100ms="" x-transition:leave.duration.300ms="" class="fixed top-0 left-0 z-50 bg-black/40 h-screen w-full flex items-center justify-center ">
              <div @click.away="basicRowModal = false" class="relative sm:w-full sm:max-w-2xl sm:mx-auto bg-gris-70 rounded-lg shadow-xl text-gray-400 border-t-[3.5px] border-corp-50">
                  <span @click="basicRowModal = false" class="absolute right-2 top-1 text-xl cursor-pointer" title="Close">
                      ✕
                  </span>
                  <div class="px-6 py-4">
                      <div class="text-lg font-medium text-gris-10">
                          Confirmación Eliminación
                      </div>
                      <div class="mt-4 text-[15px]  text-gray-400 flex items-center" x-text="'¿Estás seguro de que deseas eliminar la fila N° '+(index+1) +' ?'">

                      </div>
                      <p class="mt-4"><b>Advertencia</b>: Se borrarán todas las fotos de esta fila</p>
                      <div class="flex space-x-4 mt-2">
                      <template x-for="item in files" :key="item">
                              <img :src="item" alt="" class="w-[70px]">
                      </template>
                      </div>
                  </div>

                  <div class="flex flex-row justify-end px-6 py-4 bg-gris-70 text-end rounded-lg">
                      <x-button.corp_secundary  @click="basicRowModal = false">Cancelar</x-button.corp_secundary>
                      <x-button.corp1 @click="deleterow(line.id)">Eliminar</x-button.corp1>
                  </div>
              </div>
          </div>
        </div>

      </template>
    </div>
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
          this.lines = @json($numberArray);
          const sortableConfig = {
          animation: 150,
          handle: '.handle',
          store:{
              set: (sortable) => {
              this.order = sortable.toArray().slice(1);
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
