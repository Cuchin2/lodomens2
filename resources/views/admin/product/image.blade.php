<div class="my-4 col-span-12" x-data="carga({{ $product->id }})" x-init="obtenerImagenes({{ $product->id }})">
    <main class="container mx-auto">
        <!-- file upload modal -->
        <article aria-label="File Upload Modal" class="relative h-full flex flex-col dark:bg-gris-80 -xl rounded-md">
            <!-- overlay -->
            {{-- <div id="overlay"
                class="w-full h-full absolute top-0 left-0 pointer-events-none z-50 flex flex-col items-center justify-center rounded-md">
                <i>
                    <svg class="fill-current w-12 h-12 mb-3 text-teal-700" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24">
                        <!-- ... -->
                    </svg>
                </i>
                <p class="text-lg text-teal-700">Soltar archivos para subir</p>
            </div> --}}

            <!-- scroll area -->
            <section class="h-full overflow-auto p-8 w-full  flex flex-col ">
                <form wire:submit="save" enctype="multipart/form-data">
                    <header
                        class="border-dashed border-2 border-gray-600 py-4 flex flex-col justify-center items-center dark:bg-gris-90">

                        <div x-ref="dnd" class="w-full">

                            <input accept="*" type="file" multiple
                                class="absolute inset-0 z-50 w-full h-32 p-0 top-10 m-0 outline-none opacity-0 cursor-pointer"
                                id="file-input" accept="*" type="file" multiple @change="addFiles($event)"
                                @dragover="$refs.dnd.classList.add('border-teal-400'); $refs.dnd.classList.add('ring-4'); $refs.dnd.classList.add('ring-inset');"
                                @dragleave="$refs.dnd.classList.remove('border-teal-400'); $refs.dnd.classList.remove('ring-4'); $refs.dnd.classList.remove('ring-inset');"
                                @drop="$refs.dnd.classList.remove('border-teal-400'); $refs.dnd.classList.remove('ring-4'); $refs.dnd.classList.remove('ring-inset');"
                                title="" />

                            @error('photos.*') <span class="error">{{ $message }}</span> @enderror
                            <div class="flex flex-col items-center justify-center py-5 dark:text-gray-200 text-center">
                                <svg class="w-6 h-6 mr-1 text-current-50" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <p class="m-0">Arrastre sus archivos aquí o haga clic en esta área</p>
                            </div>
                        </div>
                        <ul id="gallery" class="w-full flex flex-1 flex-wrap  justify-center">
                            <template x-for="(image, index) in images" :key="index">
                                <li :id="image.id" :data-id="image.id"
                                    class="block p-1 w-1/2 sm:w-1/3 md:w-1/3 lg:w-1/4 xl:w-1/5 h-36 mx-1">
                                    <article tabindex="0"
                                        class="w-full h-full rounded-md focus:outline-none focus:shadow-outline cursor-move relative text-transparent hover:text-white shadow-sm">
                                        <template x-if="image.extension === 'jpg' || image.extension === 'png' || image.extension === 'gif' || image.extension === 'jpeg' || image.extension === 'webpp'">
                                        <img :alt="image.name" :src="image.url"
                                            class="img-preview w-full h-full sticky object-cover rounded-md bg-fixed" />
                                        </template>
                                        <template x-if="image.extension === 'mp4'">
                                            <video :alt="image.name" :src="image.url" controls
                                                class="img-preview w-full h-full sticky object-cover rounded-md bg-fixed" >
                                            </video>
                                            </template>
                                        <section
                                            class="flex flex-col rounded-md text-xs break-words w-full h-full z-20 absolute top-0 py-2 px-3">
                                            <h1 class="flex-1" x-text="image.name"></h1>
                                            <div class="flex">
                                                <span class="p-1">
                                                    <i>
                                                        <svg class="fill-current w-4 h-4 ml-auto pt-"
                                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24">
                                                            <path
                                                                d="M5 8.5c0-.828.672-1.5 1.5-1.5s1.5.672 1.5 1.5c0 .829-.672 1.5-1.5 1.5s-1.5-.671-1.5-1.5zm9 .5l-2.519 4-2.481-1.96-4 5.96h14l-5-8zm8-4v14h-20v-14h20zm2-2h-24v18h24v-18z" />
                                                        </svg>
                                                    </i>
                                                </span>
                                                <p class="p-1 size text-xs" x-text="image.size"></p>
                                                <button
                                                    class="delete ml-auto focus:outline-none hover:bg-gray-300 p-1 rounded-md"
                                                    type="button" @click="deleteImage(index)">
                                                    <svg class="pointer-events-none fill-current w-4 h-4 ml-auto"
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24">
                                                        <path class="pointer-events-none"
                                                            d="M3 6l3 18h12l3-18h-18zm19-4v2h-20v-2h5.711c.9 0 1.631-1.099 1.631-2h5.316c0 .901.73 2 1.631 2h5.711z" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </section>
                                    </article>
                                </li>
                            </template>
                        </ul>
                    </header>


            </section>

            <!-- sticky footer -->
            <footer class="flex justify-end px-8 pb-8 pt-4">
                <button type="button" @click="obtenerImagenes({{ $product->id }})" id="recargar" hidden>click</button>
            </footer>
        </article>

    </main>
    <!-- Latest Sortable -->
    <script src="https://raw.githack.com/SortableJS/Sortable/master/Sortable.js"></script>
    <script>
        function carga(id) {
            return {
              images: [], // Declarar la variable images como una propiedad del objeto carga
              image: '',
              idd: id,
              // Lógica para obtener las imágenes utilizando Axios
              obtenerImagenes: function(a) {
                this.images = [],
                axios.get('../../getimages/' + a)
                  .then(function(response) {
                    this.images = response.data; // Asignar los datos de respuesta a la propiedad images
                  }.bind(this))
                  .catch(function(error) {
                    console.log(error);
                  });
              },
              deleteImage: function (index){
                idem = this.images[index].id;
                this.images.splice(index, 1);
                axios.delete('../../deleteimage/'+idem)
                .then(function(response) {
                    // Maneja la respuesta del backend si es necesario
                    console.log(response);
                  })
                  .catch(function(error) {
                    // Maneja el error si ocurre
                    console.log(error);
                  });
              },
              addFiles: function(e) {
                const files = e.target.files; // Obtener los archivos seleccionados
                const formData = new FormData();
                for (let i = 0; i < files.length; i++) {
                  const file = files[i];
                  formData.append(`files[${i}]`, file);
                 /* const reader = new FileReader();
                  reader.onload = function(event) {
                    const imageUrl = event.target.result;
                    const imageName = file.name;
                    const imageSize = file.size;


                    this.images.push({
                      id: this.images[this.images.length - 1].id+i,
                      name: imageName,
                      url: imageUrl,
                      size: imageSize
                    });
                  }.bind(this);
                  reader.readAsDataURL(file); */
                };
                axios.post('../../addimages/' + this.idd,formData,{
                    headers: {
                        'Content-Type': 'multipart/form-data'
                      }
                })
                .then(function(response) {
                    document.getElementById("recargar").click();
                  })
                  .catch(function(error) {
                    // Maneja el error si ocurre
                    console.log(error);
                  });

              },
              // Otras funciones y lógica de tu componente aquí
            }
          }

            var sortableList = document.getElementById('gallery');
            Sortable.create(sortableList, {
                animation: 150,
                store:{
                    set: function(sortable){
                        const sorts = sortable.toArray();
                        handleNewPositions(sorts,{{ $product->id }});
                    }
                }
              });

    function handleNewPositions(pos,id) {
            console.log(pos);
            axios.post('../../handleReorder/' + id,{
                sorts :pos
            })
            .then(function(response) {
                // Maneja la respuesta del backend si es necesario
                console.log(response);
              })
              .catch(function(error) {
                // Maneja el error si ocurre
                console.log(error);
              });
        }

    </script>
</div>
