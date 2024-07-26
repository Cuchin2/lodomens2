<x-app-layout>

    <x-slot name="slot1">
        <x-breadcrumb.title title='Página de contacto' />
        <x-breadcrumb.breadcrumb>
            <x-breadcrumb.breadcrumb2 name='Detalles' />
        </x-breadcrumb.breadcrumb>
    </x-slot>


    <x-slot name="slot2">
        @if (Session::has('message'))
        <x-dashboard.alert.succes>Se creo satisfactoriamente un Contenido </x-dashboard.alert.succes>
        @endif
        <livewire:contact-app/>
    </x-slot>

</x-app-layout>
