<div class="flex justify-left space-x-3" x-data="{count:0, color:{{ json_encode($color) }}}">
    <div class="flex" @sku.window="color=$event.detail.parm">
        <div class="cursor-pointer hover:border-gris-10 text-gris-60 bg-black h-[36px] border-[1px] text-[12px] rounded-l-[3px]  border-gris-30 w-[30px] flex items-center"
            @click="count > 0 ? count-- : null">
            <x-icons.chevron-left grosor="1" height="20px" width="20px" class="p-1 mx-auto fill-gris-30" />
        </div>
        <div>
            <input type="text"
                class="text-gris-10 font-bold bg-black h-[36px] mx-auto text-[14px] p-2 focus:ring-gris-50 focus:border-gris-50 w-[52px] border-gris-30 text-center border-x-0"
                placeholder=" " required="" x-model="count">
        </div>
        <div class="cursor-pointer hover:border-gris-10 text-gris-60 bg-black h-[36px] border-[1px] text-[12px] rounded-r-[3px]  border-gris-30 w-[30px] flex items-center"
            @click="count++">
            <x-icons.chevron-right grosor="1" height="20px" width="20px" class="p-1 mx-auto fill-gris-30" />
        </div>
    </div>

    <x-button.webprimary class="w-full" x-on:click="$wire.add(count,color)"> Añadir a Carrito</x-button.webprimary>

    {{--  <button class="bg-gradient-to-b from-corp-20 via-corp-50 to-corp-90  text-gris-10 rounded-[3px] px-4 font-bold w-full h-[36px]">
        Añadir a Carrito
    </button>  --}}
</div>
