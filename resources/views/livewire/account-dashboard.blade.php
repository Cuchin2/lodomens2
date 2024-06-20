<div class="bg-gris-100  m-auto w-full col-span-3 h-full">
    {{-- Be like water. --}}
    <h5 class="px-5 pt-5">Configuración de cuenta</h5>
    <div class="grid grid-cols-3 gap-3 mx-auto p-5">
        <div>
            <p1>Contraseña actual</p1>
            <div class="mb-4 ">
                <x-specials.input-eye-web wire:model="password"/>
            </div>
            <p1>Correo electrónico</p1>
            <input
            class="w-full focus:ring-gris-100 bg-inherit border-0 border-b-[1px] border-gris-70 focus:border-b-[1px] focus:border-gris-70 focus:placeholder-gris-70 placeholder-gris-30 pointer-events-none"
            type="text" placeholder="{{ $user->email }}"
            placeholder="Nombre" required>
        </div>

        <div>
            <p1>Nueva contraseña </p1>
            <div class="mb-4 ">
                <x-specials.input-eye-web wire:model="newPassword"/>
            </div>

        </div>
        <div>
            <p1>Confirma nueva contraseña </p1>
            <div class="mb-4 ">
                <x-specials.input-eye-web wire:model="renewPassword"/>
            </div>

        </div>
    </div>
    <div class="flex p-4">
        <x-button.webprimary class="w-[200px] mx-auto" wire:click="save()">Actualizar
        </x-button.webprimary>
    </div>

  <x-form-section submit="updatePassword">
    <x-slot name="title">
        {{ __('Update Password') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Ensure your account is using a long, random password to stay secure.') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-label for="current_password" value="{{ __('Current Password') }}" />
            <x-input id="current_password" type="password" class="mt-1 block w-full" wire:model="state.current_password" autocomplete="current-password" />
            <x-input-error for="current_password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="password" value="{{ __('New Password') }}" />
            <x-input id="password" type="password" class="mt-1 block w-full" wire:model="state.password" autocomplete="new-password" />
            <x-input-error for="password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
            <x-input id="password_confirmation" type="password" class="mt-1 block w-full" wire:model="state.password_confirmation" autocomplete="new-password" />
            <x-input-error for="password_confirmation" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button>
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
</div>
