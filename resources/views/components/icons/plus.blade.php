@props(['fill'=>'currentColor','grosor'=>'0'])

<svg version="1.1"  fill="{{$fill}}" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 20 20" style="enable-background:new 0 0 20 20; display: inherit;" xml:space="preserve" {{ $attributes->merge(['class' => '']) }}>
    <g id="ico-plus">
        <path stroke-width="{{$grosor}}" stroke="{{$fill}}" d="M19.1,9.4h-8.5V0.9c0-0.3-0.3-0.6-0.6-0.6S9.4,0.5,9.4,0.9v8.5H0.9c-0.3,0-0.6,0.3-0.6,0.6s0.3,0.6,0.6,0.6h8.5v8.5
            c0,0.3,0.3,0.6,0.6,0.6s0.6-0.3,0.6-0.6v-8.5h8.5c0.3,0,0.6-0.3,0.6-0.6S19.5,9.4,19.1,9.4z"></path>
    </g>
</svg>

