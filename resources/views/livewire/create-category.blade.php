<div>
    <x-dialog-modal wire:model="showModal">
        <x-slot name="title">
            Crear nueva etiqueta
        </x-slot>

        <x-slot name="content">
            <div class="mt-4 mb-0">
                <x-label class="my-2">Nombre</x-label>
                <x-input placeholder="Nombre" name="name" wire:model='name' class="w-full" wire:keydown.enter=delete()>
                </x-imput>
            </div>
            <x-label class="mb-2 mt-4">Descripción</x-label>
            <x-input-textarea placeholder="Descripción" name="description" wire:model='description' col="4">

                </x-imput-textarea>
        </x-slot>

        <x-slot name="footer">
            <x-button.corp_secundary  wire:click="$toggle('showModal')" wire:loading.attr="disabled">
                {{ __('Cancelar') }}
            </x-button.corp_secundary>

            <x-button.corp1 class="ml-3" wire:click="delete()" wire:loading.attr="disabled">
                {{ __('Crear') }}
            </x-button.corp1>
        </x-slot>
    </x-dialog-modal>
</div>
