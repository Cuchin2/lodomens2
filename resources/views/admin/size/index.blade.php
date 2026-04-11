<x-app-layout>

    <x-slot name="slot1">
        <x-breadcrumb.title title='Lista de Tallas'/>
        <x-breadcrumb.breadcrumb>
            <x-breadcrumb.breadcrumb2 name='Tallas'/>
        </x-breadcrumb.breadcrumb>
    </x-slot>

    <x-slot name="slot2">
        <div class="bg-gris-80 overflow-hidden shadow-xl sm:rounded-lg ">
            <livewire:size-table />
            {{-- <livewire:create-tag /> --}}
        </div>
    </x-slot>

</x-app-layout>
