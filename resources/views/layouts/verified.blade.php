<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />
            <div class="p-4 text-gris-10">
        <h6 class="mx-auto w-fit">GRACIAS POR REGISTRARSE</h6>

        <p1 class="text-justify my-6">
            Por favor revise su correo electrónico, en su Bandeja de Entrada o Spam al correo que le enviamos y presione el botón para confirmar su correo electrónico.</p1>
        <div class="mx-auto w-fit mt-8">
            <a href="{{ route('root') }}">
        <x-button.webprimary class="ms-4 text-[14px]">
            Ir a la página principal
        </x-button.webprimary>
    </a>
        </div>
    </div>
    </div>
    </x-authentication-card>
</x-guest-layout>
