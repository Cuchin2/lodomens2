<div>
    <x-dialog-modal wire:model="showModal2">
        <x-slot name="title">
            Crear nueva Marca
        </x-slot>

        <x-slot name="content">
            <div class="grid grid-cols-2 gap-4">
                <div class="mt-4 mb-0">
                    <x-label class="my-2">Nombre</x-label>
                    <x-input placeholder="Nombre" name="name" wire:model='name' class="w-full" wire:keydown.enter=delete()>
                    </x-imput>
                    <x-label class="mb-2 mt-4">Descripción</x-label>
                    <x-input-textarea placeholder="Descripción" name="description" wire:model='description' col="4">

                        </x-imput-textarea>
                </div>

                <div class="mt-4 mb-0">
                    <x-label class="my-2">Código</x-label>
                    <x-input placeholder="Código" name="slug" wire:model='slug' class="w-full" wire:keydown.enter=delete()>
                    </x-imput>
                    {{--  imagen  --}}
                    <div class="my-3">
                        <x-label class="mb-2">Logo:</x-label>
                        {{--  pruebas  --}}
                        <div class="py-3">

                        <!-- If you wish to reference an existing file (i.e. from your database), pass the url into imageData() -->
                        <div x-data="{
                            previewPhoto2: '',
                            fileName: null,
                            emptyText:  'Ningún archivo elegido',
                            updatePreview2($refs) {
                                console.log('hola2');
                                var reader,
                                    files = $refs.input2.files;
                                reader = new FileReader();
                                reader.onload = (e) => {
                                    this.previewPhoto = e.target.result;
                                    this.fileName = files[0].name;
                                };
                                reader.readAsDataURL(files[0]);
                                },
                            clearPreview($refs) {
                                $refs.input2.value = null;
                                this.previewPhoto = originalUrl;
                                this.fileName = false;
                                },
                        }"  class="file-input items-center">

                        <!-- Preview Image -->
                        <div class=" bg-gray-100 w-fit mx-auto">
                            <!-- Placeholder image -->
                            <div x-show="!previewPhoto2" >

                            </div>
                            <!-- Show a preview of the photo -->
                            <div x-show="previewPhoto2" class=" overflow-hidden bg-gris-80">
                                <img :src="previewPhoto2"
                                    alt=""
                                    class=" object-cover">
                            </div>
                            </div>

                            <div class="items-center ">
                            <!-- File Input -->
                            <div class="rounded-md shadow-sm my-4 flex">
                                <!-- Replace the file input styles with our own via the label -->
                                <input @change="updatePreview2($refs)" x-ref="input2"
                                    type="file" wire:model='logo'
                                    accept="image/*,capture=camera"
                                    name="photo" id="photo"
                                    class="custom">
                                <label for="photo"
                                    class="mx-auto py-2 px-3 border border-gris-40 rounded-md text-sm leading-4 font-medium text-gris-20 hover:text-corp-50 hover:border-corp-50 focus:outline-none focus:border-corp-30 focus:shadow-outline-indigo active:bg-gray-50 active:text-indigo-800 transition duration-150 ease-in-out cursor-pointer">
                                    subir foto
                                </label>
                            </div>

                            <div class="items-center text-sm text-gray-500 mx-auto"   @notify2.window="previewPhoto2=''">
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
                    {{--  fin de imagen  --}}
                </div>
        </div>

        </x-slot>

        <x-slot name="footer">
            <x-button.corp_secundary  wire:click="$toggle('showModal2')" wire:loading.attr="disabled">
                {{ __('Cancelar') }}
            </x-button.corp_secundary>

            <x-button.corp1 class="ml-3" wire:click="delete()" wire:loading.attr="disabled">
                {{ __('Crear') }}
            </x-button.corp1>
        </x-slot>
    </x-dialog-modal>
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

</div>


