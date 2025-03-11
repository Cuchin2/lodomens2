@props(['status'=>'false','id'])

<div x-data="{ dropdown: false, status:'{{ $status }}'}" class="relative w-fit " @state.window="if($event.detail.id == {{ $id }}) { status = $event.detail.state; console.log($event.detail.state) }">
<button
    @click="if(status !== 'Sin pagar') dropdown = !dropdown"
    class="absolute capitalize {{--  bg-gris-80  --}}  py-[2px] rounded-full transition duration-150 {{--   border-[1px] border-gris-10   --}} whitespace-nowrap w-[100px] -translate-y-1/2 left-[-12px] h-[24px] {{--  text-[12px]  --}}"
    :class="{'z-20' : dropdown,

    'hover:bg-rojo-30/10 hover:text-rojo-10 text-rojo-30 hover:border-rojo-10 py-[2px] text-[12px]  border-[1px] border-rojo-30': status == 'cancelado',

    'hover:bg-verde-30/10 hover:text-verde-10 text-verde-30 hover:border-verde-10 py-[2px] text-[12px]  border-[1px] border-verde-30': status == 'entregado',

    {{--  '!bg-gris-70 text-white border-white' :  dropdown && status == 'Sin pagar',  --}}


    '!bg-rojo-30/10 text-rojo-10 border-rojo-10' :  dropdown && status == 'cancelado',
    '!bg-verde-30/10 text-verde-10 border-verde-10' :  dropdown && status == 'entregado',

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

  {{--   <a x-show="status !== 'Entregado'"
    @click="dropdown = false; $wire.status('entregado','{{ $id }}','4',status);"
    href="#"
    class="hover:bg-gris-70 py-1 hover:text-verde-10"
    >
    Entregado
    </a> --}}
    <template x-if="status == 'entregado' ">
        <a x-show="status !== 'Cancelado'"
        @click="dropdown = false; $wire.status('cancelado','{{ $id }}','5',status);"
        href="#"
        class="hover:bg-gris-70 py-1 hover:text-rojo-10"
    >
        Cancelado
    </a>
</template>
    </div>


</div>
</div>
