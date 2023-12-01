@props(['fill'=>'currentColor','grosor'=>'0'])

<svg version="1.1"  fill="{{$fill}}" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 20 20" xml:space="preserve" {{ $attributes->merge(['class' => '']) }}>
    <g id="Info">
        <g>
            <g>
                <g>
                    <path stroke-width="{{$grosor}}" stroke="{{$fill}}" d="M9.8,12.9c-0.3,0-0.5-0.2-0.5-0.5v-2c0-0.3,0.2-0.5,0.5-0.5c0.7,0,1.2-0.2,1.6-0.6c0.4-0.4,0.6-1,0.6-1.8      c0-0.8-0.5-1.4-1.2-1.7c-0.8-0.3-1.6-0.1-2.2,0.5c-0.2,0.2-0.5,0.2-0.7,0C7.7,6,7.7,5.7,7.9,5.5c0.9-0.9,2.2-1.1,3.3-0.7      C12.3,5.3,13,6.3,13,7.5c0,1-0.3,1.9-0.9,2.5c-0.5,0.5-1.1,0.8-1.8,0.9v1.5C10.3,12.6,10,12.9,9.8,12.9z"/>
                </g>
                <g>
                    <circle stroke-width="{{$grosor}}" stroke="{{$fill}}" cx="9.8" cy="14.9" r="0.7"/>
                </g>
            </g>
            <g>
                <path stroke-width="{{$grosor}}" stroke="{{$fill}}" d="M10,18c-4.3,0-7.9-3.5-7.9-7.9S5.7,2.2,10,2.2c4.3,0,7.9,3.5,7.9,7.9S14.3,18,10,18z M10,3.2c-3.8,0-6.9,3.1-6.9,6.9     S6.2,17,10,17c3.8,0,6.9-3.1,6.9-6.9S13.8,3.2,10,3.2z"/>
            </g>
        </g>
    </g>
</svg>
