@props(['id' => 1, 'maxWidth' => null])
@php
    $maxWidth = [
    'xs' => 'sm:max-w-[265px]',
    'sm' => 'sm:max-w-sm',
    'md' => 'sm:max-w-md',
    'lg' => 'sm:max-w-lg',
    'xl' => 'sm:max-w-xl',
    '2xl' => 'sm:max-w-2xl',
    'fit'=> 'sm:max-w-fit',
    'full'=> 'sm:max-w-full'
][$maxWidth ?? '2xl'];
@endphp
<div
    x-data="{ show: false }"
    x-on:close.stop="show = false"
    x-on:keydown.escape.window="show =false"
    x-show="show"
    :id="$id" :maxWidth="$maxWidth" {{ $attributes }}
    class="jetstream-modal fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50"
    style="display: none;"
    @modal{{ $id }}.window="show=!show"
>
    <div x-show="show" class="fixed inset-0 transform transition-all" x-on:click="show = false" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0">
        <div class="absolute inset-0 bg-black/70 "></div>
    </div>
    <div class="flex items-center h-full justify-center">
    <div x-show="show" class="bg-gris-90 border-[0.5px] border-gris-80 rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full {{ $maxWidth }} sm:mx-auto"
                    x-trap.inert.noscroll="show"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                    <div class="px-6 py-4">
                        <div class="text-lg font-medium text-gris-10">
                            {{ $title }}
                        </div>

                        <div class="mt-4 text-[15px] text-gray-400">
                            {{ $content }}
                        </div>
                    </div>

                    <div class="flex flex-row justify-end px-6 py-4 bg-gris-90 text-end">
                        {{ $footer }}
                    </div>
    </div>
    </div>
</div>



