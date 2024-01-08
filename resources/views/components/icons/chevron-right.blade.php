@props(['height','width','fill'=>'currentColor','grosor'=>'0'])

<svg version="1.1" height="{{$height}}" width="{{$width}}" fill="{{$fill}}" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 20 20" {{ $attributes->merge(['class' => '']) }} xml:space="preserve">
    <g id="ico-chevron-right" >
        <path stroke-width="{{$grosor}}" stroke="{{$fill}}" class="st1" d="M5.5,19.5c-0.1,0-0.3,0-0.4-0.1c-0.2-0.2-0.2-0.5,0-0.7l8.6-8.6L5.1,1.4C5,1.2,5,0.8,5.1,0.6s0.5-0.2,0.7,0
            l9,9c0.2,0.2,0.2,0.5,0,0.7l-9,9C5.8,19.5,5.6,19.5,5.5,19.5L5.5,19.5z"></path>
    </g>
</svg>
