<x-app-layout>

    <x-slot name="slot1">
        <x-breadcrumb.title title='Crear Categoría nueva de BLOG'/>
        <x-breadcrumb.breadcrumb>
            <x-breadcrumb.breadcrumb2 name='Blog  Categorías' href="{{route('POST.categories')}}"/>
            <x-breadcrumb.breadcrumb2 name='Crear'/>
        </x-breadcrumb.breadcrumb>
    </x-slot>


    <x-slot name="slot2">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-4" id="miDiv">
            <form method="POST" action="{{ route('categories.store') }}">
                @csrf
                <input hidden name="category_type" type="text" value="POST">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg ">
                <div class="m-4">
                    <x-label class="my-2">Nombre</x-label>
                    <x-input placeholder="Nombre" name="name" class="w-full"></x-imput>
                </div>
                <div>
                <div class="m-4">
                    <x-label class="my-2">Descripción</x-label>
                    <x-input-textarea placeholder="Descripción" name="description" col="4"></x-imput-textarea>

                </div>
                </div>
                <div class="mx-8 mb-4 text-center">
                    <x-button>Crear</x-button>
                </div>
            </div>
            </form>
        </div>
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
