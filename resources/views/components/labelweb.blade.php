@props(['value'])

<label {{ $attributes->merge(['class' => 'flex block font-normal text-[15px] mb-2']) }}>
    {{ $value ?? $slot }}
</label>
