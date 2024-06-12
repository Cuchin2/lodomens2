@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'w-full border dark:border-gris-70 
dark:bg-gris-90 dark:text-gris-30 dark:focus:border-gris-50 dark:focus:ring-gris-50 dark:placeholder-gris-50 height: 30px rounded-md text-[12px]
h-[30px]' . ($disabled ? ' dark:bg-gris-100 cursor-not-allowed' : ' ')]) !!}>
