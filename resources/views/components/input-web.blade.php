@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'w-full text-gris-5 bg-gris-100 h-[30px] dark:border-gris-50 text-[12px]  dark:placeholder:text-gris-40 rounded-[3px] focus:ring-gris-50 focus:border-gris-70' . ($disabled ? ' dark:bg-gris-100 cursor-not-allowed' : ' ')]) !!}>
