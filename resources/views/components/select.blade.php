<select id="secondary_color_select"
{{ $attributes->merge(['class' => 'text-gris-30 bg-gris-100 h-[30px] dark:border-gris-50 text-[12px]  rounded-[3px] focus:ring-gris-50 focus:border-gris-70 w-full p-0 pl-2']) }}>
{{--  <option disabled selected>Ordenar por</option>  --}}
{{ $slot }}
</select>
