@props(['href'=>'#','active'=>false,'icon'=>''])
@php

$classes = ($active ?? false)
            ? 'text-corp-30'
            : '';
@endphp

<li class="mr-6 p-1 ">
    <a {{ $attributes->merge(['class' =>"hover:text-corp-30 $classes"]) }}  href="{{$href}}">{{ $slot }}</a>
</li>