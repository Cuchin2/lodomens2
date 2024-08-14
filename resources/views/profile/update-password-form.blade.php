<x-form-section submit="updatePassword">
{{--      <x-slot name="title">
        {{ __('Update Password') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Ensure your account is using a long, random password to stay secure.') }}
    </x-slot>  --}}

    <x-slot name="form">
        <div class="grid md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-7 sm:mx-auto mx-2 w-full">
        <div class="w-full">
            <x-label for="current_password" class="!text-gris-5 text-[12px] md:text-[14px] lg:text-[16px]" value="{{ __('Current Password') }}" />
            <x-specials.input-eye-web id="current_password" type="password"  wire:model="state.current_password" autocomplete="current-password" />
           {{--   <x-input id="current_password" type="password" class="mt-1 block w-full" wire:model="state.current_password" autocomplete="current-password" />  --}}
            <x-input-error for="current_password" class="mt-2 !text-corp-10" />
        </div>

        <div class="w-full">
            <x-label for="password" class="!text-gris-5 text-[12px] md:text-[14px] lg:text-[16px]" value="{{ __('New Password') }}" />
            <x-specials.input-eye-web id="password" type="password"  wire:model="state.password" autocomplete="new-password" />
           {{--   <x-input id="password" type="password" class="mt-1 block w-full" wire:model="state.password" autocomplete="new-password" />  --}}
            <x-input-error for="password" class="mt-2 !text-corp-10" />
        </div>

        <div class="w-full">
            <x-label for="password_confirmation" class="!text-gris-5 text-[12px] md:text-[14px] lg:text-[16px]" value="{{ __('Confirm Password') }}" />
            <x-specials.input-eye-web id="password_confirmation" type="password" wire:model="state.password_confirmation" autocomplete="new-password" />
            {{--  <x-input id="password_confirmation" type="password" class="mt-1 block w-full" wire:model="state.password_confirmation" autocomplete="new-password" />  --}}
            <x-input-error for="password_confirmation" class="mt-2 !text-corp-10" />
        </div>
        <div class="w-full">
            <x-label class="!text-gris-5 text-[12px] md:text-[14px] lg:text-[16px]" value="Correo electrónico" />

                <input
                class="w-full pointer-events-nonew-full focus:ring-black bg-transparent border-0 border-b-[1px] border-gris-70 focus:border-b-[1px] focus:border-gris-70 focus:placeholder-gris-70 placeholder-gris-30 !text-gris-5 text-[12px] md:text-[14px] lg:text-[16px]"
                type="text"  value="{{ auth()->user()->email }}" disabled
               >

        </div>
    </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button.webprimary class="w-[150px]">
            {{ __('Save') }}
        </x-button.webprimary>
    </x-slot>
</x-form-section>
