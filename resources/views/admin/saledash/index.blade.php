<x-app-layout>

    <x-slot name="slot1">
        <x-breadcrumb.title title='Lista de Ventas'/>
        <x-breadcrumb.breadcrumb>

            <x-breadcrumb.breadcrumb2 name='Lista de Ventas'/>
        </x-breadcrumb.breadcrumb>
    </x-slot>


    <x-slot name="slot2">

        <livewire:sale-dash-table/>


    </x-slot>

</x-app-layout>
