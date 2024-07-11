<select
{{ $attributes->merge(['class' => 'border dark:border-gris-70
dark:bg-gris-90 dark:text-gris-30 dark:focus:border-gris-50 dark:focus:ring-gris-50 dark:placeholder-gris-50 height: 30px rounded-[3px] text-[12px]
h-[30px] w-full p-0 pl-2 bar']) }}>
{{--  <option disabled selected>Ordenar por</option>  --}}
{{ $slot }}
</select>
