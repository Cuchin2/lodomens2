<x-app-layout>

    <x-slot name="slot1">
        <x-breadcrumb.title title='Lista de Usuarios'/>
        <x-breadcrumb.breadcrumb>

            <x-breadcrumb.breadcrumb2 name='Usuarios'/>
        </x-breadcrumb.breadcrumb>
    </x-slot>


    <x-slot name="slot2">
        <div class="bg-white dark:bg-gris-80 overflow-hidden shadow-xl sm:rounded-lg ">
        <livewire:user-table/>
        </div>
    </x-slot>

</x-app-layout>



