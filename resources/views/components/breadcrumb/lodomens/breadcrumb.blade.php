@props(['title'])
<div class="fixed w-full z-40">
<div class="bg-gris-90 py-[3px]
text-gris-10 md:py-[10px] text-center">

    <h3 class="font-bold hidden md:block" >{{ $title }}</h3>
    <div class="h-[22px] md:h-[25.19px] mx-auto ">
        <nav class="flex px-9 mt-[4px ]md:mt-[8px] dark:border-gray-700  font-normal text-[12px] leading-[16.80px]"
            aria-label="Breadcrumb">
            <ol class="inline-flex items-baseline space-x-1 md:space-x-1 mx-auto">
                <li class="md:inline-flex items-center hidden">
                    <a href="{{route('root')}}" wire:navigate
                        class="inline-flex items-center text-sm font-medium  dark:hover:text-white">

                        Inicio
                    </a>

                </li>
                <li class="md:inline-flex items-center hidden">

                <svg class="w-2 h-2 mx-1 text-gris-40" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                  </svg>
                </li>
                {{$slot}}
            </ol>
        </nav>
    </div>
</div>
</div>
