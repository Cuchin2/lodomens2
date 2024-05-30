<div class="bg-gris-100  m-auto w-full col-span-3 h-full">
    <h5 class="px-5 pt-5">Datos personales</h5>
    <div class="grid grid-cols-3 gap-3 mx-auto p-5">
        <div>
            <p>Nombre {{--  <span class="text-corp-50">*</span>  --}}</p>
            <div class="mb-4 ">
                <input
                    class="w-full focus:ring-gris-100 bg-inherit border-0 border-b-[1px] border-gris-70 focus:border-b-[1px] focus:border-gris-70 focus:placeholder-gris-70 placeholder-gris-30"
                    type="text" placeholder="Ingresa tu nombre" wire:model="name"  wire:change="salvar"
                    placeholder="Nombre" required>
            </div>
            <div class="">
                <p >Tipo de documento</p>
                <x-select-line wire:model="doc_type" wire:change="salvar">
                    <option ></option>
                    <option value="DNI">DNI</option>
                    <option value="PASS">Pasaporte</option>
                    <option value="CARD">Carnet de extranjería</option>
                </x-select-line>
            </div>
        </div>

        <div>
            <p>Apellido </p>
            <div class="mb-4 ">
                <input
                    class="w-full focus:ring-gris-100 bg-inherit border-0 border-b-[1px] border-gris-70 focus:border-b-[1px] focus:border-gris-70 focus:placeholder-gris-70 placeholder-gris-30"
                    type="text" placeholder="Ingresa tu nombre" wire:model="last_name"  wire:change="salvar"
                    placeholder="Apellido" required>
            </div>
            <p>N° de documento </p>
            <div class="mb-4 ">
                <input
                    class="w-full focus:ring-gris-100 bg-inherit border-0 border-b-[1px] border-gris-70 focus:border-b-[1px] focus:border-gris-70 focus:placeholder-gris-70 placeholder-gris-30"
                    type="text" placeholder="Ingresa tu número" wire:model="dni"  wire:change="salvar"
                    placeholder="Apellido" required>
            </div>
        </div>
        <div>
            <p>Segundo apellido </p>
            <div class="mb-4 ">
                <input
                    class="w-full focus:ring-gris-100 bg-inherit border-0 border-b-[1px] border-gris-70 focus:border-b-[1px] focus:border-gris-70 focus:placeholder-gris-70 placeholder-gris-30"
                    type="text" placeholder="Ingresa tu nombre" wire:model="second_name"  wire:change="salvar"
                     placeholder="Segundo apellido" required>
            </div>
            <p>Teléfono </p>
            <div class="mb-4 ">
                <input
                    class="w-full focus:ring-gris-100 bg-inherit border-0 border-b-[1px] border-gris-70 focus:border-b-[1px] focus:border-gris-70 focus:placeholder-gris-70 placeholder-gris-30"
                    type="text" placeholder="Ingresa tu teléfono" wire:model="phone" wire:change="salvar"
                    placeholder="Apellido" required>
            </div>
        </div>
    </div>
   
</div>
