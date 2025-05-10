<x-app-layout>

    <x-slot name="slot1">
        <x-breadcrumb.title title='Ventas por Tienda'/>
        <x-breadcrumb.breadcrumb>

            <x-breadcrumb.breadcrumb2 name='Ventas por Ventas'/>
        </x-breadcrumb.breadcrumb>
    </x-slot>


    <x-slot name="slot2">

        <livewire:shop-sale-table/>


    </x-slot>

</x-app-layout>
