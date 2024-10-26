@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'w-full border border-gris-70
bg-gris-90 text-gris-5 focus:border-gris-50 focus:ring-gris-80 placeholder-gris-50 height: 30px rounded-[3px] text-[12px]
h-[30px]' . ($disabled ? ' bg-gris-100 cursor-not-allowed' : ' ')]) !!}>


<style>
    /* Estilo para ocultar las flechas del input number */
    input[type=number] {
        -moz-appearance: textfield;
        appearance: textfield;
    }

    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>

