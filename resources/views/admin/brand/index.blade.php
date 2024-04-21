<x-app-layout>

    <x-slot name="slot1">
        <x-breadcrumb.title title='Lista de Marcas'/>
        <x-breadcrumb.breadcrumb>
            <x-breadcrumb.breadcrumb2 name='Marcas'/>
        </x-breadcrumb.breadcrumb>
    </x-slot>


    <x-slot name="slot2">
        <div class="bg-white dark:bg-gris-80 overflow-hidden shadow-xl sm:rounded-lg ">
            <livewire:brand-table/>
        </div>
    </x-slot>

</x-app-layout>
