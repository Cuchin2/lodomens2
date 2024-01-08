@props(['title'])
<div class="bg-gris-90 py-[3px]
text-gris-10 md:py-[10px] text-center">
    <h1 class="font-bold hidden md:block">{{ $title }}</h1>
    <div class="h-[22px] md:h-[25.19px] mx-auto ">
        <nav class="flex px-9 mt-[4px ]md:mt-[8px] dark:border-gray-700  font-normal text-[12px] leading-[16.80px]"
            aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-1 mx-auto">
                <li class="inline-flex items-center">
                    <a href="{{route('root')}}" wire:navigate
                        class="inline-flex items-center text-sm font-medium  dark:hover:text-white">

                        Inicio
                    </a>
                </li>
                {{$slot}}
            </ol>
        </nav>
    </div>

</div>
