@props(['fill'=>'currentColor','grosor'=>'2'])

<svg width="21" height="19" viewBox="0 0 21 19" fill="none" xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => '']) }}>
    <rect y="1" width="2.81638" height="2.81638" rx="1" fill="{{ $fill }}" />
    <rect y="5.88184" width="2.81638" height="2.81638" rx="1" fill="{{ $fill }}"/>
    <rect y="10.7637" width="2.81638" height="2.81638" rx="1" fill="{{ $fill }}"/>
    <rect y="15.645" width="2.81638" height="2.81638" rx="1" fill="{{ $fill }}"/>
    <path d="M5.69531 1.81348H19.5269" stroke="{{ $fill }}" stroke-width="{{$grosor}}" stroke-linecap="round"/>
    <path d="M5.69531 7.50879H19.5269" stroke="{{ $fill }}" stroke-width="{{$grosor}}" stroke-linecap="round"/>
    <path d="M5.69531 12.3906H19.5269" stroke="{{ $fill }}" stroke-width="{{$grosor}}" stroke-linecap="round"/>
    <path d="M5.69531 17.2725H19.5269" stroke="{{ $fill }}" stroke-width="{{$grosor}}" stroke-linecap="round"/>
</svg>
