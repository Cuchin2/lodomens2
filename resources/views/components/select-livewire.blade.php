@props(['options'])

<div x-data="{
    open: false,
    selected: @entangle($attributes->wire('model')),
    options: {{ json_encode($options) }},
    handleSelect(value) {
        this.selected = value;
        this.open = false;
        this.$dispatch('option-selected', { value });
    }
}" class="relative text-[14px] border-1 text-nowrap">
    <button @click="open = !open" @click.away="open = false"  type="button" class="border-[1.5px] rounded-[3px] w-full text-gris-10 border-gris-50 bg-black  text-left">
        <div class="flex items-center px-2 py-1">
            <span x-text="options[selected] ? options[selected] : '{{ $options[''] }}'" class="text-gris-30 text-[13px]"></span>
            <x-icons.chevron-down height="10px" width="10px" grosor="1" class="ml-auto"/>
        </div>
    </button>

    <div x-show="open" x-cloak class="absolute z-50 w-auto border rounded-[3px] border-gris-70 bg-gris-100">
        <ul class="py-1">
            @foreach($options as $value => $description)
                @if($value !== '')
                    <li @click="handleSelect('{{ $value }}')" class="cursor-pointer md:px-4 px-2 py-1 hover:bg-gris-80 text-[13px] hover:text-gris-5">{{ $description }}</li>
                @endif
            @endforeach
        </ul>
    </div>
</div>
