@props(['fill'=>'currentColor','grosor'=>'0'])

<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 20 20" xml:space="preserve" {{ $attributes->merge(['class' => '']) }}>
    <g id="ico-menu" >
        <path stroke-width="{{$grosor}}" stroke="{{$fill}}" d="M19.1,4.5H0.9c-0.3,0-0.6-0.3-0.6-0.6s0.3-0.6,0.6-0.6h18.3c0.3,0,0.6,0.3,0.6,0.6S19.5,4.5,19.1,4.5z"></path>
        <path stroke-width="{{$grosor}}" stroke="{{$fill}}" d="M19.1,10.6H0.9c-0.3,0-0.6-0.3-0.6-0.6s0.3-0.6,0.6-0.6h18.3c0.3,0,0.6,0.3,0.6,0.6S19.5,10.6,19.1,10.6z"></path>
        <path stroke-width="{{$grosor}}" stroke="{{$fill}}" d="M19.1,16.7H0.9c-0.3,0-0.6-0.3-0.6-0.6c0-0.3,0.3-0.6,0.6-0.6h18.3c0.3,0,0.6,0.3,0.6,0.6
            C19.8,16.4,19.5,16.7,19.1,16.7z"></path>
    </g>
</svg>
