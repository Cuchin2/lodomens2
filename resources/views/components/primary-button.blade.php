@props(['href'])

@if(isset($href))
<a {{ $attributes->merge(['type' => 'button','href'=>$href ,'class' => 'inline-flex items-center justify-center px-4 py-2 bg-blue-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150']) }} >
    {{ $slot }}
</a>
@else
<button {{ $attributes->merge(['type' => 'button','class' => 'inline-flex items-center justify-center px-4 py-2 bg-blue-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
@endif

