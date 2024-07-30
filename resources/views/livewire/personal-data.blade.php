<div class="bg-gris-100  m-auto w-full col-span-3 h-full rounded-[3px]">
    @if (session()->has('message'))
    <div x-data="{ open: true,
    abrir() {
    setTimeout(() => this.open = false, 2000); }
    }" x-show="open" x-init="abrir()"
        :class="!open" x-collapse
        class="mb-[20px]" @alt.window="open = true; abrir();">
        <div
            class="items-center flex rounded-lg border border-green-600 bg-green-900 bg-opacity-20 py-2 px-2 text-green-600 sm:px-5 text-[12px]"
            >
            <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-5 w-5"
            viewBox="0 0 20 20"
            fill="currentColor"
            >
            <path
                fill-rule="evenodd"
                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                clip-rule="evenodd"
            />
            </svg>
            <p class="mx-1 ">{{session()->get('message')}}</p>
            </div>

    </div>
    @endif

    <h5 class="px-5 pt-5">Datos personales</h5>
    <form wire:submit.prevent="submit">
    <div class="grid grid-cols-3 gap-3 mx-auto p-5">
        <div>
            <p class="text-gris-5">Nombre {{--  <span class="text-corp-50">*</span>  --}}</p>
            <div class="mb-4 ">
                <input
                    class="w-full focus:ring-gris-100 bg-inherit border-0 border-b-[1px] border-gris-70 focus:border-b-[1px] focus:border-gris-70 focus:placeholder-gris-50 placeholder-gris-50 text-[14px]"
                    type="text" placeholder="Ingresa tu nombre" wire:model="name"  {{--  wire:change="salvar"  --}}
                    placeholder="Nombre">
                    @error('name') <span class="text-corp-30">{{ $message }}</span> @enderror
            </div>
            <div class="">
                <p  class="text-gris-5">Tipo de documento</p>
                <x-select-line wire:model="doc_type"
                :options="[
                            '' => 'Seleccione un doc',
                            'DNI' => 'DNI',
                            'PASS' => 'Pasaporte',
                            'CARD' => 'Carnet de extranjería'
                            ]"/>
            </div>
        </div>

        <div>
            <p class="text-gris-5">Apellido </p>
            <div class="mb-4 ">
                <input
                    class="w-full focus:ring-gris-100 bg-inherit border-0 border-b-[1px] border-gris-70 focus:border-b-[1px] focus:border-gris-70 focus:placeholder-gris-50 placeholder-gris-50 text-[14px]"
                    type="text" placeholder="Ingresa tu apellido" wire:model="last_name"  {{--  wire:change="salvar"  --}}
                   >
            </div>
            <p class="text-gris-5">N° de documento </p>
            <div class="mb-4 ">
                <input
                    class="w-full focus:ring-gris-100 bg-inherit border-0 border-b-[1px] border-gris-70 focus:border-b-[1px] focus:border-gris-70 focus:placeholder-gris-50 placeholder-gris-50 text-[14px]"
                    type="text" placeholder="Ingresa tu número de Doc." wire:model="dni"  {{--  wire:change="salvar"  --}}
                   >
            </div>
        </div>
        <div>
            <p class="text-gris-5">Segundo apellido </p>
            <div class="mb-4 ">
                <input
                    class="w-full focus:ring-gris-100 bg-inherit border-0 border-b-[1px] border-gris-70 focus:border-b-[1px] focus:border-gris-70 focus:placeholder-gris-50 placeholder-gris-50 text-[14px]"
                    type="text" placeholder="Ingresa tu segundo apellido" wire:model="second_name"  {{--  wire:change="salvar"  --}}
                    >
            </div>
            <p class="text-gris-5">Teléfono </p>
            <div class="mb-4 ">
                <input
                    class="w-full focus:ring-gris-100 bg-inherit border-0 border-b-[1px] border-gris-70 focus:border-b-[1px] focus:border-gris-70 focus:placeholder-gris-50 placeholder-gris-50 text-[14px]"
                    type="text" placeholder="Ingresa tu teléfono" wire:model="phone" {{--  wire:change="salvar"  --}}
                    >
            </div>
        </div>

    </div>
    <div class="flex w-full p-4">
        <x-button.webprimary class="ml-auto">Actualizar
        </x-button.webprimary>
    </div>
    </form>
</div>
