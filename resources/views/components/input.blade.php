@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'w-full border-gray-300 h-[30px] dark:border-gris-70 dark:bg-gris-90 dark:text-gris-30 focus:border-cop-50 dark:focus:border-corp-70 focus:ring-corp-50 dark:focus:ring-corp-70 rounded-md shadow-sm text-[12px]' . ($disabled ? ' dark:bg-gris-100 cursor-not-allowed' : ' ')]) !!}>
