@props(['name','href'])
@if (isset($href))
<li>
    <div  {{ $attributes->merge(['class' => 'flex items-center']) }}>
        <a href="{{$href}}" wire:navigate
            class="ml-1 text-sm font-medium text-gris-10  md:ml-2 text-gris-40 hover:text-white">{{$name}}</a>
    </div>
</li>
<li {{ $attributes->merge(['class' => 'inline-flex items-center']) }}>
    <svg class="w-2 h-2 mx-1 text-gris-40" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
        viewBox="0 0 6 10">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
    </svg>
</li>
@else
<li aria-current="page">
    <div class="flex items-center">
        <span class="text-sm font-medium  md:ml-1 text-gris-30">{{$name}}</span>
    </div>
</li>
@endif
