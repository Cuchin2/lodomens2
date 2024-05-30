{{--  <button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>  --}}

{{--  <button {{ $attributes->merge(['class' => 'bg-gradient-to-b from-corp-20 via-corp-50 to-corp-90  text-gris-10 rounded-[3px] px-4 font-bold h-[36px]']) }}>
    {{ $slot }}
</button>  --}}
{{--  <button {{ $attributes->merge(['class' => 'bg-gradient-to-b from-corp-20 via-corp-50 to-corp-90 text-gris-10 rounded-[3px] px-4 font-bold h-[36px] focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>  --}}

<button  class="text-gris-10 bg-gradient-to-b from-corp-20 via-corp-50 to-corp-90 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-gris-20 dark:focus:ring-corp-90 font-bold rounded-lg text-sm px-4 py-2 text-center me-2 mb-2">{{ $slot }}

</button>