<x-app-layout>

    <x-slot name="slot1">
        <x-breadcrumb.title title='Página de inicio' />
        <x-breadcrumb.breadcrumb>
            <x-breadcrumb.breadcrumb2 name='Detalles' />
        </x-breadcrumb.breadcrumb>
    </x-slot>


    <x-slot name="slot2">
        @if (session()->has('info'))
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
        <div class="bg-white dark:bg-gris-80 overflow-hidden shadow-xl sm:rounded-lg ">
            <livewire:slider-table />
        </div>
        <div class="grid md:grid-cols-2 grid-cols-1 gap-4 mt-4" x-data="
        {
        change(item,position){

                const requestData = {
                    item: item, // Aquí debes colocar el valor adecuado para el ID
                    position: position // Aquí debes colocar el valor adecuado para la posición
                };
                const url = '{{ route('banner.sort', ['id' => ':id']) }}'.replace(':id', requestData.item);
                // Realizar la petición POST con Axios
                axios.put(url, requestData)
                    .then(response => {
                        console.log('Petición exitosa. Respuesta recibida:', response.data);
                        // Puedes agregar aquí el código para manejar la respuesta de la petición
                    })
                    .catch(error => {
                        console.error('Error en la petición:', error);
                        // Puedes agregar aquí el código para manejar el error de la petición
                    });
                }

        }"
         x-sort="change($item, $position)">
            <div x-sort:item="{{ $banners[0]->id }}" class="bg-white dark:bg-gris-80 overflow-hidden shadow-xl sm:rounded-lg px-2 py-4">

                <form method="POST" action="{{ route('banner.update',0) }}" name="formulario"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <x-specials.upload-file url="{{ asset('storage/'.$banners[0]->url) ?? '' }}" id="3"/>
                    <div class="my-3 px-4">
                        <x-label class="mb-2">Título:</x-label>
                        <x-input name="title" value="{{ old('name',$banners[0]->title ?? '') }}" required
                            placeholder="Agregar título "></x-input>
                    </div>
                    <div class="my-3 px-4">
                        <x-label class="mb-2">Enlace:</x-label>
                        <x-input name="href" value="{{ old('name',$banners[0]->href ?? '') }}" required
                            placeholder="Agregar enlace ">
                        </x-input>
                    </div>
                    <x-button.corp1 type="buttom" class="mx-auto my-4">Actualizar</x-button.corp1>
                </form>
            </div>
            <div x-sort:item="{{ $banners[1]->id }}" class="bg-white dark:bg-gris-80 overflow-hidden shadow-xl sm:rounded-lg px-2 py-4">

                <form method="POST" action="{{ route('banner.update',1) }}" name="formulario2"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <x-specials.upload-file url="{{ asset('storage/'.$banners[1]->url) ?? '' }}" id="4"/>
                    <div class="my-3 px-4">
                        <x-label class="mb-2">Título:</x-label>
                        <x-input name="title" value="{{ old('name',$banners[1]->title ?? '') }}" required
                            placeholder="Agregar título "></x-input>
                    </div>
                    <div class="my-3 px-4">
                        <x-label class="mb-2">Enlace:</x-label>
                        <x-input name="href" value="{{ old('name',$banners[1]->href ?? '') }}" required
                            placeholder="Agregar enlace ">
                        </x-input>
                    </div>
                    <x-button.corp1 type="buttom" class="mx-auto my-4">Actualizar</x-button.corp1>
                </form>
            </div>
        </div>
        <div class="bg-white dark:bg-gris-80 overflow-hidden shadow-xl sm:rounded-lg px-2 py-4 mt-4 w-full">
            <form method="POST" action="{{ route('about.update',1) }}" name="formulario3">
                    @csrf
                    @method('PUT')
            <h2 class="text-gris-10 text-center">Sobre nosotros</h2>
            <div class="flex flex-col">
            <div class="my-3 px-4 xl:w-1/2 lg:w-2/3 md:w-4/5 w-full mx-auto">
                <input type="text" name="action" value="about" hidden>
                <x-label class="mb-2">Título:</x-label>
                <x-input name="name" value="{{ old('name',$about->name ?? '') }}" required
                    placeholder="Agregar título "></x-input>
            </div>
            <div class="my-3 px-4 xl:w-1/2 lg:w-2/3 md:w-4/5 w-full mx-auto">
                <x-label class="mb-2">Descripción:</x-label>
                <x-input-textarea placeholder="Descripción" name="description" col="10">
                    {{ old('short_description', $about->description) }}
                    </x-imput-textarea>
            </div>
            <x-button.corp1 type="buttom" class="mx-auto my-4">Actualizar</x-button.corp1>
            </div>
        </form>
        </div>
    </x-slot>

</x-app-layout>
