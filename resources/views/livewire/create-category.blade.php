<div>
    <x-dialog-modal wire:model="showModal">
        <x-slot name="title">
            Crear nueva etiqueta
        </x-slot>

        <x-slot name="content">
            <div class="flex space-x-5">
                <div class="mt-4 mb-0 w-full">
                    <x-label class="my-2">Nombre</x-label>
                    <x-input placeholder="Nombre" name="name" wire:model='name' class="w-full" wire:keydown.enter=delete()>
                    </x-imput>
                    @error('name')
                    <div class="text-corp-10 ml-2"> {{ $message }}</div>
                    @enderror
                </div>
                <div class="mt-4 mb-0 w-full">
                    <x-label class="my-2">Código</x-label>
                    <x-input placeholder="Código" name="code" wire:model='code' wire:change='codeComplete' class="w-full" wire:keydown.enter=delete()>
                    </x-imput>
                    @error('code')
                    <div class="text-corp-10 ml-2"> {{ $message }}</div>
                    @enderror
                </div>
             </div>
            <div class="mt-4 mb-0">
            <x-label class="mb-2 mt-4">Descripción</x-label>
            <x-input-textarea placeholder="Descripción" name="description" wire:model='description' col="4">

                </x-imput-textarea>
            </div>
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
