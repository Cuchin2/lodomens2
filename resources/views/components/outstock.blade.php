@props(['url','stock','name','text'=>'text-[14px]'])

<lodo class=" relative items-center h-fit w-fit mx-auto">
    {{ $slot }}
<img src="{{ asset('storage/'.($url ?? '')) }}"
{{ $attributes->merge(['class' => 'mx-auto ']) }}
    alt="{{ $name }}" >
    <div class="absolute top-0 left-0 w-[100%] h-full flex items-center justify-center {{ $stock > 0 ? 'border-[2px]  border-corp-50 rounded-[3px]':'bg-black/80 border-[2px] border-corp-50 rounded-[3px]' }}   "> @if ($stock < 1)
        <span class="text-gris-20 {{ $text }} font-bold bg-gris-90 p-2 border-[2px]  border-corp-50 rounded-[3px]">SIN STOCK</span>  @endif
    </div>
</lodo>
