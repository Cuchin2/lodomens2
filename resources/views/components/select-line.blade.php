@props(['options'])

<div x-data="{
    open: false,
    selected: @entangle($attributes->wire('model')),
    options: {{ json_encode($options) }}
}" class="relative text-[14px]">
    <button @click="open = !open" @click.away="open = false" type="button" class="w-full dark:bg-gris-100 bg-inherit border-0 border-b-[1px] border-gris-70 focus:ring-gris-100 focus:border-b-[1px] focus:border-gris-70 focus:placeholder-gris-70 placeholder-gris-30 text-left">
        <div class="flex items-center p-[9.5px]">
            <span x-text="options[selected]" :class="selected == '' ? 'text-gris-50' : 'text-gris-10'"></span>
            <x-icons.chevron-down height="10px" width="10px" grosor="1" class="ml-auto mt-2"/>
        </div>
    </button>

    <div x-show="open" class="absolute z-50 mt-2 w-full bg-white border rounded-[3px] border-gris-70 dark:bg-gris-100">
        <ul class="py-1">
            @foreach($options as $value => $description)
                @if($value !== '')
                    <li @click="selected = '{{ $value }}'; open = false; $dispatch('input', '{{ $value }}')" class="cursor-pointer px-4 py-1 hover:bg-gris-50 text-[14px]">{{ $description }}</li>
                @endif
            @endforeach
        </ul>
    </div>
</div>
