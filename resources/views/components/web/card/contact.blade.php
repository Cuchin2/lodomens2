 @props(['title'=>''])

<div class="bg-gris-90 rounded-[3px] px-4 pb-4 h-fit">
    <div class="flex items-center">
        <div class="p-2 my-4 bg-corp-60 h-[40px] w-[40px] items-center rounded-[3px]">
            {{ $icon }}
        </div>
        <h6 class="ml-4">{{ $title }}</h6>
    </div>
    <div class="flex flex-col text-center">
        {{ $slot }}
    </div>
</div>
