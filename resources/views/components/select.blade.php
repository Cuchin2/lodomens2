<select name="secondary_color_select" id="secondary_color_select"
{{ $attributes->merge(['class' => 'text-gris-60 bg-black h-[30px]  text-[12px]  rounded-[3px] focus:ring-gris-50 focus:border-gris-50 w-full p-0 pl-2']) }}>
<option disabled selected>Ordenar por</option>
{{ $slot }}
</select>
