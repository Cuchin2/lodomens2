@props(['fill'=>'currentColor','grosor'=>'0'])

<svg version="1.1"  fill="{{$fill}}" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 20 20" style="enable-background:new 0 0 20 20; display: inherit;" xml:space="preserve" {{ $attributes->merge(['class' => '']) }}>

    <g id="Pencil">
        <path stroke-width="{{$grosor}}" stroke="{{$fill}}" d="M18.1,2.8l-1.1-1c-0.3-0.3-0.8-0.5-1.3-0.4c-0.5,0.1-0.9,0.3-1.3,0.6l-1,1c0,0,0,0,0,0L2.6,14.1c-0.1,0.1-0.1,0.1-0.1,0.2
            l-1,3.8c0,0.2,0,0.3,0.1,0.4c0.1,0.1,0.2,0.1,0.3,0.1c0,0,0.1,0,0.1,0l3.8-1.1c0,0,0,0,0,0c0.1,0,0.1,0,0.2-0.1c0,0,0,0,0,0
            L16.9,6.4c0,0,0,0,0,0l1-1C18.7,4.6,18.7,3.4,18.1,2.8z M3.2,15.3l1.7,1.6l-2.3,0.6L3.2,15.3z M5.7,16.5l-2.2-2.1L13.8,3.9L16,6
            L5.7,16.5z M17.2,4.7l-0.6,0.6l-2.2-2.1l0.6-0.6c0.2-0.2,0.5-0.3,0.7-0.4c0.2,0,0.4,0,0.6,0.2l1.1,1C17.7,3.7,17.6,4.3,17.2,4.7z"
            />
    </g>
</svg>
