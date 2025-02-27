@php
if (! isset($scrollTo)) {
    $scrollTo = 'body';
}

$scrollIntoViewJsSnippet = ($scrollTo !== false)
    ? <<<JS
       (\$el.closest('{$scrollTo}') || document.querySelector('{$scrollTo}')).scrollIntoView()
    JS
    : '';
@endphp

<div class="w-full">
    @if ($paginator->hasPages())
        <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center">
            <div class="flex justify-between flex-1 sm:hidden">
                <span>
                    @if ($paginator->onFirstPage())
                        <span class="relative inline-flex items-center px-4 py-2 text-[12px] font-medium text-gris-10 bg-gris-70 border border-gris-80 cursor-default leading-5 rounded-md select-none">
                            {!! __('pagination.previous') !!}
                        </span>
                    @else
                        <button type="button" wire:click="previousPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled" dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.before" class="relative inline-flex items-center px-4 py-2 text-[12px] font-medium text-gris-10 darK:bg-gris-70 border border-gris-80 leading-5 rounded-md hover:text-gris-10 focus:outline-none focus:shadow-outline-blue focus:border-gris-60 active:bg-gris-60 active:text-gris-30 transition ease-in-out duration-150">
                            {!! __('pagination.previous') !!}
                        </button>
                    @endif
                </span>

                <span>
                    @if ($paginator->hasMorePages())
                        <button type="button" wire:click="nextPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled" dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.before" class="relative inline-flex items-center px-4 py-2 ml-3 text-[12px] font-medium text-gris-10 darK:bg-gris-70 border border-gris-80 leading-5 rounded-md hover:text-gris-10 focus:outline-none  focus:border-gris-70 active:bg-gris-60 active:text-gris-30 transition ease-in-out duration-150">
                            {!! __('pagination.next') !!}
                        </button>
                    @else
                        <span class="relative inline-flex items-center px-4 py-2 ml-3 text-[12px] font-medium text-gris-10 darK:bg-gris-70 border border-gris-80 cursor-default leading-5 rounded-md select-none">
                            {!! __('pagination.next') !!}
                        </span>
                    @endif
                </span>
            </div>

            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div class="mx-auto">
                    <p class="text-gris-40  items-center mx-auto text-[12px] font-inter font-normalwhitespace-normal leading-5">
                        <span>{!! __('Showing') !!}</span>
                        <span class="font-medium">{{ $paginator->firstItem() }}</span>
                        <span>{!! __('to') !!}</span>
                        <span class="font-medium">{{ $paginator->lastItem() }}</span>
                        <span>{!! __('of') !!}</span>
                        <span class="font-medium">{{ $paginator->total() }}</span>
                        <span>{!! __('results') !!}</span>
                    </p>
                </div>

                <div>
                    <span class="relative z-0 inline-flex rounded-md shadow-sm">
                        <span>
                            {{-- Previous Page Link --}}
                            @if ($paginator->onFirstPage())
                                <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                                    <span class="relative inline-flex items-center px-2 py-2 text-[12px] font-medium text-gris-80 darK:bg-gris-70 border border-gris-80 cursor-default rounded-l-md leading-5" aria-hidden="true">
                                        {{ __('pagination.previous') }}
                                    </span>
                                </span>
                            @else
                                <button type="button" wire:click="previousPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.after" rel="prev" class="relative inline-flex items-center px-2 py-2 text-[12px] font-medium text-gris-30 darK:bg-gris-70 border border-gris-80 rounded-l-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none  active:text-white transition ease-in-out duration-150" aria-label="{{ __('pagination.previous') }}">
                                    {{ __('pagination.previous') }}
                                </button>
                            @endif
                        </span>

                        {{-- Pagination Elements --}}
                        @foreach ($elements as $element)
                            {{-- "Three Dots" Separator --}}
                            @if (is_string($element))
                                <span aria-disabled="true">
                                    <span class="relative inline-flex items-center px-4 py-2 -ml-px text-[12px] font-medium text-gris-10 darK:bg-gris-70 border border-gris-80 cursor-default leading-5 select-none">{{ $element }}</span>
                                </span>
                            @endif

                            {{-- Array Of Links --}}
                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    <span wire:key="paginator-{{ $paginator->getPageName() }}-page{{ $page }}">
                                        @if ($page == $paginator->currentPage())
                                            <span aria-current="page">
                                                <span class="relative inline-flex items-center px-4 py-2 -ml-px text-[12px] font-medium text-gris-10 rounded-[10px] bg-gris-70 border border-gris-80 cursor-default leading-5 select-none">{{ $page }}</span>
                                            </span>
                                        @else
                                            <button type="button" wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" class="relative inline-flex items-center px-4 py-2 -ml-px text-[12px] font-medium text-gris-30 darK:bg-gris-70 border border-gris-80 leading-5 hover:text-gris-10 {{--  focus:z-10 focus:outline-none focus:border-gris-60 focus:shadow-outline-gris   --}} {{--  active:bg-gris-60  --}} active:text-white transition ease-in-out duration-150" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                                {{ $page }}
                                            </button>
                                        @endif
                                    </span>
                                @endforeach
                            @endif
                        @endforeach

                        <span>
                            {{-- Next Page Link --}}
                            @if ($paginator->hasMorePages())
                                <button type="button" wire:click="nextPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.after" rel="next" class="relative inline-flex items-center px-2 py-2 -ml-px text-[12px] font-medium text-gris-30 darK:bg-gris-70 border border-gris-80 rounded-r-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none active:text-white transition ease-in-out duration-150" aria-label="{{ __('pagination.next') }}">
                                    {{ __('pagination.next') }}
                                </button>
                            @else
                                <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                                    <span class="relative inline-flex items-center px-2 py-2 -ml-px text-[12px] font-medium text-gris-80 darK:bg-gris-70 border border-gris-80 cursor-default rounded-r-md leading-5" aria-hidden="true">
                                        {{ __('pagination.next') }}
                                    </span>
                                </span>
                            @endif
                        </span>
                    </span>
                </div>
            </div>
        </nav>
    @endif
</div>
