@props(['fill'=>'currentColor','grosor'=>'0.8'])
<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => '']) }}>
    <rect x="0.5" y="0.5" width="7.52632" height="7.52632" rx="1.5" stroke="{{ $fill }}"/>
    <rect x="0.5" y="9.97363" width="7.52632" height="7.52632" rx="1.5" stroke="{{ $fill }}"/>
    <rect x="9.97363" y="0.5" width="7.52632" height="7.52632" rx="1.5" stroke="{{ $fill }}"/>
    <rect x="9.97363" y="9.97363" width="7.52632" height="7.52632" rx="1.5" stroke="{{ $fill }}"/>
</svg>
