@props(['name', 'id', 'icon' => '','active'=>false,])

<div x-data="{ open:true, go:false, consult:@json($active)}" x-show="open" x-init="if(consult) openItem = {{ $id }};">
    <div class="hover:bg-gris-70 my-[5px]{{-- border-l-4 border-teal-500 --}}"
        :class="{ 'bg-gris-80': openItem === {{$id}} }">
        <a href="#"
            class="flex items-center h-[36px]  {{-- bg-teal-600 rounded-lg --}} transition-colors duration-300 pl-[13px] ease-in-out focus:outline-none focus:shadow-outline"
            @click="openItem === {{$id}} ? openItem = null : openItem = {{$id}}"
            
            >
            @if($active == true)
            <div class="border-r-4 rounded-r-[4px] border-corp-30 w-[5px] h-full ml-[-9px] mr-[2px]"></div>
            @endif
            <span class="flex mr-auto {{ $active ? 'text-corp-30' : '' }}">
                
                {{$icon}}
                <p class="ml-2 font-normal {{ $active ? 'text-white' : 'dark:text-gris-20' }} duration-300 transition-none ease-in-outtransition-none w-[100px]"
                :class="{
                    'opacity-100': isSidebarExpanded,
                    'opacity-0': !isSidebarExpanded,
                    '!text-white': openItem === {{$id}}
                }">
                    {{$name}}</p>
            </span>
            <svg :class="{ 'rotate-90': openItem === {{$id}} }" xmlns="http://www.w3.org/2000/svg"
                class="h-[13px] w-[13px] mr-[8px] transition-transform ease-in-out right-0 left-0"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </a>
    </div>
    <ul x-show="openItem === {{$id}}" class="w-[186px] ml-[7px] mr-[8px] bg-gris-80 rounded-[8px] " :class="{ 'hidden': !isSidebarExpanded, 'block': isSidebarExpanded }" x-collapse.duration.400ms x-cloak>

        {{$slot}}
    </ul>
</div>
