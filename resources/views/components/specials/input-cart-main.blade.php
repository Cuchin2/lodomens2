@props(['stock'=>''])

<div class="flex">
    @if(isset($stock) && $stock > 0)
    <div class="cursor-pointer hover:border-gris-10 hover:text-gris-10 text-gris-60 bg-transparent h-[26px] border-[1px] text-[12px] rounded-l-[3px] border-gris-30 w-[30px] flex items-center" wire:click="decreaseCount('','')">
        <x-icons.chevron-left grosor="1" height="17px" width="17px" class="p-1 mx-auto fill-gris-30" />
    </div>
    <div>
        <input class="text-gris-10 font-bold bg-transparent h-[26px] mx-auto text-[12px] p-2 focus:ring-gris-50 focus:border-gris-50 w-[47px] border-gris-30 text-center border-x-0" placeholder=" " required="" wire:model='counts' wire:change="changePrice()">
    </div>
    <div class="cursor-pointer hover:border-gris-10 hover:text-gris-10 text-gris-60 bg-transparent h-[26px] border-[1px] text-[12px] rounded-r-[3px] border-gris-30 w-[30px] flex items-center" wire:click="increaseCount('','')">
        <x-icons.chevron-right grosor="1" height="17px" width="17px" class="p-1 mx-auto fill-gris-30" />
    </div>
    @endif
</div>
