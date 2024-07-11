@extends('layouts.web')

@section('breadcrumb')

<x-breadcrumb.lodomens.breadcrumb title="Perfil">
    <x-breadcrumb.lodomens.breadcrumb2 name='Mi Cuenta' />
</x-breadcrumb.lodomens.breadcrumb>

@endsection

{{--  <x-lodomens.video />  --}}
@section('content')

<x-menu.sidebar>
    <div class="bg-gris-100  m-auto w-full col-span-3 h-full">
        {{-- Be like water. --}}
        <h5 class="px-5 pt-5">Configuración de cuenta</h5>
{{--          <div class="grid grid-cols-3 gap-3 mx-auto p-5">
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
        </div>--}}
        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
        <div class="sm:mt-0 pb-4">
            @livewire('profile.update-password-form')
        </div>

        @endif
    </div>

   {{--   <livewire:account-dashboard />  --}}
</x-menu.sidebar>


@endsection
