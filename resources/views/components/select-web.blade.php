<select
{{ $attributes->merge(['class' => 'cursor-pointer text-gris-5 dark:placeholder:text-gris-40 bg-gris-100 h-[30px] dark:border-gris-50 text-[12px]  rounded-[3px] focus:ring-gris-50 focus:border-gris-70 w-full p-0 pl-2 bar']) }}>
{{--  <option disabled selected>Ordenar por</option>  --}}
{{ $slot }}
</select>
