@props(['href'=>'#','color'=>'gris-20','circle'=>'0','circle2'=>'','function'=>''])
@php
if ($circle == 2) {
    $circle2 = 'filter blur-[0.5px] border-[1px] w-[12px] h-[12px] mr-[10px] border-'.$color;
}
if ($circle == 1) {
    $circle2 = 'filter blur-[0.5px] w-[12px] h-[12px] mr-[10px] bg-'.$color;
}
if ($circle == 0){
    $circle2 = 'w-[6px] ml-[2.3px] mr-[13px] h-[6px] bg-'.$color;
}
@endphp
<li
    class="flex text-[12px] h-[27px] pl-[10px] dark:text-gris-20 items-center hover:bg-gris-70  transition-colors duration-300 ease-in-out"><div class="{{$circle2}} rounded-[50%] shadow-[1px] "></div>
    <a @click="{{$function}}" class="w-full cursor-pointer" @unless($function) href="{{ $href }}" wire:navigate @endunless >{{$slot}}</a>
</li>

