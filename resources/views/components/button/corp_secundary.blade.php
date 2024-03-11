@props(['href'=>'','type'=>'button'])

<button {{ $attributes->merge(['class' => 'h-[30px] text-white px-1 bg-gris-60 hover:bg-gris-90 rounded-lg overflow-hidden flex items-center justify-center mx-[5px]']) }}@if ($href)
    href="{{$href}}"
@endif  type="{{ $type }}">
    <div class="flex items-center justify-center mx-[10px]">
    {{-- <x-icons.plus class="h-[12px] w-[12px] fill-white mx-[3px]" grosor="1"></x-icons.plus> --}}

    <div class="text-center text-[12px] font-inter font-normal leading-4 whitespace-normal my-[4px] mx-[10px]">
        {{$slot}}
    </div>
  </div>
</button>
