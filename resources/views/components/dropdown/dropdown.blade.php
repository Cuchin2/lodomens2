@props(['status'=>'false','id'])

<div x-data="{ dropdown: false, status:'{{ $status }}'}" class="relative w-fit " @state.window="if($event.detail.id == {{ $id }}) { status = $event.detail.state; console.log($event.detail.state) }">
<button
    @click="if(status !== 'Sin pagar') dropdown = !dropdown"
    class="absolute {{--  dark:bg-gris-80  --}}  py-[2px] rounded-full transition duration-150 {{--   border-[1px] border-gris-10   --}} whitespace-nowrap w-[100px] -translate-y-1/2 left-[-12px] h-[24px] {{--  text-[12px]  --}}"
    :class="{'z-20' : dropdown, 
    'dark:hover:bg-azul-30/10 hover:dark:text-azul-10 dark:text-azul-30 hover:dark:border-azul-10 py-[2px] text-[12px]  border-[1px] dark:border-azul-30': status == 'Pagado',
    'dark:hover:bg-rojo-30/10 hover:dark:text-rojo-10 dark:text-rojo-30 hover:dark:border-rojo-10 py-[2px] text-[12px]  border-[1px] dark:border-rojo-30': status == 'Cancelado',
    'dark:hover:bg-amarillo-30/10 hover:dark:text-amarillo-10 dark:text-amarillo-30 hover:dark:border-amarillo-10 py-[2px] text-[12px]  border-[1px] dark:border-amarillo-30': status == 'En camino',
    'dark:hover:bg-verde-30/10 hover:dark:text-verde-10 dark:text-verde-30 hover:dark:border-verde-10 py-[2px] text-[12px]  border-[1px] dark:border-verde-30': status == 'Entregado',
    'dark:hover:bg-morado-30/10 hover:dark:text-morado-10 dark:text-morado-30 hover:dark:border-morado-10 py-[2px] text-[12px]  border-[1px] dark:border-morado-30': status == 'En proceso',
    {{--  '!bg-gris-70 text-white border-white' :  dropdown && status == 'Sin pagar',  --}}
    '!bg-azul-30/10 text-azul-10 dark:border-azul-10' :  dropdown && status == 'Pagado',
    '!bg-amarillo-30/10 text-amarillo-10 dark:border-amarillo-10' :  dropdown && status == 'En camino',
    '!bg-rojo-30/10 text-rojo-10 dark:border-rojo-10' :  dropdown && status == 'Cancelado',
    '!bg-verde-30/10 text-verde-10 dark:border-verde-10' :  dropdown && status == 'Entregado',
    '!bg-morado-30/10 text-morado-10 dark:border-morado-10' :  dropdown && status == 'En proceso',
}" 
    x-text="status"
    >
    
</button>
<div
    x-show="dropdown"
    x-cloak
    x-transition 
    @click.away="dropdown = false"
    class="absolute bg-gris-80 border border-gris-50 rounded-[15px]  py-2 z-10 top-[-10px] mt-[-2px] left-[-12px]"
>
    <div class="flex flex-col w-[99px] mt-4" 
    >
        <a x-show="status !== 'Pagado'"
            @click="dropdown = false; $wire.status('PAID','{{ $id }}','1',status);"
            href="#" 
            class="hover:bg-gris-70 py-1 hover:dark:text-azul-10"
        >
            Pagado
        </a>
        <a x-show="status !== 'En proceso'"
            @click="dropdown = false; $wire.status('PROCESS','{{ $id }}','2',status);"
            href="#" 
            class="hover:bg-gris-70 py-1 hover:dark:text-morado-10"
        >
            En proceso
        </a>
        <a x-show="status !== 'En camino'"
        @click="dropdown = false; $wire.status('TRACKING','{{ $id }}','3',status);"
        href="#" 
        class="hover:bg-gris-70 py-1 hover:dark:text-amarillo-10"
    >
        En camino
    </a>
    <a x-show="status !== 'Entregado'"
    @click="dropdown = false; $wire.status('DONE','{{ $id }}','4',status);"
    href="#" 
    class="hover:bg-gris-70 py-1 hover:dark:text-verde-10"
    >
    Entregado
    </a>
        <a x-show="status !== 'Cancelado'"
        @click="dropdown = false; $wire.status('CANCEL','{{ $id }}','5',status);"
        href="#" 
        class="hover:bg-gris-70 py-1 hover:dark:text-rojo-10"
    >
        Cancelado
    </a>
    </div>


</div>
</div>
