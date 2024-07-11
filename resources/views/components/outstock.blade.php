@props(['url','stock','name','text'=>'text-[14px]'])

<lodo {{ $attributes->merge(['class' => ' relative items-center  flex max-w-[200px] max-h-[200px] mx-auto']) }}>
    {{ $slot }}
<img src="{{ asset('storage/'.($url ?? '')) }}"
class = "mx-auto w-full h-full"
    alt="{{ $name }}" >
    <div class="absolute top-0 left-0 w-[100%] h-full flex items-center justify-center {{ $stock > 0 ? 'border-[2px]  border-corp-50 rounded-[3px]':'bg-black/80 border-[2px] border-corp-50 rounded-[3px]' }}   "> @if ($stock < 1)
        <span class="text-gris-20 {{ $text }} font-bold  bg-gris-90 p-2 border-[2px]  border-corp-50 rounded-[3px]">SIN STOCK</span>  @endif
    </div>
</lodo>
