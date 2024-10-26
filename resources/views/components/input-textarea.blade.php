@props(['disabled' => false, 'col'=>''])

<textarea {{ $disabled ? 'disabled' : '' }}

{!! $attributes->merge(['class' => ' bar w-full border-gris-70 bg-gris-90 text-gris-5 focus:border-gris-50 focus:border-gris-50 focus:ring-gris-50 focus:ring-gris-80 rounded-lg shadow-sm text-[12px] placeholder-gris-50 focus:outline-none', 'rows' => $col]) !!}>
{{$slot}}</textarea>
