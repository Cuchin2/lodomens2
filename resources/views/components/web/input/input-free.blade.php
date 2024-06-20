@props(['title'=>'','span'=>false])


<div class="relative w-full">
    <div class=" relative flex">
        <p class="flex items-center">{{ $title }} @if ($span) <span class="text-corp-50">*</span>@endif</p>
        <input
            {{ $attributes->merge(['class' => 'ml-2 w-full focus:ring-black bg-transparent border-0  focus:border-transparent focus:placeholder-gris-70 placeholder-gris-30 text-[12px] p-1']) }}>
    </div>

    <hr class="absolute border-t-[1px] border-0 border-gris-70 p-2 w-full z-20 top-[26px]">
</div>
