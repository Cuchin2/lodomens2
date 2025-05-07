<x-app-layout>

    <x-slot name="slot1">
        <x-breadcrumb.title title='Lista de Transferencias'/>
        <x-breadcrumb.breadcrumb>

            <x-breadcrumb.breadcrumb2 name='Lista de Transferencias'/>
        </x-breadcrumb.breadcrumb>
    </x-slot>


    <x-slot name="slot2">

        <livewire:transfer-table/>


    </x-slot>

</x-app-layout>
