@props(['number'=>'','margen'=>'left-[4px] text-[10px] bottom-[0px]'])
@php
    if($number === '1')
    {
        $margen = 'left-[5px] text-[10px] bottom-[0px]';
    }

    if($number === '7')
        {
            $margen = 'left-[4.5px] text-[10px] bottom-[0px]';
        }
    if($number > 9)
        {
            $margen = 'left-[3.5px] text-[14px] bottom-[-2.8px]';
            $number = '+';
        }
@endphp
<span {{ $attributes->merge(['class' => 'absolute top-[-3.5px] right-[-6px] flex  items-center justify-center']) }}>
    <span class="inline-flex h-[14px] w-[14px] rounded-full bg-corp-50"><p class="text-white absolute {{ $margen }} ">{{ $number }}</p></span>
</span>
