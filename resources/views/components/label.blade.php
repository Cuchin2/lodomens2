@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-normal text-[15px] text-gris-70 dark:text-gris-30']) }}>
    {{ $value ?? $slot }}
</label>
