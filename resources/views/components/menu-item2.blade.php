@props(['href'=>'#','active'=>false,'icon'=>''])
@php

$classes = ($active ?? false)
            ? 'text-corp-30'
            : 'text-gris-30'
@endphp

<li class="mr-6 p-2" >
    <a x-show="open" x-cloak x-transition.duration.300ms {{ $attributes->merge(['class' =>"hover:text-corp-30 font-bold md:text-[14px] lg:text-[16px] $classes"]) }}  href="{{$href}}">{{ $slot }}</a>
</li>
