<x-app-layout>

    <x-slot name="slot1">
        <x-breadcrumb.title title='Página de Envios' />
        <x-breadcrumb.breadcrumb>
            <x-breadcrumb.breadcrumb2 name='Parámetro de Envio' />
        </x-breadcrumb.breadcrumb>
    </x-slot>

    <x-slot name="slot2">
        <div class="space-y-4">
            <div class="bg-gris-80 overflow-hidden shadow-xl sm:rounded-lg ">
                <livewire:shipping-district/>
            </div>
            <div class="bg-gris-80 overflow-hidden shadow-xl sm:rounded-lg ">
                <livewire:shipping-national/>
            </div>
      <div class="bg-gris-80 overflow-hidden shadow-xl sm:rounded-lg ">
            <livewire:shipping-international/>
        </div>
        </div>
    </x-slot>

</x-app-layout>
