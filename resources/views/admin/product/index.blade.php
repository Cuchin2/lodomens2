<x-app-layout>

    <x-slot name="slot1">
        <x-breadcrumb.title title='Lista de Productos'/>
        <x-breadcrumb.breadcrumb>

            <x-breadcrumb.breadcrumb2 name='Productos'/>
        </x-breadcrumb.breadcrumb>
    </x-slot>


    <x-slot name="slot2">
        <div class="bg-white dark:bg-gris-80 overflow-hidden shadow-xl sm:rounded-lg ">
        <livewire:product-table/>
        </div>
    </x-slot>

</x-app-layout>



