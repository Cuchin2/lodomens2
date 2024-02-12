@props(['href'=>'#','active'=>false,'icon'=>''])
@php

$classes = ($active ?? false)
            ? 'text-corp-30'
            : '';
@endphp

<li class="mr-6 p-1 ">
    <a {{ $attributes->merge(['class' =>"text-gris-10 hover:text-corp-30 text-[12px] $classes"]) }} href="{{$href}}">{{ $slot }}</a>
</li>
