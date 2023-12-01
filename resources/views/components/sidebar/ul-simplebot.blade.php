@props(['href'=>'#','active'=>false,'icon'=>''])
@php

$classes = ($active ?? false)
            ? 'text-teal-500 dark:bg-gris-60 dark:bg-opacity-25'
            : 'pl-[5px]';
@endphp

<div {{ $attributes->merge(['class' =>"hover:bg-gris-70 border-t dark:bg-gris-90  dark:border-gris-80 $classes"]) }} :class="isSidebarExpanded ? 'w-[200px]' : 'w-[52px]'" >

<a href="{{$href}}"   class="flex items-center h-[36px] ml-[8px] rounded-lg w-full transition-colors duration-150 ease-in-out focus:outline-none focus:shadow-outline" wire:navigate>
    @if($active == true)
    <div class="border-r-4 rounded-r-[4px] border-teal-500 w-[5px] h-full ml-[-9px] mr-[9px]"></div>@endif
   @if($href !== '#') {{-- <img class="h-[20px] w-[20px]  filterit" src="{{$svg}}" alt=""> --}}

   {{$icon}}

   @endif
    <span class="{{$href !== '#' ? 'ml-2' : 'ml-8'}} {{$active === true ? 'text-white': 'text-gris-20'}} duration-150 ease-in-out font-normal" :class="isSidebarExpanded ? 'block' : 'hidden'">{{$slot}}</span>
  </a>
</div>
