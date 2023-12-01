@props(['fill'=>'currentColor','grosor'=>'0'])

<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="{{$fill}}" viewBox="0 0 20 20" {{ $attributes->merge(['class' => '']) }} >
    <g id="Arrow_down">
        <path stroke-width="{{$grosor}}" stroke="{{$fill}}" d="M15.6,13.3c-0.2-0.2-0.5-0.2-0.6,0l-4.6,4.3V1.3c0-0.2-0.2-0.5-0.5-0.5S9.4,1.1,9.4,1.3v16.3l-4.5-4.3
            c-0.2-0.2-0.5-0.2-0.6,0c-0.2,0.2-0.2,0.5,0,0.6l5.3,5c0,0,0,0,0,0l0,0c0,0,0,0,0.1,0c0,0,0,0,0.1,0c0.1,0,0.1,0,0.2,0
            c0.1,0,0.1,0,0.2,0c0,0,0,0,0.1,0c0,0,0,0,0.1,0l5.4-5C15.8,13.8,15.8,13.5,15.6,13.3z"/>
    </g>
</svg>
