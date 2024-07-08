<div>
    <x-web.special.success-span />
    <div x-sort="$wire.sort($item, $position)"class="space-y-4 mb-4">
    @foreach ($contacts as $key =>$contact)
        <form wire:submit="updateForm('{{ $contact->id }}','{{ $key }}')" action="#" x-sort:item="{{ $contact->id }}">
        <div class="grid lg:grid-cols-6 gap-4">

            <x-dashboard.box class="col-span-3 space-y-2 relative">
                <h1 class="cursor-move hover:text-gris-5 w-fit" x-sort:handle>Contenido N° {{ $key+1 }}</h1>
                <div class="space-y-2">
                    <x-label >Nombre</x-label>
                    <x-input wire:model="form.name.{{ $key }}" placeholder="Nombre"/>
                        @if ($errors->has('form.name.'.$key))
                            <span class="text-corp-30 text-[12px]">{{ $errors->first('form.name.'.$key) }}</span>
                        @enderror
                </div>

                <div class="!mt-4 space-y-2">
                    <x-label>Detalle</x-label>

                    <x-input-textarea placeholder="Detalle" wire:model="form.description.{{ $key }}" col="3">
                            {{ $contact->description }}
                    </x-input-textarea>
                    @if ($errors->has('form.description.'.$key))
                    <span class="text-corp-30 text-[12px]">{{ $errors->first('form.description.'.$key) }}</span>
                @enderror

                </div>

                <div class="ml-auto flex space-x-2 w-fit !mt-4 ">

                    <x-button.corp1 type="submit" wire:loading.attr="disabled">
                        Actualizar
                    </x-button.corp1>
                </div>
            </x-dashboard.box>

            <x-dashboard.box class="col-span-1">
                <h1>Iconos</h1>
                <div class="mt-3">
                    <x-select-search placeholder="Selecciona un icono"
                        message="Ningun tipo coincide con la búsqueda" livewire="true" set="{{ $key }}"
                        :data="$icons" selected="{{ $contact->icon }}">
                    </x-select-search>
                </div>
                <div class="mt-3">

                        @if($contact->icon)
                        <x-dynamic-component :component="'icons.'.$contact->icon" class="mx-auto max-h-[65%] max-w-[65%] w-full h-full bg-gris-90 rounded-[3px] p-2"/>
                        @endif

                </div>
            </x-dashboard.box>

            <x-dashboard.box class="col-span-2 !text-gris-10 space-y-4">
                <h1>Previsualización</h1>

                <x-web.card.contact title="{{ $contact->name }}">
                    <x-slot name="icon">
                        @if($contact->icon)
                        <x-dynamic-component :component="'icons.'.$contact->icon" class="w-6 h-6 mx-auto"/>
                        @endif

                    </x-slot>

                    <div>
                            {!! nl2br(e($contact->description)) !!}
                    </div>
                </x-web.card.contact >

        </div>
    </x-dashboard.box>
    </form>
    @endforeach
    </div>
    @foreach ($elements as $key2=>$element)
    <form wire:submit="createForm({{ $key2 }})" action="#">
        <div class="grid lg:grid-cols-6 gap-4">

            <x-dashboard.box class="col-span-3 space-y-2 relative">

                <h1>Contenido Nuevo</h1>
                <div class="space-y-2">
                    <x-label >Nombre</x-label>
                    <x-input wire:model="elements.name.{{ $key2 }}" placeholder="Nombre" />
                        @if ($errors->has('elements.name.'.$key2))
                            <span class="text-corp-30 text-[12px]">{{ $errors->first('elements.name.'.$key2) }}</span>
                        @enderror
                </div>

                <div class="!mt-4 space-y-2">
                    <x-label>Detalle</x-label>

                    <x-input-textarea placeholder="Detalle" wire:model="elements.description.{{ $key2 }}">

                    </x-input-textarea>
                    @if ($errors->has('elements.description.'.$key2))
                    <span class="text-corp-30 text-[12px]">{{ $errors->first('elements.description.'.$key2) }}</span>
                @enderror

                </div>

                <div class="ml-auto flex space-x-2 w-fit !mt-4 ">

                    <x-button.corp1 type="submit" wire:loading.attr="disabled">
                        Actualizar
                    </x-button.corp1>
                </div>

            </x-dashboard.box>

        </div>
    </form>
    @endforeach
    @if($condition)
        <x-button.corp1 class="ml-3" wire:click="addElement();" wire:loading.attr="disabled" >
            Agregar Elemento
        </x-button.corp1>
    @endif




