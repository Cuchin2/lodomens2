@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-normal text-[14px] text-gris-20']) }}>
    {{ $value ?? $slot }}
</label>
