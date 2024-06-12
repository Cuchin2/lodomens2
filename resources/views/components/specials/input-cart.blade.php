@props(['item','index'])

<div class="flex space-x-2 items-center">
    <div class="flex">
        <div class="cursor-pointer hover:text-gris-10 hover:border-gris-10 text-gris-60 bg-transparent h-[26px] border-[1px] text-[12px] rounded-l-[3px] border-gris-30 w-[30px] flex items-center"
            wire:click="decreaseCount('{{$item->rowId}}','{{ $index }}','{{ $item->options->stock }}')">
            <x-icons.chevron-left grosor="1" height="17px" width="17px"
                class="p-1 mx-auto fill-gris-30 " />
        </div>
        <div>
            <input type="text"
                class="text-gris-10 font-bold bg-transparent h-[26px] mx-auto  p-2 focus:ring-gris-50 focus:border-gris-50 w-[47px] border-gris-30 text-center border-x-0"
                placeholder=" " required=""
                wire:change="updateCart('{{ $item->rowId }}','{{$index}}','{{ $item->options->stock }}')"
                wire:model.change="counts.{{ $index }}">
        </div>
        <div class="cursor-pointer hover:text-gris-10 hover:border-gris-10 text-gris-60 bg-transparent h-[26px] border-[1px] text-[12px] rounded-r-[3px] border-gris-30 w-[30px] flex items-center"
            wire:click="increaseCount('{{$item->rowId}}','{{ $index }}','{{ $item->options->stock }}')">
            <x-icons.chevron-right grosor="1" height="17px" width="17px"
                class="p-1 mx-auto fill-gris-30 " />
        </div>
    </div>
    {{ $slot }}
</div>