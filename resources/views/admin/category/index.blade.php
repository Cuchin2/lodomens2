<x-app-layout>

    <x-slot name="slot1">
        <x-breadcrumb.title title='Lista de Categorías'/>
        <x-breadcrumb.breadcrumb>
            <x-breadcrumb.breadcrumb2 name='Categorías'/>
        </x-breadcrumb.breadcrumb>
    </x-slot>


    <x-slot name="slot2">
        <div class="bg-gris-80 overflow-hidden shadow-xl sm:rounded-lg ">
            <livewire:category-table/>
            <livewire:create-category/>
        </div>
    </x-slot>

</x-app-layout>
