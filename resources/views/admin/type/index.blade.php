<x-app-layout>
    <x-slot name="slot1">
        <x-breadcrumb.title title='Lista de Tipos de Producto'/>
        <x-breadcrumb.breadcrumb>
            <x-breadcrumb.breadcrumb2 name='Tipos'/>
        </x-breadcrumb.breadcrumb>
    </x-slot>

    <x-slot name="slot2">
        <div class="bg-gris-80 overflow-hidden shadow-xl sm:rounded-lg ">
            <livewire:type-table/>
        </div>
    </x-slot>
</x-app-layout>
