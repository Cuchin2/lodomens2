@props(['type'=>$type,'types'=>$types,'id'=>$id, 'nameproduct'=>$nameproduct])

<div x-data="{ dropdown: false, types:{{ json_encode($types) }}, ty:'{{ $type->name }}', color:'{{ $type->hex }}'
    }" class="relative w-full" x-init="console.log(types)"
     @tipo.window="ty=$event.detail.name; color=$event.detail.hex;"
    >
    <button class="text-center py-[2px] px-2 absolute  whitespace-nowrap
 -translate-y-1/2 left-[-6px] h-[24px]"
 :style="'color:'+ color"
 @click=" dropdown = !dropdown" :class="{'z-20' : dropdown}" x-text="ty">

    </button>
    <div x-show="dropdown" x-cloak x-transition @click.away="dropdown = false"
        class="absolute bg-gris-80 border border-gris-50 rounded-[15px] px-2 z-10 top-[-17px]  left-[-11px] pt-[33px] min-w-[80px] w-fit">
        <div class="flex flex-col">
            <template x-for="(type, index) in types">
                <template x-if="ty !== type.name">
                    <a
                    href="#" class="hover:bg-gris-70 py-1 hover:text-amarillo-10" x-text="type.name"
                    @click=" dropdown=false; $wire.tipo('{{ $id }}',type.hex,type.name,ty,color,'{{ $nameproduct }}',type.id);" :style="'color:'+ type.hex"

                    >
                </a>
                </template>
            </template>
        </div>
    </div>
</div>

