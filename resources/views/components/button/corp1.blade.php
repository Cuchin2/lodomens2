@props(['href'=>'','type'=>'button','id'=>null])

<button x-data="{ loading:false }"
 @if($id) @accion{{ $id }}.window="loading = $event.detail; console.log('Botón {{ $id }} =>', $event.detail)" @endif
     x-bind:disabled="loading"
    :class="loading ? 'opacity-50 cursor-not-allowed' : ''"
{{ $attributes->merge(['class' => 'h-[30px] text-white px-1 bg-corp-50 hover:bg-corp-70 rounded-[3px] overflow-hidden flex items-center justify-center mx-[5px]']) }} @if ($href)
    href="{{$href}}"
@endif type="{{ $type }}">
    <div class="flex items-center justify-center mx-[10px]" >
    <div class="text-center text-[12px] font-inter font-normal leading-4 whitespace-normal my-[4px] mx-[10px]"

    >
           <!-- Label visible cuando NO está cargando -->
    <span x-show="!loading" x-cloak>{{ $slot }}</span>

    <!-- Spinner visible cuando loading = true -->
    <span x-show="loading" x-cloak class="flex items-center gap-2">
<div class="w-4 h-4 rounded-full animate-spin
                    border-2 border-solid  border-t-transparent"></div>
    Cargando ...

    </span>
    </div>
  </div>
</button>



