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
                <div class="m-4">
                    <x-label class="my-2">Descripción</x-label>
                    <x-input-textarea placeholder="Descripción" name="description" col="4"></x-imput-textarea>

                </div>
                <div class="mx-8 mb-4 text-center">
                    <x-button>Crear</x-button>
                </div>
            </div>
            </form>
        </div>

    </x-slot>

</x-app-layout>
