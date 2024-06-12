@props(['perPage'=>''])

<div class="flex space-x-2 items-center">
    <div class="dark:text-gris-30 text-[12.07px] font-inter font-normal leading-20.12">
        Mostrar
    </div>
    <div x-data="{ page: '{{ $perPage }}' }" class="flex items-center gap-7">
    <select wire:ignore
        x-model="page" @change="$wire.page(page)"
         :class="page == 5 ? 'pl-[11px]' : (page == 100 ? 'pl-[5px]' : 'pl-[8px]')"
        class="bg-gris-90 border-[0.5px] border-gris-70 text-gris-20 text-[12px] rounded-lg focus:ring-gris-70 focus:border-gris-70 block w-[44px] pr-[2px] py-[2px] mx-auto focus:ring-0">
        <option  value="5">5</option>
        <option value="10">10</option>
        <option value="20">20</option>
        <option value="50">50</option>
        <option value="100">100</option>
    </select>
    
    </div>
    <div class="dark:text-gris-30 text-[12.07px] font-inter font-normal leading-20.12">
        entradas
    </div>

</div>