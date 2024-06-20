@props(['submit'])

<div {{ $attributes->merge(['class' => '']) }}>
{{--      <x-section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-section-title>  --}}

    <div class="">
        <form wire:submit="{{ $submit }}">
            <div class="px-4 py-5 sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
                <div class="flex space-x-5">
                    {{ $form }}
                </div>
            </div>

            @if (isset($actions))
            <div class="sm:px-6 px-4  shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
                <x-label>Correo electrónico</x-label>
                <input
                class="pointer-events-nonew-full focus:ring-black bg-transparent border-0 border-b-[1px] border-gris-70 focus:border-b-[1px] focus:border-gris-70 focus:placeholder-gris-70 placeholder-gris-30"
                type="text"  value="{{ auth()->user()->email }}" disabled
               >
            </div>
                <div class="flex items-center justify-end px-4 py-3 text-end sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                    {{ $actions }}
                </div>
            @endif
        </form>
    </div>
</div>
