<div class="item-center flex h-[25.19px] ml-auto">
    <nav class="flex px-9 mt-[8px] dark:text-gris-40 dark:border-gray-700 float-right font-normal text-[12px] leading-[16.80px]" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-1">
            <li class="inline-flex items-center">
                <a href="{{route('dashboard')}}" wire:navigate
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gris-40 dark:hover:text-gris-10">

                    Inicio
                </a>
            </li>
            {{$slot}}
        </ol>
    </nav>
</div>
