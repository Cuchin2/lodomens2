@props(['url'=>'','stock'=>'','name'=>'','text'=>'text-[14px]','color'=>'','img'=>'','param'=>'top-3 left-3'])

<lodo {{ $attributes->merge(['class' => ' relative items-center  flex max-w-[200px] max-h-[200px] mx-auto overflow-hidden']) }}
    x-data="{ showBtn: false }"
    class="relative overflow-hidden"
    @mouseenter="showBtn = true"
    @mouseleave="showBtn = false"
    >
    {{ $slot }}
<img class="absolute {{$param}} z-10" src="{{ asset('storage').'/'.$img }}" alt="">
<img class="rounded-[3px] transition duration-500" src="{{ asset('storage/'.($url ?? '')) }}"
class = "mx-auto w-full h-full"
:class="showBtn ? 'scale-125' : ''"
    alt="{{ $name }}" >
    <div
    class=" absolute top-0 left-0 w-[100%] h-full flex items-center justify-center  {{ $stock > 0 ? 'border-[2px]  rounded-[3px]':'bg-black/80 border-[2px] rounded-[3px]' }}   " style="border-color: {{ $color }}"> @if ($stock < 1)
        <span class="text-gris-20 {{ $text }} font-bold  bg-gris-90 p-2 border-[2px]   rounded-[3px]" style="border-color: {{ $color }}">SIN STOCK</span>  @endif
    </div>
{{--      <div
    x-show="showBtn"
    x-cloak
    x-transition.enter.duration.500ms
    x-transition.leave.duration.300ms
    class="absolute w-full h-full top-0 left-0 z-10 bg-black bg-opacity-20 flex items-end justify-center">

    </div>  --}}
</lodo>
