<div class="w-full">
    @if ($links && $links->isNotEmpty())
        <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between flex-wrap gap-4">
            <div class="flex justify-between flex-1 sm:hidden w-full">
                <span>
                    @php
                        $prevLink = $links->firstWhere('label', 'Anterior');
                    @endphp
                    @if (!$prevLink || blank($prevLink['url']))
                        <span class="relative inline-flex items-center px-4 py-2 text-[12px] font-medium text-gris-10 bg-transparent border border-gris-80 cursor-default leading-5 rounded-md select-none">
                            {!! __('pagination.previous') !!}
                        </span>
                    @else
                        <button type="button"
                                wire:click="setPagina('{{ Str::after($prevLink['url'], 'page=') }}')"
                                wire:loading.attr="disabled"
                                dusk="previousPage.before"
                                class="relative inline-flex items-center px-4 py-2 text-[12px] font-medium text-gris-30 bg-transparent border border-gris-80 leading-5 rounded-md hover:text-gris-10 focus:outline-none transition ease-in-out duration-150">
                            {!! __('pagination.previous') !!}
                        </button>
                    @endif
                </span>

                <span>
                    @php
                        $nextLink = $links->filter(fn($item) => $item['label'] === 'Siguiente')->last();
                    @endphp
                    @if (!$nextLink || blank($nextLink['url']))
                        <span class="relative inline-flex items-center px-4 py-2 ml-3 text-[12px] font-medium text-gris-10 bg-transparent border border-gris-80 cursor-default leading-5 rounded-md select-none">
                            {!! __('pagination.next') !!}
                        </span>
                    @else
                        <button type="button"
                                wire:click="setPagina('{{ Str::after($nextLink['url'], 'page=') }}')"
                                wire:loading.attr="disabled"
                                dusk="nextPage.before"
                                class="relative inline-flex items-center px-4 py-2 ml-3 text-[12px] font-medium text-gris-30 bg-transparent border border-gris-80 leading-5 rounded-md hover:text-gris-10 focus:outline-none transition ease-in-out duration-150">
                            {!! __('pagination.next') !!}
                        </button>
                    @endif
                </span>
            </div>

            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between w-full sm:w-auto">
                <div class="mx-auto text-center sm:text-left">
                    @php
                        $currentPage = $links->firstWhere('active', true)['label'] ?? 1;
                        $totalPages = $links->filter(fn($link) => is_numeric($link['label']))->count();
                    @endphp
                    <p class="text-gris-40 text-[12px] font-inter font-normal whitespace-normal leading-5">
                        <span>{!! __('Showing') !!}</span>
                        <span class="font-medium">{{ $currentPage }}</span>
                        <span>{!! __('to') !!}</span>
                        <span class="font-medium">{{ $totalPages > 0 ? $totalPages : 1 }}</span>
                        <span>{!! __('of') !!}</span>
                        <span class="font-medium">{{ $totalPages }}</span>
                        <span>{!! __('results') !!}</span>
                    </p>
                </div>

                <div>
                    <span class="relative z-0 inline-flex rounded-md shadow-sm">
                        @php
                            $prevLink = $links->firstWhere('label', 'Anterior');
                        @endphp
                        @if (!$prevLink || blank($prevLink['url']))
                            <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                                <span class="relative inline-flex items-center px-2 py-2 text-[12px] font-medium text-gris-80 bg-transparent border border-gris-80 cursor-default rounded-l-md leading-5" aria-hidden="true">
                                    {{ __('pagination.previous') }}
                                </span>
                            </span>
                        @else
                            <button type="button"
                                    wire:click="setPagina('{{ Str::after($prevLink['url'], 'page=') }}')"
                                    dusk="previousPage.after"
                                    rel="prev"
                                    class="relative inline-flex items-center px-2 py-2 text-[12px] font-medium text-gris-30 bg-transparent border border-gris-80 rounded-l-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none transition ease-in-out duration-150"
                                    aria-label="{{ __('pagination.previous') }}">
                                {{ __('pagination.previous') }}
                            </button>
                        @endif

                        @foreach ($links as $link)
                            @if (is_numeric($link['label']))
                                <button type="button"
                                        wire:click="setPagina('{{ $link['label'] }}')"
                                        class="relative inline-flex items-center px-4 py-2 -ml-px text-[12px] font-medium text-gris-30 border border-transparent rounded-[3px] leading-5 hover:text-gris-10 active:text-gris-70 transition ease-in-out duration-150"
                                        aria-label="{{ __('Go to page :page', ['page' => $link['label']]) }}"
                                        :class="{ ' !text-gris-10 bg-gris-70  border-gris-70': {{ $link['active'] ? 'true' : 'false' }} }">
                                    {{ $link['label'] }}
                                </button>
                            @elseif ($link['label'] === '...')
                                <span aria-disabled="true">
                                    <span class="relative inline-flex items-center px-4 py-2 -ml-px text-[12px] font-medium text-gris-10 bg-transparent border border-gris-80 cursor-default leading-5 select-none">
                                        {{ $link['label'] }}
                                    </span>
                                </span>
                            @endif
                        @endforeach

                        @php
                            $nextLink = $links->filter(fn($item) => $item['label'] === 'Siguiente')->last();
                        @endphp
                        @if (!$nextLink || blank($nextLink['url']))
                            <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                                <span class="relative inline-flex items-center px-2 py-2 -ml-px text-[12px] font-medium text-gris-80 bg-transparent border border-gris-80 cursor-default rounded-r-md leading-5" aria-hidden="true">
                                    {{ __('pagination.next') }}
                                </span>
                            </span>
                        @else
                            <button type="button"
                                    wire:click="setPagina('{{ Str::after($nextLink['url'], 'page=') }}')"
                                    dusk="nextPage.after"
                                    rel="next"
                                    class="relative inline-flex items-center px-2 py-2 -ml-px text-[12px] font-medium text-gris-30 bg-transparent border border-gris-80 rounded-r-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none transition ease-in-out duration-150"
                                    aria-label="{{ __('pagination.next') }}">
                                {{ __('pagination.next') }}
                            </button>
                        @endif
                    </span>
                </div>
            </div>
        </nav>
    @endif
</div>


