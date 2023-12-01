<!-- Breadcrumb -->
<div class="item-center flex h-[25.19px] ml-auto">
    <nav class="flex px-9 mt-[8px] dark:text-gris-40 dark:border-gray-700 float-right font-normal text-[12px] leading-[16.80px]" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-1">
            <li class="inline-flex items-center">
                <a href="{{route('dashboard')}}" wire:navigate
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gris-40 dark:hover:text-gris-10">
{{--                     <svg class="w-3 h-3 mb-[3px] mr-[4px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                    </svg> --}}
                    Inicio
                </a>
            </li>
            {{$slot}}
        </ol>
    </nav>
</div>
