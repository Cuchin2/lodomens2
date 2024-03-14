<x-app-layout>

    <x-slot name="slot1">
        <x-breadcrumb.title title='Editar Footer'/>
        <x-breadcrumb.breadcrumb>
            <x-breadcrumb.breadcrumb2  name='Footer'/>
        </x-breadcrumb.breadcrumb>
    </x-slot>


    <x-slot name="slot2"> @if (session()->has('info'))
        <div x-data="{ open: true }" x-show="open" x-init="setTimeout(() => open = false, 2000)"
            :class="!open" x-collapse
            class="mb-[20px]">
            <div
    class="items-center flex rounded-lg border border-green-600 bg-green-900 bg-opacity-20 py-2 px-2 text-green-600 sm:px-5 text-[12px]"
  >
    <svg
      xmlns="http://www.w3.org/2000/svg"
      class="h-5 w-5"
      viewBox="0 0 20 20"
      fill="currentColor"
    >
      <path
        fill-rule="evenodd"
        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
        clip-rule="evenodd"
      />
    </svg>
    <p class="mx-1 ">{{session()->get('info')}}</p>
  </div>

        </div>

    @endif
        <form method="POST" action="{{ route('mypage.update',1) }}" name="formulario" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 " id="miDiv">

                <div class=" bg-white dark:bg-gris-80 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="mx-auto max-w-screen-xl px-4 py-4 lg:px-12 ">

                        <div class="my-3">
                            <x-label class="mb-2">Título:</x-label>
                            <x-input name="title" value="{{$footer->title ?? ''}}" placeholder="Escribir título "></x-input>
                        </div>

                        <div class="my-3">
                            <x-label class="my-2">Contenido:</x-label>
                            <x-input-textarea placeholder="Contenido" name="content" col="4">
                                {{$footer->content ?? ''}}
                                </x-imput-textarea>
                                <span class="dark:text-gris-50 text-[12px] flex m-1">Se recomienda de 200 a 300
                                    caracteres</span>
                        </div>
                    </div>
                </div>
                <div class=" bg-white dark:bg-gris-80 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="mx-auto max-w-screen-xl px-4 py-4 lg:px-12 ">
                        <div class="my-3">
                            <x-label class="mb-2">Logo:</x-label>
                           {{--  pruebas  --}}
                           <div class="py-3">

                            <!-- If you wish to reference an existing file (i.e. from your database), pass the url into imageData() -->
                            <div x-data="imageData('{{ $url }}')" class="file-input items-center">

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
                                         type="file"
                                         accept="image/*,capture=camera"
                                         name="photo" id="photo"
                                         class="custom">
                                  <label for="photo"
                                         class="mx-auto py-2 px-3 border border-gris-40 rounded-md text-sm leading-4 font-medium text-gris-20 hover:text-corp-50 hover:border-corp-50 focus:outline-none focus:border-corp-30 focus:shadow-outline-indigo active:bg-gray-50 active:text-indigo-800 transition duration-150 ease-in-out cursor-pointer">
                                    subir foto
                                  </label>
                                </div>

                                <div class="items-center text-sm text-gray-500 mx-auto">
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
                        <div class="my-3 dark:text-gray-200">
                            <x-label class="my-2">Redes sociales</x-label>
                             @if ($user->socialMedia->isNotEmpty())
                            <livewire-socialmedia-profile :redes="$user->socialMedia" />
                           @else
                           <livewire-socialmedia-profile />
                           @endif
                        </div>
                    </div>
                </div>
                <div class=" bg-white dark:bg-gris-80 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="mx-auto max-w-screen-xl px-4 py-4 lg:px-12 ">
                        <div class="my-3">
                        <x-label  value="{{ __('Información:') }}" />
                    </div>
                        <div class="my-3">

                            <div class="text-base text-gris-10 flex my-3 items-center">
                                <x-icons.address class="h-[20px] mr-3"/>
                                <x-input name="address" value="{{ $footer->address ?? '' }}" placeholder="Ubicación "></x-input>
                            </div>
                        </div>
                        <div class="my-3">
                            <div class="text-base text-gris-10 flex  my-3 items-center">
                            <x-icons.phone class="h-[20px] mr-3"/>
                            <x-input name="phone" value="{{ $footer->phone ?? '' }}" placeholder="Teléfono "></x-input>
                            </div>
                        </div>

                        <div class="my-3">
                            <div class="text-base text-gris-10 flex my-3 items-center">
                            <x-icons.mail class="h-[20px] mr-3"/>
                            <x-input name="email" value="{{ $footer->email ?? '' }}" placeholder="Correo electrónico "></x-input>
                        </div>

                        </div>
                        <div class="my-3">
                            <div class="text-base text-gris-10 flex my-3 items-center">
                                <x-icons.pedidos class="h-[20px]  mr-3 "/>
                                <x-input name="order_message" value="{{ $footer->order_message ?? '' }}" placeholder="Mensaje de envios "></x-input>
                            </div>

                        </div>

                        <x-button.corp1 type="buttom" class="ml-auto">Actualizar</x-button.corp1>

                    </div>
                </div>
            </div>
        </form>
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
        <script>
            function imageData(url) {
                const originalUrl = url || '';
                return {
                  previewPhoto: originalUrl,
                  fileName: null,
                  emptyText: originalUrl ? 'No se ha elegido ningún archivo nuevo' : 'Ningún archivo elegido',
                  updatePreview($refs) {
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
                  }
                };
              }
        </script>
    </x-slot>

</x-app-layout>
