@props(['submit'])

<div {{ $attributes->merge(['class' => '']) }}>
{{--      <x-section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-section-title>  --}}

    <div class="">
        <form wire:submit="{{ $submit }}">
            <div class="px-4 py-5 sm:p-5 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
                <div class="flex space-x-5">
                    {{ $form }}
                </div>
            </div>

            @if (isset($actions))

                <div class="flex items-center justify-end px-4 py-3 text-end sm:px-5 shadow sm:rounded-bl-md sm:rounded-br-md">
                    {{ $actions }}
                </div>
            @endif
        </form>
    </div>
</div>
