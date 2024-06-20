@props(['title'=>'','span'=>false])


<div class=" w-full">

        <p class="flex items-center">{{ $title }} @if ($span) <span class="text-corp-50">*</span>@endif</p>
    <textarea
            {{ $attributes->merge(['class' => 'border border-gris-70 mt-1 w-full focus:ring-black bg-transparent focus:border-gris-50 rounded-[3px] focus:placeholder-gris-70 placeholder-gris-30 text-[12px] p-1']) }}>
    </textarea>


</div>
