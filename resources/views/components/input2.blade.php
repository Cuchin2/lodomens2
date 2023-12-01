@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'dark:bg-black mt-[11px] border-none h-[30px] dark:text-gris-40 text-[12px] rounded-[20px] focus:ring-gris-50 focus:border-gris-50 block w-full pl-10 p-2 ']) !!}>
