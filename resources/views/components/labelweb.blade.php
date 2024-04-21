@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-normal text-[15px] mb-2']) }}>
    {{ $value ?? $slot }}
</label>
