<select
{{ $attributes->merge(['class' => 'border border-gris-70
bg-gris-90 text-gris-30 focus:border-gris-50 focus:ring-gris-50 placeholder-gris-50 height: 30px rounded-[3px] text-[12px]
h-[30px] w-full p-0 pl-2 bar']) }}>
{{--  <option disabled selected>Ordenar por</option>  --}}
{{ $slot }}
</select>
