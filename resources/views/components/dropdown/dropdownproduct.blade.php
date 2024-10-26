@props(['status'=>'false','id','name'])

<div x-data="{ dropdown: false, status:'{{ $status }}'}" class="relative w-fit "
    @state.window="if($event.detail.id == {{ $id }}) { status = $event.detail.state; console.log($event.detail.state) }">
    <button @click="if(status !== 'Sin pagar') dropdown = !dropdown"
        class="absolute {{--  bg-gris-80  --}}  py-[2px] rounded-full transition duration-150 {{--   border-[1px] border-gris-10   --}} whitespace-nowrap w-[100px] -translate-y-1/2 left-[-12px] h-[24px] {{--  text-[12px]  --}}"
        :class="{'z-20' : dropdown,
{{--      'hover:bg-azul-30/10 hover:text-azul-10 text-azul-30 hover:border-azul-10 py-[2px] text-[12px]  border-[1px] border-azul-30': status == 'Pagado',  --}}
    'hover:bg-rojo-30/10 hover:text-rojo-10 text-rojo-30 hover:border-rojo-10 py-[2px] text-[12px]  border-[1px] border-rojo-30': status == 'Cancelado',
    'hover:bg-amarillo-30/10 hover:text-amarillo-10 text-amarillo-30 hover:border-amarillo-10 py-[2px] text-[12px]  border-[1px] border-amarillo-30': status == 'Borrador',
    'hover:bg-verde-30/10 hover:text-verde-10 text-verde-30 hover:border-verde-10 py-[2px] text-[12px]  border-[1px] border-verde-30': status == 'Publicado',
    'hover:bg-morado-30/10 hover:text-morado-10 text-morado-30 hover:border-morado-10 py-[2px] text-[12px]  border-[1px] border-morado-30': status == 'Programado',
    {{--  '!bg-gris-70 text-white border-white' :  dropdown && status == 'Sin pagar',  --}}
 {{--     '!bg-azul-30/10 text-azul-10 :border-azul-10' :  dropdown && status == 'Pagado',  --}}
    '!bg-amarillo-30/10 text-amarillo-10 border-amarillo-10' :  dropdown && status == 'Borrador',
    '!bg-rojo-30/10 text-rojo-10 border-rojo-10' :  dropdown && status == 'Cancelado',
    '!bg-verde-30/10 text-verde-10 border-verde-10' :  dropdown && status == 'Publicado',
    '!bg-morado-30/10 text-morado-10 border-morado-10' :  dropdown && status == 'Programado',
}" x-text="status">

    </button>
    <div x-show="dropdown" x-cloak x-transition @click.away="dropdown = false"
        class="absolute bg-gris-80 border border-gris-50 rounded-[15px]  py-2 z-10 top-[-10px] mt-[-2px] left-[-12px]">
        <div class="flex flex-col w-[99px] mt-4">
            <a x-show="status !== 'Borrador'" @click="dropdown = false; $wire.estado('DRAFT','{{ $id }}',status,'amarillo-10','{{ $name }}')"
                href="#" class="hover:bg-gris-70 py-1 hover:text-amarillo-10">
                Borrador
            </a>
            <a x-show="status !== 'Programado'" @click="dropdown = false; $wire.estado('POS','{{ $id }}',status,'morado-10','{{ $name }}')"
                href="#" class="hover:bg-gris-70 py-1 hover:text-morado-10">
                Programado
            </a>

            <a x-show="status !== 'Publicado'" @click="dropdown = false; $wire.estado('SHOP','{{ $id }}',status,'verde-10','{{ $name }}')"
                href="#" class="hover:bg-gris-70 py-1 hover:text-verde-10">
                Publicado
            </a>
            <a x-show="status !== 'Cancelado'" @click="dropdown = false; $wire.estado('DISABLED','{{ $id }}',status,'rojo-10','{{ $name }}')"
                href="#" class="hover:bg-gris-70 py-1 hover:text-rojo-10">
                Cancelado
            </a>
        </div>


    </div>
</div>
