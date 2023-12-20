@props(['fill'=>'currentColor','grosor'=>'0'])

<svg  viewBox="0 0 10 7" fill="none" xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => '']) }}>
    <path d="M9 1.42426L5.21302 5.54547L1 1.42426" stroke-width="{{$grosor}}" stroke="{{$fill}}" stroke-miterlimit="10" stroke-linecap="round"/>
</svg>
